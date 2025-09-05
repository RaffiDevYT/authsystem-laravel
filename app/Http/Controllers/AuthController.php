<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Laravel\Socialite\Facades\Socialite;
use App\Mail\ResetPasswordMail;

class AuthController extends Controller
{
	/**
	 * Show login form
	 */
	public function showLogin()
	{
		return view('auth.login');
	}

	/**
	 * Handle login form
	 */
	public function login(Request $request)
	{
		$request->validate([
			'email' => 'required|email',
			'password' => 'required',
		]);

		if (Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
			// If user appears unverified, double-check fresh from database
			if (!Auth::user()->hasVerifiedEmail()) {
				$currentUserId = Auth::id();
				$freshUser = User::find($currentUserId);
				if ($freshUser && $freshUser->hasVerifiedEmail()) {
					$request->session()->regenerate();
					return redirect()->intended('/dashboard');
				}
				Auth::logout();
				return back()->withErrors([
					'email' => 'Gagal login. Silakan verifikasi email Anda terlebih dahulu.'
				])->withInput($request->only('email'));
			}
			$request->session()->regenerate();
			return redirect()->intended('/dashboard');
		}

		return back()->withErrors([
			'email' => 'Email atau password salah.',
		])->withInput($request->only('email'));
	}

	/**
	 * Show register form
	 */
	public function showRegister()
	{
		return view('auth.register');
	}

	/**
	 * Handle register form submission
	 */
	public function register(Request $request)
	{
		try {
			Log::info('Registration attempt started', [
				'email' => $request->email,
				'first_name' => $request->first_name,
				'last_name' => $request->last_name,
				'has_password' => !empty($request->password),
				'has_phone' => !empty($request->phone_number),
				'birth_data' => [
					'day' => $request->birth_day,
					'month' => $request->birth_month,
					'year' => $request->birth_year
				],
				'gender' => $request->gender
			]);

			$request->validate([
				'first_name' => 'required|string|max:255',
				'last_name' => 'required|string|max:255',
				'email' => 'required|string|email|max:255|unique:users',
				'password' => 'required|string|min:8|confirmed',
				'phone_number' => 'required|string|max:20',
				'birth_day' => 'required|integer|between:1,31',
				'birth_month' => 'required|integer|between:1,12',
				'birth_year' => 'required|integer|between:1900,' . (date('Y') - 18),
				'gender' => 'required|in:male,female',
				'terms' => 'required|accepted',
			], [
				'first_name.required' => 'Nama depan wajib diisi.',
				'last_name.required' => 'Nama belakang wajib diisi.',
				'email.required' => 'Email wajib diisi.',
				'email.email' => 'Format email tidak valid.',
				'email.unique' => 'Email sudah terdaftar.',
				'password.required' => 'Password wajib diisi.',
				'password.min' => 'Password minimal 8 karakter.',
				'password.confirmed' => 'Konfirmasi password tidak cocok.',
				'phone_number.required' => 'Nomor telepon wajib diisi.',
				'phone_number.max' => 'Nomor telepon maksimal 20 karakter.',
				'birth_day.required' => 'Tanggal lahir wajib diisi.',
				'birth_day.between' => 'Tanggal lahir tidak valid.',
				'birth_month.required' => 'Bulan lahir wajib diisi.',
				'birth_month.between' => 'Bulan lahir tidak valid.',
				'birth_year.required' => 'Tahun lahir wajib diisi.',
				'birth_year.between' => 'Tahun lahir tidak valid.',
				'gender.required' => 'Jenis kelamin wajib dipilih.',
				'gender.in' => 'Jenis kelamin tidak valid.',
				'terms.required' => 'Anda harus menyetujui Syarat & Ketentuan.',
				'terms.accepted' => 'Anda harus menyetujui Syarat & Ketentuan.',
			]);

			Log::info('Validation passed, creating user data');

			$userData = [
				'first_name' => $request->first_name,
				'last_name' => $request->last_name,
				'email' => $request->email,
				'password' => Hash::make($request->password),
				'phone_number' => $request->phone_number,
				'birth_day' => $request->birth_day,
				'birth_month' => $request->birth_month,
				'birth_year' => $request->birth_year,
				'gender' => $request->gender,
			];

			Log::info('User data prepared', ['userData' => array_filter($userData, function($key) {
				return $key !== 'password';
			}, ARRAY_FILTER_USE_KEY)]);

			// Check if this is a Google OAuth registration
			if (session()->has('google_data')) {
				$googleData = session('google_data');
				$userData['google_id'] = $googleData['id'];
				$userData['google_token'] = $googleData['token'];
				$userData['google_refresh_token'] = $googleData['refresh_token'];
				$userData['avatar'] = $googleData['avatar'];
				
				Log::info('Google data found, adding to user data');
				
				// Clear Google data from session
				session()->forget('google_data');
			}

			Log::info('Attempting to create user in database');
			$user = User::create($userData);
			Log::info('User created successfully', ['user_id' => $user->id]);

			// Send email verification to manual registration only (no google_id)
			if (empty($user->google_id)) {
				try {
					$user->sendEmailVerificationNotification();
					Log::info('Verification email sent', ['user_id' => $user->id]);
				} catch (\Exception $e) {
					Log::error('Failed sending verification email: ' . $e->getMessage());
				}
				// Redirect to login with a success notice to verify email first
				return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan cek email Anda untuk verifikasi sebelum login.');
			}

			return redirect('/auth/login')->with('success', 'Registrasi berhasil! Silahkan Login Ulang');
		} catch (\Exception $e) {
			Log::error('Registration error: ' . $e->getMessage());
			Log::error('Registration error trace: ' . $e->getTraceAsString());
			return redirect()->back()->withErrors([
				'email' => 'Terjadi kesalahan saat registrasi. Silakan coba lagi.'
			])->withInput();
		}
	}

	/** Redirects with login intent (default legacy) */
	public function redirectToGoogle()
	{
		// default to login intent for backward compatibility
		session(['google_oauth_intent' => 'login']);
		return Socialite::driver('google')->redirect();
	}

	/** Redirect to Google with explicit login intent */
	public function redirectToGoogleLogin()
	{
		session(['google_oauth_intent' => 'login']);
		return Socialite::driver('google')->redirect();
	}

	/** Redirect to Google with explicit register intent */
	public function redirectToGoogleRegister()
	{
		session(['google_oauth_intent' => 'register']);
		return Socialite::driver('google')->redirect();
	}

	/**
	 * Handle Google OAuth callback
	 */
	public function handleGoogleCallback()
	{
		try {
			$googleUser = Socialite::driver('google')->user();
			$intent = session('google_oauth_intent');
			session()->forget('google_oauth_intent'); // Clear intent after use

			Log::info('Google OAuth user data:', [
				'id' => $googleUser->id,
				'name' => $googleUser->name,
				'email' => $googleUser->email,
				'intent' => $intent,
			]);

			$user = User::where('google_id', $googleUser->id)
					   ->orWhere('email', $googleUser->email)
					   ->first();

			if (!$user) {
				// User does not exist
				if ($intent === 'login') {
					Log::info('User not found for login intent, redirecting to login with error.');
					return redirect()->route('login')->withErrors([
						'email' => 'Akun Google Anda belum terdaftar. Silakan daftar terlebih dahulu.'
					]);
				} elseif ($intent === 'register') {
					Log::info('User not found for register intent, creating new account automatically.');
					
					// Parse first and last name from Google user's name
					$nameParts = explode(' ', $googleUser->name, 2);
					$firstName = $nameParts[0] ?? '';
					$lastName = $nameParts[1] ?? '';

					// Create new user automatically
					$user = User::create([
						'first_name' => $firstName,
						'last_name' => $lastName,
						'email' => $googleUser->email,
						'google_id' => $googleUser->id,
						'google_token' => $googleUser->token,
						'google_refresh_token' => $googleUser->refreshToken,
						'avatar' => $googleUser->avatar,
						// Set default values for required fields
						'phone_number' => 'Belum diisi',
						'birth_day' => 1,
						'birth_month' => 1,
						'birth_year' => 1990,
						'gender' => 'other',
						'email_verified_at' => now(),
					]);

					Log::info('New user created automatically:', ['user_id' => $user->id]);
				}
			}

			// User exists or was just created, log them in
			Log::info('User found/created, logging in.');
			if (!$user->google_id) {
				$user->update([
					'google_id' => $googleUser->id,
					'google_token' => $googleUser->token,
					'google_refresh_token' => $googleUser->refreshToken,
					'avatar' => $googleUser->avatar,
				]);
			}

			Auth::login($user);

			return redirect('/dashboard');
		} catch (\Exception $e) {
			Log::error('Google OAuth error: ' . $e->getMessage());
			Log::error($e->getTraceAsString());
			return redirect()->route('login')->withErrors([
				'email' => 'Gagal login dengan Google. Silakan coba lagi.',
			]);
		}
	}

	/**
	 * Handle logout
	 */
	public function logout(Request $request)
	{
		Auth::logout();
		$request->session()->invalidate();
		$request->session()->regenerateToken();
		
		return redirect('/');
	}

	/**
	 * Dashboard for authenticated users
	 */
	public function dashboard()
	{
		return view('dashboard');
	}

	/**
	 * Show forgot password form
	 */
	public function showForgotPassword()
	{
		return view('auth.forgot-password');
	}

	/**
	 * Send password reset link
	 */
	public function sendResetLinkEmail(Request $request)
	{
		$request->validate([
			'email' => 'required|email|exists:users,email',
		], [
			'email.required' => 'Email wajib diisi.',
			'email.email' => 'Format email tidak valid.',
			'email.exists' => 'Email tidak terdaftar dalam sistem.',
		]);

		try {
			// Generate reset token
			$token = \Str::random(64);
			$user = User::where('email', $request->email)->first();
			
			// Store token in database (you might want to create a password_resets table)
			// For now, we'll store it in session for demo purposes
			session(['reset_token_' . $user->id => $token]);
			session(['reset_email_' . $user->id => $user->email]);
			session(['reset_expires_' . $user->id => now()->addMinutes(5)]);

			Log::info('Password reset token generated for user: ' . $user->email);

			// Send email
			Mail::to($user->email)->send(new ResetPasswordMail($user, $token));
			Log::info('Password reset email sent to: ' . $user->email);

			return redirect()->route('password.request')->with('success', 'We have e-mailed your password reset link!');

		} catch (\Exception $e) {
			Log::error('Password reset error: ' . $e->getMessage());
			return redirect()->back()->withErrors([
				'email' => 'Terjadi kesalahan saat mengirim link reset password. Silakan coba lagi.'
			])->withInput();
		}
	}

	/**
	 * Show reset password form
	 */
	public function showResetPassword($token)
	{
		return view('auth.reset-password', compact('token'));
	}

	/**
	 * Reset password
	 */
	public function resetPassword(Request $request)
	{
		$request->validate([
			'token' => 'required',
			'email' => 'required|email',
			'password' => 'required|string|min:8|confirmed',
		], [
			'token.required' => 'Token reset password wajib ada.',
			'email.required' => 'Email wajib diisi.',
			'email.email' => 'Format email tidak valid.',
			'password.required' => 'Password baru wajib diisi.',
			'password.min' => 'Password minimal 8 karakter.',
			'password.confirmed' => 'Konfirmasi password tidak cocok.',
		]);

		try {
			$user = User::where('email', $request->email)->first();
			
			if (!$user) {
				return redirect()->back()->withErrors([
					'email' => 'Email tidak ditemukan.'
				])->withInput();
			}

			// Check if token is valid and not expired
			$storedToken = session('reset_token_' . $user->id);
			$storedEmail = session('reset_email_' . $user->id);
			$expires = session('reset_expires_' . $user->id);

			if (!$storedToken || $storedToken !== $request->token || 
				!$storedEmail || $storedEmail !== $request->email ||
				!$expires || now()->isAfter($expires)) {
				
				return redirect()->back()->withErrors([
					'email' => 'Token reset password tidak valid atau sudah expired. Silakan request ulang.'
				])->withInput();
			}

			// Update password
			$user->update([
				'password' => Hash::make($request->password)
			]);

			// Clear reset tokens
			session()->forget(['reset_token_' . $user->id, 'reset_email_' . $user->id, 'reset_expires_' . $user->id]);

			Log::info('Password reset successful for user: ' . $user->email);

			return redirect()->route('login')->with('success', 'Password berhasil direset! Silakan login dengan password baru Anda.');

		} catch (\Exception $e) {
			Log::error('Password reset error: ' . $e->getMessage());
			return redirect()->back()->withErrors([
				'email' => 'Terjadi kesalahan saat reset password. Silakan coba lagi.'
			])->withInput();
		}
	}
}
