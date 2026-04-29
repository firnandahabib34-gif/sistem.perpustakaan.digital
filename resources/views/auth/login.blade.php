@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div style="min-height: 100vh; background: linear-gradient(135deg, #eef2ff, #d9e6f5); display: flex; justify-content: center; align-items: center; padding: 2rem; margin-left: -280px;">
    <div style="background: white; border-radius: 2rem; width: 500px; max-width: 100%; padding: 2rem; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25);">
        <div style="text-align: center;">
            <i class="fas fa-landmark" style="font-size: 3rem; color: #3b82f6;"></i>
            <h1 style="margin: 0.5rem 0;">E-Library Pro</h1>
            <p style="color: gray;">Sistem Perpustakaan Digital</p>
        </div>
        
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        
        <form method="POST" action="/login">
            @csrf
            <div class="form-group">
                <label>NIM / Username</label>
                <input type="text" name="nim" value="{{ old('nim') }}" required>
                @error('nim')
                    <small style="color: red;">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit" class="btn-primary" style="width: 100%;">Login</button>
        </form>
        
        <div style="text-align: center; margin-top: 1rem;">
            <a href="/register" style="color: #3b82f6; text-decoration: none;">Belum punya akun? Daftar Sekarang</a>
        </div>
        
        <div style="margin-top: 1.5rem; background: #f1f5f9; padding: 1rem; border-radius: 1rem; font-size: 0.75rem;">
            <strong>🔐 Demo Akun:</strong><br>
            Admin: admin / admin123<br>
            Mahasiswa: MHS001 / mahasiswa
        </div>
    </div>
</div>
@endsection