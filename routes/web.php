<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

// Halaman Welcome (Bawaan Laravel)
Route::get('/welcome', function () {
    return view('welcome');
});
Route::view('/home', 'home');
Route::view('/product', 'product');
Route::view('/about', 'about');
Route::view('/contact', 'contact');
Route::view('/login', 'login');
Route::view('/register', 'register');
Route::view('/dashboard', 'dashboard');


Route::get('/app', function () {
return view('app');
});