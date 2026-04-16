<?php

use Illuminate\Support\Facades\Route;

// Halaman Utama (Landing Page)
Route::get('/', function () {
    return view('Landing_page');
});

// Halaman Dashboard Admin
Route::get('/admin/dashboard', function () {
    return view('Dashboard_admin');
});

// Halaman Welcome (Bawaan Laravel)
Route::get('/welcome', function () {
    return view('welcome');
});