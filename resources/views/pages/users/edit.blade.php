@extends('layouts.app')

@section('title', 'Edit Pengguna')
@section('page-title', 'Edit Pengguna')
@section('page-subtitle', 'Ubah informasi pengguna')

@section('content')
<div class="max-w-full mx-auto">
    
    <!-- Back Button -->
    <div class="mb-6">
        <a 
            href="{{ route('users.index') }}" 
            class="inline-flex items-center gap-2 text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 font-medium transition-colors"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali ke Daftar Pengguna
        </a>
    </div>

    <!-- Form Card -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-100 dark:border-gray-700 overflow-hidden transition-colors">
        
        <!-- Card Header -->
        <div class="bg-gradient-to-r from-emerald-500 to-teal-500 px-6 py-4">
            <h2 class="text-xl font-bold text-white flex items-center gap-2">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Form Edit Pengguna
            </h2>
            <p class="text-emerald-50 text-sm mt-1">Perbarui informasi pengguna</p>
        </div>

        <!-- Card Body -->
        <div class="p-6">
            <form action="{{ route('users.update', $user) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    
                    <!-- Photo Section -->
                    <div class="lg:col-span-1">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Foto Profile</label>

                        <div class="text-center">
                            <div class="relative inline-block">
                                <div class="w-32 h-32 rounded-full overflow-hidden border-4 border-emerald-100 dark:border-emerald-900 shadow-lg">
                                    <img
                                        id="photoPreview"
                                        src="{{ $user->photo_url }}"
                                        alt="Profile Photo"
                                        class="w-full h-full object-cover"
                                    >
                                </div>

                                @if($user->photos)
                                    <button
                                        type="button"
                                        onclick="deletePhoto()"
                                        class="absolute bottom-0 right-0 bg-red-500 text-white p-2 rounded-full hover:bg-red-600 transition-colors shadow-lg"
                                    >
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>
                                    </button>
                                @endif
                            </div>

                            <div class="mt-4">
                                <label for="photos"
                                    class="cursor-pointer inline-flex items-center gap-2 bg-emerald-50 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-300 px-4 py-2 rounded-lg hover:bg-emerald-100 dark:hover:bg-emerald-900/50 transition-colors font-medium text-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 13a3 3 0 11-6 0 3 3 0 016 0z">
                                        </path>
                                    </svg>
                                    Ubah Foto
                                </label>

                                <input
                                    type="file"
                                    id="photos"
                                    name="photos"
                                    class="hidden"
                                    accept="image/*"
                                    onchange="previewPhoto(event)"
                                >

                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">JPG, PNG, GIF (Max. 2MB)</p>

                                @error('photos')
                                    <p class="text-red-500 dark:text-red-400 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Form Fields -->
                    <div class="lg:col-span-2 space-y-4">
                        
                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Nama Lengkap <span class="text-red-500 dark:text-red-400">*</span>
                            </label>
                            <input 
                                type="text" 
                                id="name" 
                                name="name" 
                                value="{{ old('name', $user->name) }}"
                                class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:border-emerald-500 dark:focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 dark:focus:ring-emerald-900 transition-all outline-none bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 @error('name') border-red-500 dark:border-red-400 @enderror"
                                required
                            >
                            @error('name')
                                <p class="text-red-500 dark:text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Username -->
                        <div>
                            <label for="username" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Username <span class="text-red-500 dark:text-red-400">*</span>
                            </label>
                            <input 
                                type="text" 
                                id="username" 
                                name="username" 
                                value="{{ old('username', $user->username) }}"
                                class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:border-emerald-500 dark:focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 dark:focus:ring-emerald-900 transition-all outline-none bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 @error('username') border-red-500 dark:border-red-400 @enderror"
                                required
                            >
                            @error('username')
                                <p class="text-red-500 dark:text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Email <span class="text-red-500 dark:text-red-400">*</span>
                            </label>
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                value="{{ old('email', $user->email) }}"
                                class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:border-emerald-500 dark:focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 dark:focus:ring-emerald-900 transition-all outline-none bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 @error('email') border-red-500 dark:border-red-400 @enderror"
                                required
                            >
                            @error('email')
                                <p class="text-red-500 dark:text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password (Optional) -->
                        <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg p-4">
                            <p class="text-sm font-medium text-yellow-800 dark:text-yellow-300 mb-3">
                                <svg class="w-5 h-5 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                </svg>
                                Ubah Password (opsional)
                            </p>
                            <p class="text-xs text-yellow-700 dark:text-yellow-400 mb-3">Kosongkan jika tidak ingin mengubah password</p>
                            
                            <div class="space-y-3">
                                <div>
                                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Password Baru
                                    </label>
                                    <div class="relative">
                                        <input 
                                            type="password" 
                                            id="password" 
                                            name="password" 
                                            class="w-full px-4 py-2.5 pr-12 border border-gray-300 dark:border-gray-600 rounded-lg focus:border-emerald-500 dark:focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 dark:focus:ring-emerald-900 transition-all outline-none bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 @error('password') border-red-500 dark:border-red-400 @enderror"
                                        >
                                        <button type="button" onclick="togglePassword('password')" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                        </button>
                                    </div>
                                    @error('password')
                                        <p class="text-red-500 dark:text-red-400 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Minimal 8 karakter</p>
                                </div>

                                <div>
                                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Konfirmasi Password Baru
                                    </label>
                                    <div class="relative">
                                        <input 
                                            type="password" 
                                            id="password_confirmation" 
                                            name="password_confirmation" 
                                            class="w-full px-4 py-2.5 pr-12 border border-gray-300 dark:border-gray-600 rounded-lg focus:border-emerald-500 dark:focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 dark:focus:ring-emerald-900 transition-all outline-none bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500"
                                        >
                                        <button type="button" onclick="togglePassword('password_confirmation')" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Status Active -->
                        <div class="flex items-center gap-3 pt-2">
                            <input 
                                type="checkbox" 
                                id="is_active" 
                                name="is_active" 
                                value="1"
                                {{ old('is_active', $user->is_active) ? 'checked' : '' }}
                                class="w-5 h-5 text-emerald-600 border-gray-300 dark:border-gray-600 rounded focus:ring-emerald-500 focus:ring-2 bg-white dark:bg-gray-700"
                            >
                            <label for="is_active" class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                Pengguna aktif
                            </label>
                        </div>

                        <!-- Account Info -->
                        <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-4 mt-4 border border-gray-200 dark:border-gray-600">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                                <div>
                                    <p class="text-gray-600 dark:text-gray-400">Login Terakhir</p>
                                    <p class="font-medium text-gray-800 dark:text-gray-200 mt-1">
                                        {{ $user->last_login_at ? $user->last_login_at->format('d M Y, H:i') : 'Belum pernah login' }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-gray-600 dark:text-gray-400">Dibuat Pada</p>
                                    <p class="font-medium text-gray-800 dark:text-gray-200 mt-1">
                                        {{ $user->created_at->format('d M Y, H:i') }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="flex items-center gap-3 pt-6 border-t border-gray-200 dark:border-gray-600">
                            <button 
                                type="submit" 
                                class="bg-gradient-to-r from-emerald-500 to-teal-500 text-white px-6 py-2.5 rounded-lg font-medium hover:shadow-lg transition-all flex items-center gap-2"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Simpan Perubahan
                            </button>
                            
                            <a 
                                href="{{ route('users.index') }}" 
                                class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 px-6 py-2.5 rounded-lg font-medium hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors flex items-center gap-2"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                Batal
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Photo Form (Hidden) -->
    <form id="deletePhotoForm" action="{{ route('users.photo.delete', $user) }}" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>
</div>

@push('scripts')
<script>
    // Preview photo before upload
    function previewPhoto(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('photoPreview');
                preview.src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    }

    // Delete photo
    function deletePhoto() {
        if (confirm('Apakah Anda yakin ingin menghapus foto user ini?')) {
            document.getElementById('deletePhotoForm').submit();
        }
    }

    // Toggle password visibility
    function togglePassword(fieldId) {
        const field = document.getElementById(fieldId);
        const type = field.getAttribute('type') === 'password' ? 'text' : 'password';
        field.setAttribute('type', type);
    }
</script>
@endpush
@endsection