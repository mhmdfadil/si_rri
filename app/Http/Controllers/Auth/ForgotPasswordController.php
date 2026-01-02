<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class ForgotPasswordController extends Controller
{
    /**
     * Show forgot password form
     */
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    /**
     * Verify user identifier (email or username) and CAPTCHA
     */
    public function verifyIdentifier(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'identifier' => 'required|string',
            'captcha' => 'required|string',
            'captcha_challenge' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Mohon lengkapi semua field yang diperlukan.'
            ], 422);
        }

        // Verify CAPTCHA
        if ($request->captcha !== $request->captcha_challenge) {
            return response()->json([
                'success' => false,
                'message' => 'Kode CAPTCHA tidak sesuai. Silakan coba lagi.'
            ], 422);
        }

        // Find user by email or username
        $user = User::where(function($query) use ($request) {
            $query->where('email', strtolower($request->identifier))
                  ->orWhere('username', $request->identifier);
        })->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Email atau username tidak ditemukan dalam sistem.'
            ], 404);
        }

        // Check if user is active
        if (!$user->is_active) {
            return response()->json([
                'success' => false,
                'message' => 'Akun Anda tidak aktif. Silakan hubungi administrator.'
            ], 403);
        }

        return response()->json([
            'success' => true,
            'message' => "Akun ditemukan: {$user->name}. Silakan buat password baru Anda.",
            'data' => [
                'user_id' => $user->id,
                'name' => $user->name,
                'email' => $user->email
            ]
        ]);
    }

    /**
     * Reset password
     */
    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'new_password' => [
                'required',
                'string',
                'min:8',
                'regex:/[A-Z]/',      // Must contain at least one uppercase letter
                'regex:/[a-z]/',      // Must contain at least one lowercase letter
                'regex:/[!@#$%^&*(),.?":{}|<>]/' // Must contain at least one symbol
            ],
            'confirm_password' => 'required|same:new_password'
        ], [
            'new_password.required' => 'Password baru wajib diisi.',
            'new_password.min' => 'Password harus minimal 8 karakter.',
            'new_password.regex' => 'Password harus mengandung huruf besar, huruf kecil, dan simbol.',
            'confirm_password.same' => 'Konfirmasi password tidak sesuai dengan password baru.'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ], 422);
        }

        try {
            $user = User::findOrFail($request->user_id);

            // Update password
            $user->password = Hash::make($request->new_password);
            $user->save();

            // Log activity
            Log::info('Password reset successfully', [
                'user_id' => $user->id,
                'email' => $user->email,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Password berhasil direset! Silakan login dengan password baru Anda.'
            ]);

        } catch (\Exception $e) {
            Log::error('Password reset failed', [
                'error' => $e->getMessage(),
                'user_id' => $request->user_id
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mereset password. Silakan coba lagi.'
            ], 500);
        }
    }
}