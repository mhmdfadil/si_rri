<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Tampilkan halaman login
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle login request
     */
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ], [
            'email.required' => 'Email atau username harus diisi',
            'password.required' => 'Password harus diisi',
        ]);

        // Rate limiting untuk mencegah brute force
        $this->checkTooManyFailedAttempts($request);

        // Coba login dengan email atau username
        $fieldType = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        
        $credentials = [
            $fieldType => $request->email,
            'password' => $request->password,
        ];

        // Tambahkan kondisi is_active
        $credentials['is_active'] = true;

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            
            // Update last login
            Auth::user()->updateLastLogin();
            
            // Clear rate limiter
            RateLimiter::clear($this->throttleKey($request));

            return response()->json([
                'success' => true,
                'message' => 'Login berhasil! Mengalihkan ke dashboard...',
                'redirect' => route('dashboard')
            ]);
        }

        // Increment failed attempts
        RateLimiter::hit($this->throttleKey($request));

        return response()->json([
            'success' => false,
            'message' => 'Email/Username atau password salah',
        ], 422);
    }

    /**
     * Handle logout
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda telah berhasil logout');
    }

    /**
     * Check for too many failed login attempts
     */
    protected function checkTooManyFailedAttempts(Request $request)
    {
        $maxAttempts = 5;
        $decayMinutes = 1;

        if (RateLimiter::tooManyAttempts($this->throttleKey($request), $maxAttempts)) {
            $seconds = RateLimiter::availableIn($this->throttleKey($request));

            throw ValidationException::withMessages([
                'email' => ["Terlalu banyak percobaan login. Silakan coba lagi dalam {$seconds} detik."],
            ])->status(429);
        }
    }

    /**
     * Get the rate limiting throttle key
     */
    protected function throttleKey(Request $request)
    {
        return Str::transliterate(Str::lower($request->input('email')).'|'.$request->ip());
    }
}