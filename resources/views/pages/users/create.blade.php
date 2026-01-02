@extends('layouts.app')

@section('title', 'Tambah Pengguna')
@section('page-title', 'Tambah Pengguna')
@section('page-subtitle', 'Tambahkan pengguna baru ke sistem')

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
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                </svg>
                Form Tambah Pengguna
            </h2>
            <p class="text-emerald-50 text-sm mt-1">Lengkapi formulir di bawah ini</p>
        </div>

        <!-- Card Body -->
        <div class="p-6">
            <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    
                    <!-- Photo Section -->
                    <div class="lg:col-span-1">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Foto Profile</label>
                        <div class="text-center">
                            <div class="relative inline-block">
                                <div class="w-32 h-32 rounded-full overflow-hidden border-4 border-emerald-100 dark:border-emerald-900 shadow-lg">
                                    <div id="photoPreview" class="w-full h-full bg-gradient-to-br from-gray-200 to-gray-300 dark:from-gray-700 dark:to-gray-600 flex items-center justify-center">
                                        <svg class="w-12 h-12 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mt-4">
                                <label for="photos" class="cursor-pointer inline-flex items-center gap-2 bg-emerald-50 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-300 px-4 py-2 rounded-lg hover:bg-emerald-100 dark:hover:bg-emerald-900/50 transition-colors font-medium text-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    Pilih Foto
                                </label>
                                <input type="file" id="photos" name="photos" class="hidden" accept="image/*" onchange="previewPhoto(event)">
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
                                value="{{ old('name') }}"
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
                                value="{{ old('username') }}"
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
                                value="{{ old('email') }}"
                                class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:border-emerald-500 dark:focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 dark:focus:ring-emerald-900 transition-all outline-none bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 @error('email') border-red-500 dark:border-red-400 @enderror"
                                required
                            >
                            @error('email')
                                <p class="text-red-500 dark:text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Password <span class="text-red-500 dark:text-red-400">*</span>
                            </label>
                            <div class="relative">
                                <input 
                                    type="password" 
                                    id="password" 
                                    name="password" 
                                    class="w-full px-4 py-2.5 pr-12 border border-gray-300 dark:border-gray-600 rounded-lg focus:border-emerald-500 dark:focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 dark:focus:ring-emerald-900 transition-all outline-none bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 @error('password') border-red-500 dark:border-red-400 @enderror"
                                    required
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

                        <!-- Confirm Password -->
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Konfirmasi Password <span class="text-red-500 dark:text-red-400">*</span>
                            </label>
                            <div class="relative">
                                <input 
                                    type="password" 
                                    id="password_confirmation" 
                                    name="password_confirmation" 
                                    class="w-full px-4 py-2.5 pr-12 border border-gray-300 dark:border-gray-600 rounded-lg focus:border-emerald-500 dark:focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 dark:focus:ring-emerald-900 transition-all outline-none bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500"
                                    required
                                >
                                <button type="button" onclick="togglePassword('password_confirmation')" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Status Active -->
                        <div class="flex items-center gap-3 pt-2">
                            <input 
                                type="checkbox" 
                                id="is_active" 
                                name="is_active" 
                                value="1"
                                {{ old('is_active', true) ? 'checked' : '' }}
                                class="w-5 h-5 text-emerald-600 border-gray-300 dark:border-gray-600 rounded focus:ring-emerald-500 focus:ring-2 bg-white dark:bg-gray-700"
                            >
                            <label for="is_active" class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                Aktifkan pengguna setelah dibuat
                            </label>
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
                                Simpan Pengguna
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
                preview.innerHTML = `<img src="${e.target.result}" alt="Preview" class="w-full h-full object-cover">`;
            }
            reader.readAsDataURL(file);
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