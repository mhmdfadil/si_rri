<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    /**
     * Display the user's profile.
     */
    public function index()
    {
        $user = Auth::user();
        return view('pages.profile.index', compact('user'));
    }

     /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username,' . $user->id],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'photos' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        $data = [
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
        ];

        // Handle photo upload
        if ($request->hasFile('photos')) {
            // Delete old photo if exists
            if ($user->photos && Storage::disk('public')->exists($user->photos)) {
                Storage::disk('public')->delete($user->photos);
            }

            // Store new photo
            $photoPath = $request->file('photos')->store('profile-photos', 'public');
            $data['photos'] = $photoPath;
        }

        $user->update($data);

        return redirect()->route('profile.index')
            ->with('success', 'Profile berhasil diperbarui!');
    }

    /**
     * Update the user's password.
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => [
                'required', 
                'confirmed', 
                Password::min(8)
                    ->mixedCase()      // Minimal 1 huruf besar dan 1 huruf kecil
                    ->symbols()        // Minimal 1 simbol
            ],
        ], [
            'password.min' => 'Password harus minimal 8 karakter.',
            'password.mixed_case' => 'Password harus mengandung minimal 1 huruf besar dan 1 huruf kecil.',
            'password.symbols' => 'Password harus mengandung minimal 1 simbol (!@#$%^&*).',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'current_password.current_password' => 'Password saat ini tidak sesuai.',
        ]);

        $user = Auth::user();
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('profile.index')
            ->with('success', 'Password berhasil diperbarui!');
    }

    /**
     * Delete the user's photo.
     */
    public function deletePhoto()
    {
        $user = Auth::user();

        if ($user->photos && Storage::disk('public')->exists($user->photos)) {
            Storage::disk('public')->delete($user->photos);
        }

        $user->update(['photos' => null]);

        return redirect()->route('profile.index')
            ->with('success', 'Foto profile berhasil dihapus!');
    }
   
}