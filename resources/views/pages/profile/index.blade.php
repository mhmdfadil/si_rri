@extends('layouts.app')

@section('title', 'Profile Saya')
@section('page-title', 'Profile Saya')
@section('page-subtitle', 'Kelola informasi profile dan keamanan akun Anda')

@section('content')
<div class="max-w-full mx-auto">
    
    <!-- Success Message -->
    @if(session('success'))
    <div class="bg-emerald-50 border-l-4 border-emerald-500 p-4 mb-6 rounded-lg">
        <div class="flex items-center">
            <svg class="w-5 h-5 text-emerald-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <p class="text-emerald-700 font-medium">{{ session('success') }}</p>
        </div>
    </div>
    @endif

    <!-- Profile Information Card -->
    <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden mb-6">
        
        <!-- Card Header -->
        <div class="bg-gradient-to-r from-emerald-500 to-teal-500 px-6 py-4">
            <h2 class="text-xl font-bold text-white flex items-center gap-2">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                Informasi Profile
            </h2>
            <p class="text-emerald-50 text-sm mt-1">Perbarui informasi profile dan foto Anda</p>
        </div>

        <!-- Card Body -->
        <div class="p-6">
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    
                    <!-- Photo Section -->
                    <div class="lg:col-span-1">
                        <div class="text-center">
                            <div class="relative inline-block">
                                <div class="w-32 h-32 rounded-full overflow-hidden border-4 border-emerald-100 shadow-lg">
                                    @if($user->photos)
                                        <img id="photoPreview" src="{{ $user->photo_url }}" alt="Profile Photo" class="w-full h-full object-cover">
                                    @else
                                        <div id="photoPreview" class="w-full h-full bg-gradient-to-br from-emerald-500 to-teal-500 flex items-center justify-center text-white text-4xl font-bold">
                                            {{ strtoupper(substr($user->name, 0, 2)) }}
                                        </div>
                                    @endif
                                </div>
                                @if($user->photos)
                                <button type="button" onclick="deletePhoto()" class="absolute bottom-0 right-0 bg-red-500 text-white p-2 rounded-full hover:bg-red-600 transition-colors shadow-lg">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                                @endif
                            </div>
                            
                            <div class="mt-4">
                                <label for="photos" class="cursor-pointer inline-flex items-center gap-2 bg-emerald-50 text-emerald-700 px-4 py-2 rounded-lg hover:bg-emerald-100 transition-colors font-medium text-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    Pilih Foto
                                </label>
                                <input type="file" id="photos" name="photos" class="hidden" accept="image/*" onchange="previewPhoto(event)">
                                <p class="text-xs text-gray-500 mt-2">JPG, PNG, GIF (Max. 2MB)</p>
                                @error('photos')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Form Fields -->
                    <div class="lg:col-span-2 space-y-4">
                        
                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                Nama Lengkap <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                id="name" 
                                name="name" 
                                value="{{ old('name', $user->name) }}"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 transition-all outline-none @error('name') border-red-500 @enderror"
                                required
                            >
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Username -->
                        <div>
                            <label for="username" class="block text-sm font-medium text-gray-700 mb-2">
                                Username <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                id="username" 
                                name="username" 
                                value="{{ old('username', $user->username) }}"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 transition-all outline-none @error('username') border-red-500 @enderror"
                                required
                            >
                            @error('username')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                Email <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                value="{{ old('email', $user->email) }}"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 transition-all outline-none @error('email') border-red-500 @enderror"
                                required
                            >
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Account Info -->
                        <div class="bg-gray-50 rounded-lg p-4 mt-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                                <div>
                                    <p class="text-gray-600">Status Akun</p>
                                    <p class="font-medium text-gray-800 flex items-center gap-2 mt-1">
                                        @if($user->is_active)
                                            <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                                            Aktif
                                        @else
                                            <span class="w-2 h-2 bg-red-500 rounded-full"></span>
                                            Non-Aktif
                                        @endif
                                    </p>
                                </div>
                                <div>
                                    <p class="text-gray-600">Login Terakhir</p>
                                    <p class="font-medium text-gray-800 mt-1">
                                        {{ $user->last_login_at ? $user->last_login_at->format('d M Y, H:i') : 'Belum pernah login' }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end pt-4">
                            <button 
                                type="submit" 
                                class="bg-gradient-to-r from-emerald-500 to-teal-500 text-white px-6 py-2.5 rounded-lg font-medium hover:shadow-lg transition-all flex items-center gap-2"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Change Password Card -->
    <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
        
        <!-- Card Header -->
        <div class="bg-gradient-to-r from-orange-500 to-red-500 px-6 py-4">
            <h2 class="text-xl font-bold text-white flex items-center gap-2">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
                Ubah Password
            </h2>
            <p class="text-orange-50 text-sm mt-1">Perbarui password untuk keamanan akun Anda</p>
        </div>

        <!-- Card Body -->
        <div class="p-6">
            <form action="{{ route('profile.password') }}" method="POST" id="passwordForm">
                @csrf
                @method('PUT')

                <div class="space-y-4 max-w-md">
                    
                    <!-- Current Password -->
                    <div>
                        <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2">
                            Password Saat Ini <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input 
                                type="password" 
                                id="current_password" 
                                name="current_password" 
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-orange-500 focus:ring-2 focus:ring-orange-100 transition-all outline-none @error('current_password') border-red-500 @enderror"
                                required
                            >
                            <button type="button" onclick="togglePassword('current_password')" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </button>
                        </div>
                        @error('current_password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- New Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                            Password Baru <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input 
                                type="password" 
                                id="password" 
                                name="password" 
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-orange-500 focus:ring-2 focus:ring-orange-100 transition-all outline-none @error('password') border-red-500 @enderror"
                                required
                                oninput="checkPasswordStrength(this.value)"
                            >
                            <button type="button" onclick="togglePassword('password')" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                        
                        <!-- Password Strength Criteria -->
                        <div class="mt-3 bg-gray-50 rounded-lg p-3 border border-gray-200">
                            <p class="text-xs font-semibold text-gray-700 mb-2">Kriteria Password:</p>
                            <ul class="space-y-1.5">
                                <li id="length-check" class="flex items-center gap-2 text-xs text-gray-500 transition-colors">
                                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <circle cx="12" cy="12" r="10" stroke-width="2"></circle>
                                    </svg>
                                    <span>Minimal 8 karakter</span>
                                </li>
                                <li id="uppercase-check" class="flex items-center gap-2 text-xs text-gray-500 transition-colors">
                                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <circle cx="12" cy="12" r="10" stroke-width="2"></circle>
                                    </svg>
                                    <span>Minimal 1 huruf besar (A-Z)</span>
                                </li>
                                <li id="lowercase-check" class="flex items-center gap-2 text-xs text-gray-500 transition-colors">
                                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <circle cx="12" cy="12" r="10" stroke-width="2"></circle>
                                    </svg>
                                    <span>Minimal 1 huruf kecil (a-z)</span>
                                </li>
                                <li id="symbol-check" class="flex items-center gap-2 text-xs text-gray-500 transition-colors">
                                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <circle cx="12" cy="12" r="10" stroke-width="2"></circle>
                                    </svg>
                                    <span>Minimal 1 simbol (!@#$%^&*)</span>
                                </li>
                            </ul>

                            <!-- Password Strength Bar -->
                            <div class="mt-3">
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="text-xs font-medium text-gray-600">Kekuatan:</span>
                                    <span id="strength-text" class="text-xs font-semibold text-gray-400">-</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2 overflow-hidden">
                                    <div id="strength-bar" class="h-full bg-gray-300 transition-all duration-300 rounded-full" style="width: 0%"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                            Konfirmasi Password Baru <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input 
                                type="password" 
                                id="password_confirmation" 
                                name="password_confirmation" 
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-orange-500 focus:ring-2 focus:ring-orange-100 transition-all outline-none"
                                required
                                oninput="checkPasswordMatch()"
                            >
                            <button type="button" onclick="togglePassword('password_confirmation')" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </button>
                        </div>
                        <p id="password-match-message" class="text-xs mt-1 hidden"></p>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-4">
                        <button 
                            type="submit" 
                            id="submitPasswordBtn"
                            class="bg-gradient-to-r from-orange-500 to-red-500 text-white px-6 py-2.5 rounded-lg font-medium hover:shadow-lg transition-all flex items-center gap-2 disabled:opacity-50 disabled:cursor-not-allowed"
                            disabled
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                            Ubah Password
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Photo Form (Hidden) -->
    <form id="deletePhotoForm" action="{{ route('profile.photo.delete') }}" method="POST" class="hidden">
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
                preview.innerHTML = `<img src="${e.target.result}" alt="Preview" class="w-full h-full object-cover">`;
            }
            reader.readAsDataURL(file);
        }
    }

    // Delete photo
    function deletePhoto() {
        if (confirm('Apakah Anda yakin ingin menghapus foto profile?')) {
            document.getElementById('deletePhotoForm').submit();
        }
    }

    // Toggle password visibility
    function togglePassword(fieldId) {
        const field = document.getElementById(fieldId);
        const type = field.getAttribute('type') === 'password' ? 'text' : 'password';
        field.setAttribute('type', type);
    }

    // Check password strength
    function checkPasswordStrength(password) {
        const lengthCheck = document.getElementById('length-check');
        const uppercaseCheck = document.getElementById('uppercase-check');
        const lowercaseCheck = document.getElementById('lowercase-check');
        const symbolCheck = document.getElementById('symbol-check');
        const strengthBar = document.getElementById('strength-bar');
        const strengthText = document.getElementById('strength-text');

        let strength = 0;

        // Check length
        if (password.length >= 8) {
            updateCheckStatus(lengthCheck, true);
            strength++;
        } else {
            updateCheckStatus(lengthCheck, false);
        }

        // Check uppercase
        if (/[A-Z]/.test(password)) {
            updateCheckStatus(uppercaseCheck, true);
            strength++;
        } else {
            updateCheckStatus(uppercaseCheck, false);
        }

        // Check lowercase
        if (/[a-z]/.test(password)) {
            updateCheckStatus(lowercaseCheck, true);
            strength++;
        } else {
            updateCheckStatus(lowercaseCheck, false);
        }

        // Check symbol
        if (/[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(password)) {
            updateCheckStatus(symbolCheck, true);
            strength++;
        } else {
            updateCheckStatus(symbolCheck, false);
        }

        // Update strength bar
        const percentage = (strength / 4) * 100;
        strengthBar.style.width = percentage + '%';

        if (strength === 0) {
            strengthBar.className = 'h-full bg-gray-300 transition-all duration-300 rounded-full';
            strengthText.textContent = '-';
            strengthText.className = 'text-xs font-semibold text-gray-400';
        } else if (strength === 1) {
            strengthBar.className = 'h-full bg-red-500 transition-all duration-300 rounded-full';
            strengthText.textContent = 'Lemah';
            strengthText.className = 'text-xs font-semibold text-red-500';
        } else if (strength === 2) {
            strengthBar.className = 'h-full bg-orange-500 transition-all duration-300 rounded-full';
            strengthText.textContent = 'Sedang';
            strengthText.className = 'text-xs font-semibold text-orange-500';
        } else if (strength === 3) {
            strengthBar.className = 'h-full bg-yellow-500 transition-all duration-300 rounded-full';
            strengthText.textContent = 'Baik';
            strengthText.className = 'text-xs font-semibold text-yellow-500';
        } else if (strength === 4) {
            strengthBar.className = 'h-full bg-green-500 transition-all duration-300 rounded-full';
            strengthText.textContent = 'Sangat Kuat';
            strengthText.className = 'text-xs font-semibold text-green-500';
        }

        // Check if all criteria met and passwords match
        checkFormValidity(strength === 4);
    }

    // Update check status
    function updateCheckStatus(element, isValid) {
        const svg = element.querySelector('svg');
        const span = element.querySelector('span');

        if (isValid) {
            element.className = 'flex items-center gap-2 text-xs text-green-600 transition-colors';
            svg.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>';
            svg.classList.add('text-green-600');
        } else {
            element.className = 'flex items-center gap-2 text-xs text-gray-500 transition-colors';
            svg.innerHTML = '<circle cx="12" cy="12" r="10" stroke-width="2"></circle>';
            svg.classList.remove('text-green-600');
        }
    }

    // Check password match
    function checkPasswordMatch() {
        const password = document.getElementById('password').value;
        const confirmation = document.getElementById('password_confirmation').value;
        const message = document.getElementById('password-match-message');

        if (confirmation === '') {
            message.classList.add('hidden');
            checkFormValidity();
            return;
        }

        if (password === confirmation) {
            message.textContent = '✓ Password cocok';
            message.className = 'text-xs mt-1 text-green-600';
            message.classList.remove('hidden');
        } else {
            message.textContent = '✗ Password tidak cocok';
            message.className = 'text-xs mt-1 text-red-500';
            message.classList.remove('hidden');
        }

        checkFormValidity();
    }

    // Check form validity
    function checkFormValidity(allCriteriaMet = null) {
        const password = document.getElementById('password').value;
        const confirmation = document.getElementById('password_confirmation').value;
        const currentPassword = document.getElementById('current_password').value;
        const submitBtn = document.getElementById('submitPasswordBtn');

        // If allCriteriaMet is not passed, check it
        if (allCriteriaMet === null) {
            allCriteriaMet = password.length >= 8 && 
                           /[A-Z]/.test(password) && 
                           /[a-z]/.test(password) && 
                           /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(password);
        }

        const passwordsMatch = password === confirmation && confirmation !== '';
        const hasCurrentPassword = currentPassword !== '';

        if (allCriteriaMet && passwordsMatch && hasCurrentPassword) {
            submitBtn.disabled = false;
            submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
        } else {
            submitBtn.disabled = true;
            submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
        }
    }

    // Add event listener for current password
    document.getElementById('current_password').addEventListener('input', checkFormValidity);
</script>
@endpush
@endsection