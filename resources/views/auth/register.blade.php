@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div style="min-height: 100vh; background: linear-gradient(135deg, #eef2ff, #d9e6f5); display: flex; justify-content: center; align-items: center; padding: 2rem; margin-left: -280px;">
    <div style="background: white; border-radius: 2rem; width: 500px; max-width: 100%; padding: 2rem; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25);">
        <div style="text-align: center;">
            <i class="fas fa-user-plus" style="font-size: 3rem; color: #10b981;"></i>
            <h1 style="margin: 0.5rem 0;">Daftar Akun</h1>
            <p style="color: gray;">Bergabunglah dengan perpustakaan digital</p>
        </div>
        
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group">
                <label>NIM *</label>
                <input type="text" name="nim" value="{{ old('nim') }}" required>
                @error('nim') <small style="color: red;">{{ $message }}</small> @enderror
            </div>
            <div class="form-group">
                <label>Nama Lengkap *</label>
                <input type="text" name="name" value="{{ old('name') }}" required>
                @error('name') <small style="color: red;">{{ $message }}</small> @enderror
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}">
                @error('email') <small style="color: red;">{{ $message }}</small> @enderror
            </div>
            <div class="form-group">
                <label>No. Telepon</label>
                <input type="text" name="phone" value="{{ old('phone') }}">
            </div>
            <div class="form-group">
                <label>Password *</label>
                <input type="password" name="password" required>
                @error('password') <small style="color: red;">{{ $message }}</small> @enderror
            </div>
            <div class="form-group">
                <label>Program Studi</label>
                <input type="prodi" name="prodi" required>
                @error('password') <small style="color: red;">{{ $message }}</small> @enderror
            </div>
            <div class="form-group">
                <label>Konfirmasi Password *</label>
                <input type="password" name="password_confirmation" required>
            </div>
            <button type="submit" class="btn-success" style="width: 100%;">Daftar Sekarang</button>
        </form>
        
        <div style="text-align: center; margin-top: 1rem;">
            <a href="{{ route('login') }}" style="color: #3b82f6; text-decoration: none;">Sudah punya akun? Login</a>
        </div>
    </div>
</div>
@endsection