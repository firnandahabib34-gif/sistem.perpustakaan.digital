<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Book;
use App\Models\Loan;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (!auth()->user()->isAdmin()) {
                abort(403, 'Unauthorized');
            }
            return $next($request);
        });
    }

    public function dashboard()
    {
        $totalBooks = Book::count();
        $totalStock = Book::sum('stock');
        $totalMembers = User::where('role', 'mahasiswa')->count();
        $activeLoans = Loan::whereIn('status', ['borrowed', 'late'])->count();
        $totalFine = Loan::sum('fine');
        
        $categoryStats = Book::select('category', \DB::raw('sum(stock) as total'))
            ->groupBy('category')
            ->get();
        
        $recentLoans = Loan::with(['book', 'user'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalBooks', 'totalStock', 'totalMembers', 
            'activeLoans', 'totalFine', 'categoryStats', 'recentLoans'
        ));
    }

    public function books()
    {
        $books = Book::all();
        return view('admin.books', compact('books'));
    }

    public function storeBook(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'category' => 'required',
            'stock' => 'required|integer|min:0',
            'year' => 'nullable|digits:4',
        ]);

        Book::create($request->all());
        
        return redirect()->route('admin.books')->with('success', 'Buku berhasil ditambahkan');
    }

    public function updateBook(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'category' => 'required',
            'stock' => 'required|integer|min:0',
            'year' => 'nullable|digits:4',
        ]);

        $book->update($request->all());
        
        return redirect()->route('admin.books')->with('success', 'Buku berhasil diupdate');
    }

    public function deleteBook(Book $book)
    {
        $activeLoans = Loan::where('book_id', $book->id)
            ->whereIn('status', ['borrowed', 'late'])
            ->exists();
            
        if ($activeLoans) {
            return back()->with('error', 'Buku sedang dipinjam, tidak bisa dihapus!');
        }
        
        $book->delete();
        return back()->with('success', 'Buku berhasil dihapus');
    }

    public function members()
    {
        $members = User::where('role', 'mahasiswa')->get();
        return view('admin.members', compact('members'));
    }

    public function storeMember(Request $request)
    {
        $request->validate([
            'nim' => 'required|unique:users',
            'name' => 'required',
            'password' => 'required|min:4',
            'email' => 'nullable|email',
            'phone' => 'nullable',
        ]);

        User::create([
            'nim' => $request->nim,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => 'mahasiswa',
            'avatar' => substr($request->name, 0, 2),
        ]);

        return redirect()->route('admin.members')->with('success', 'Anggota berhasil ditambahkan');
    }

    public function updateMember(Request $request, User $member)
    {
        if ($member->role === 'admin') {
            return back()->with('error', 'Tidak bisa mengedit admin!');
        }

        $request->validate([
            'name' => 'required',
            'email' => 'nullable|email',
            'phone' => 'nullable',
        ]);

        $data = $request->only(['name', 'email', 'phone']);
        
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $member->update($data);
        
        return redirect()->route('admin.members')->with('success', 'Anggota berhasil diupdate');
    }

    public function deleteMember(User $member)
    {
        if ($member->role === 'admin') {
            return back()->with('error', 'Tidak bisa menghapus admin!');
        }

        $activeLoans = Loan::where('user_id', $member->id)
            ->whereIn('status', ['borrowed', 'late'])
            ->exists();
            
        if ($activeLoans) {
            return back()->with('error', 'Anggota masih memiliki pinjaman aktif!');
        }
        
        $member->delete();
        return back()->with('success', 'Anggota berhasil dihapus');
    }

    public function activeLoans()
    {
        $loans = Loan::with(['book', 'user'])
            ->whereIn('status', ['borrowed', 'late'])
            ->get();
        return view('admin.active-loans', compact('loans'));
    }

    public function returns()
    {
        $loans = Loan::with(['book', 'user'])
            ->whereIn('status', ['borrowed', 'late'])
            ->get();
        return view('admin.returns', compact('loans'));
    }

    public function processReturn(Loan $loan)
    {
        $loan->return_date = now();
        $loan->fine = $loan->calculateFine();
        $loan->status = 'returned';
        $loan->save();

        $book = $loan->book;
        $book->stock += 1;
        $book->save();

        Notification::create([
            'user_id' => $loan->user_id,
            'message' => 'Buku "' . $book->title . '" telah dikembalikan. ' . 
                        ($loan->fine > 0 ? 'Denda: Rp ' . number_format($loan->fine) : ''),
            'is_read' => false
        ]);

        return back()->with('success', 'Buku berhasil dikembalikan');
    }
}