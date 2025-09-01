<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Public routes
Route::get('/', function () {
	return view('welcome');
});

Route::get('/auth/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/auth/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/auth/register', [AuthController::class, 'showRegister'])->name('register')->middleware('guest');
Route::post('/auth/register', [AuthController::class, 'register'])->name('register.post');

// Forgot Password Routes
Route::get('/auth/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request')->middleware('guest');
Route::post('/auth/forgot-password', [AuthController::class, 'sendResetLinkEmail'])->name('password.email')->middleware('guest');
Route::get('/auth/reset-password/{token}', [AuthController::class, 'showResetPassword'])->name('password.reset')->middleware('guest');
Route::post('/auth/reset-password', [AuthController::class, 'resetPassword'])->name('password.update')->middleware('guest');

// Google OAuth routes
Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('google.redirect'); // legacy fallback
Route::get('/auth/google/login', [AuthController::class, 'redirectToGoogleLogin'])->name('google.redirect.login');
Route::get('/auth/google/register', [AuthController::class, 'redirectToGoogleRegister'])->name('google.redirect.register');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('google.callback');

// Protected routes
Route::middleware('auth')->group(function () {
	Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
	Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
