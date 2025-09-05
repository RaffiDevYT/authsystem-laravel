<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Models\User;

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

// Email verification routes
Route::get('/email/verify', function () {
	return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

// Allow verification without being logged in; validate signature and hash
Route::get('/email/verify/{id}/{hash}', function (Request $request, $id, $hash) {
	$user = User::findOrFail($id);

	if (! hash_equals(sha1($user->getEmailForVerification()), (string) $hash)) {
		abort(403);
	}

	if (! $request->hasValidSignature()) {
		abort(403);
	}

	if ($user->hasVerifiedEmail()) {
		return redirect()->route('login')->with('success', 'Email Anda sudah terverifikasi. Silakan login.');
	}

	$user->markEmailAsVerified();

	return redirect()->route('login')->with('success', 'Email berhasil diverifikasi. Silakan login.');
})->middleware(['signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
	$request->user()->sendEmailVerificationNotification();
	return back()->with('message', 'Link verifikasi baru telah dikirim ke email Anda.');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// Protected routes
Route::middleware(['auth', 'verified'])->group(function () {
	Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
});

Route::middleware('auth')->group(function () {
	Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
