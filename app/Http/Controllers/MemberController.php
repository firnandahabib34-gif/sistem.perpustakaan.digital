<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        $books = Book::where('stock', '>', 0)->get();
        $activeLoans = Loan::where('user_id', Auth::id())
            ->whereIn('status', ['borrowed', 'late'])
            ->with('book')
            ->get();
        
        return view('member.dashboard', compact('books', 'activeLoans'));
    }

    public function borrow(Request $request)
    {
        $book = Book::findOrFail($request->book_id);
        
        if ($book->stock <= 0) {
            return back()->with('error', 'Stok buku habis!');
        }
        
        $existingLoan = Loan::where('user_id', Auth::id())
            ->where('book_id', $book->id)
            ->whereIn('status', ['borrowed', 'late'])
            ->exists();
            
        if ($existingLoan) {
            return back()->with('error', 'Anda masih meminjam buku ini!');
        }
        
        $loan = Loan::create([
            'book_id' => $book->id,
            'user_id' => Auth::id(),
            'loan_date' => now(),
            'due_date' => now()->addDays(7),
            'status' => 'borrowed',
            'fine' => 0
        ]);
        
        $book->stock -= 1;
        $book->save();
        
        Notification::create([
            'user_id' => Auth::id(),
            'message' => 'Meminjam buku "' . $book->title . '". Kembalikan sebelum ' . $loan->due_date->format('d/m/Y'),
            'is_read' => false
        ]);
        
        return back()->with('success', 'Berhasil meminjam buku!');
    }

    public function returns()
    {
        $loans = Loan::where('user_id', Auth::id())
            ->whereIn('status', ['borrowed', 'late'])
            ->with('book')
            ->get();
        
        return view('member.returns', compact('loans'));
    }

    public function returnBook(Loan $loan)
    {
        if ($loan->user_id !== Auth::id()) {
            abort(403);
        }
        
        $loan->return_date = now();
        $loan->fine = $loan->calculateFine();
        $loan->status = 'returned';
        $loan->save();
        
        $book = $loan->book;
        $book->stock += 1;
        $book->save();
        
        return redirect()->route('member.history')->with('success', 'Buku berhasil dikembalikan');
    }

    public function history()
    {
        $loans = Loan::where('user_id', Auth::id())
            ->with('book')
            ->orderBy('created_at', 'desc')
            ->get();
        
        $totalFine = $loans->sum('fine');
        
        return view('member.history', compact('loans', 'totalFine'));
    }

    public function notifications()
    {
        $notifications = Notification::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
            
        Notification::where('user_id', Auth::id())
            ->update(['is_read' => true]);
            
        return response()->json($notifications);
    }

    public function markNotificationRead($id)
    {
        $notification = Notification::where('user_id', Auth::id())
            ->where('id', $id)
            ->first();
            
        if ($notification) {
            $notification->update(['is_read' => true]);
        }
        
        return response()->json(['success' => true]);
    }
}