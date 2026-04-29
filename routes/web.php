<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;

Route::get('/welcome', function () {
return view('welcome');
});

Route::view('/home', 'pages.home');
Route::view('/about', 'pages.about');
Route::view('/contact', 'pages.contact');

Route::get('/product', [ProductController::class, 'index']);

Route::get('/app', function () {
return view('layouts.app');
});

Route::get('/', function () {
return view('layouts.landing');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::view('/admin/dashboard', 'admin.dashboard')->name('admin.dashboard');
Route::view('/admin/books', 'admin.books');
Route::view('/admin/members', 'admin.members');
Route::view('/admin/loans', 'admin.active-loans');
Route::view('/admin/returns', 'admin.returns');

Route::view('/member/dashboard', 'member.dashboardmember')->name('member.dashboard');
Route::view('/member/history', 'member.history');
Route::view('/member/returns', 'member.returns');

Route::view('/dashboard', 'dashboard');


