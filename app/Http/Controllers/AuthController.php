<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'nim' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt(['nim' => $request->nim, 'password' => $request->password])) {
            $request->session()->regenerate();
            
            Notification::create([
                'user_id' => Auth::id(),
                'message' => 'Login berhasil pada ' . now()->format('d/m/Y H:i'),
                'is_read' => false
            ]);

            if (Auth::user()->isAdmin()) {
                return redirect()->route('admin.dashboard');
            }
            return redirect()->route('member.dashboard');
        }

        return back()->withErrors([
            'nim' => 'NIM atau password salah.',
        ]);
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nim' => 'required|unique:users|min:3',
            'name' => 'required|min:2',
            'email' => 'nullable|email',
            'phone' => 'nullable',
            'password' => 'required|min:4|confirmed',
        ]);

        $user = User::create([
            'nim' => $request->nim,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => 'mahasiswa',
            'avatar' => substr($request->name, 0, 2),
        ]);

        Notification::create([
            'user_id' => $user->id,
            'message' => 'Selamat datang ' . $user->name . '! Registrasi berhasil.',
            'is_read' => false
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}