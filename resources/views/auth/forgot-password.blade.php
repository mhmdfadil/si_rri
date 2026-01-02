<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - RRI Lhokseumawe</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-25px) rotate(5deg); }
        }
        @keyframes float-delayed {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-30px) rotate(-5deg); }
        }
        .float-animation {
            animation: float 8s ease-in-out infinite;
        }
        .float-delayed {
            animation: float-delayed 10s ease-in-out infinite;
        }
        @keyframes pulse-glow {
            0%, 100% { opacity: 0.15; transform: scale(1); }
            50% { opacity: 0.25; transform: scale(1.05); }
        }
        .pulse-glow {
            animation: pulse-glow 6s ease-in-out infinite;
        }
        @keyframes shimmer {
            0% { background-position: -1000px 0; }
            100% { background-position: 1000px 0; }
        }
        .shimmer {
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            background-size: 1000px 100%;
            animation: shimmer 3s infinite;
        }
        @keyframes wave {
            0% { transform: translateX(0) translateY(0); }
            50% { transform: translateX(20px) translateY(-10px); }
            100% { transform: translateX(0) translateY(0); }
        }
        .wave-animation {
            animation: wave 15s ease-in-out infinite;
        }
        .glass-effect {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(20px);
            box-shadow: 0 8px 32px 0 rgba(16, 185, 129, 0.15);
        }
        .gradient-text {
            background: linear-gradient(135deg, #059669 0%, #10b981 50%, #34d399 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        @keyframes slideIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .slide-in {
            animation: slideIn 0.5s ease-out;
        }
        .password-strength-bar {
            height: 4px;
            border-radius: 2px;
            transition: all 0.3s ease;
        }
    </style>
</head>
<body class="antialiased">
    <div class="min-h-screen w-full flex items-center justify-center bg-gradient-to-br from-emerald-50 via-teal-50 to-green-50 p-4 relative overflow-hidden">
        
        <!-- Animated Background Blobs -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute top-0 -left-20 w-96 h-96 bg-emerald-300 rounded-full mix-blend-multiply filter blur-3xl pulse-glow"></div>
            <div class="absolute top-1/4 right-10 w-[500px] h-[500px] bg-teal-300 rounded-full mix-blend-multiply filter blur-3xl pulse-glow" style="animation-delay: 2s;"></div>
            <div class="absolute -bottom-32 left-1/3 w-[450px] h-[450px] bg-green-300 rounded-full mix-blend-multiply filter blur-3xl pulse-glow" style="animation-delay: 4s;"></div>
            <div class="absolute top-1/2 left-1/4 w-80 h-80 bg-emerald-200 rounded-full mix-blend-multiply filter blur-3xl pulse-glow" style="animation-delay: 1s;"></div>
        </div>

        <!-- Floating Decorative Icons -->
        <div class="absolute top-20 right-24 opacity-10 float-animation">
            <svg class="w-20 h-20 text-emerald-600" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
            </svg>
        </div>
        <div class="absolute bottom-32 left-20 opacity-10 float-delayed">
            <svg class="w-24 h-24 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
            </svg>
        </div>

        <!-- Main Card -->
        <div class="w-full max-w-5xl mx-auto glass-effect rounded-3xl overflow-hidden relative z-10 border border-emerald-100/50">
            <div class="grid md:grid-cols-2 gap-0">
                
                <!-- Left Side - Branding -->
                <div class="hidden md:flex flex-col justify-center items-center p-12 bg-gradient-to-br from-emerald-500 via-teal-500 to-emerald-600 text-white relative overflow-hidden">
                    <div class="absolute inset-0 opacity-10">
                        <div class="absolute inset-0" style="background-image: radial-gradient(circle, white 1px, transparent 1px); background-size: 30px 30px;"></div>
                    </div>
                    <div class="absolute inset-0 shimmer"></div>
                    
                    <div class="relative z-10 text-center">
                        <div class="mb-8 flex justify-center">
                            <div class="relative">
                                <div class="absolute inset-0 bg-white/20 blur-2xl rounded-full"></div>
                                <div class="relative bg-white/25 backdrop-blur-xl p-6 rounded-3xl border-2 border-white/30 shadow-2xl">
                                    <svg class="w-16 h-16 text-white drop-shadow-lg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        
                        <h1 class="text-4xl font-extrabold mb-2 tracking-tight drop-shadow-lg">
                            Pemulihan Akun
                        </h1>
                        <div class="w-24 h-1 bg-white/60 mx-auto mb-6 rounded-full"></div>
                        
                        <p class="text-lg font-semibold mb-4 text-white/95">
                            Reset Password Administrator
                        </p>
                        
                        <p class="text-sm text-white/80 leading-relaxed px-4 mb-8">
                            Ikuti langkah-langkah untuk mengatur ulang password akun administrator Anda dengan aman
                        </p>
                        
                        <div class="bg-white/20 backdrop-blur-sm rounded-2xl p-6 border border-white/30">
                            <h3 class="text-sm font-bold mb-4 text-white">Langkah Pemulihan:</h3>
                            <div class="space-y-3 text-left">
                                <div class="flex items-start gap-3">
                                    <div class="bg-white/30 rounded-full w-6 h-6 flex items-center justify-center flex-shrink-0 mt-0.5">
                                        <span class="text-xs font-bold">1</span>
                                    </div>
                                    <p class="text-sm text-white/90">Masukkan email atau username terdaftar</p>
                                </div>
                                <div class="flex items-start gap-3">
                                    <div class="bg-white/30 rounded-full w-6 h-6 flex items-center justify-center flex-shrink-0 mt-0.5">
                                        <span class="text-xs font-bold">2</span>
                                    </div>
                                    <p class="text-sm text-white/90">Verifikasi dengan CAPTCHA</p>
                                </div>
                                <div class="flex items-start gap-3">
                                    <div class="bg-white/30 rounded-full w-6 h-6 flex items-center justify-center flex-shrink-0 mt-0.5">
                                        <span class="text-xs font-bold">3</span>
                                    </div>
                                    <p class="text-sm text-white/90">Buat password baru yang kuat</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Side - Form -->
                <div class="p-8 md:p-10 flex flex-col justify-center bg-white">
                    <!-- Mobile Logo -->
                    <div class="md:hidden mb-6 text-center">
                        <div class="inline-flex bg-gradient-to-br from-emerald-500 to-teal-600 p-4 rounded-2xl mb-3 shadow-lg">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        <h2 class="text-xl font-bold gradient-text">RRI Lhokseumawe</h2>
                    </div>

                    <!-- Step Indicator -->
                    <div class="mb-6">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center gap-2">
                                <div id="step1-indicator" class="w-8 h-8 rounded-full bg-emerald-500 text-white flex items-center justify-center text-sm font-bold">1</div>
                                <div class="w-12 h-1 bg-gray-200" id="line1"></div>
                            </div>
                            <div class="flex items-center gap-2">
                                <div id="step2-indicator" class="w-8 h-8 rounded-full bg-gray-200 text-gray-400 flex items-center justify-center text-sm font-bold">2</div>
                                <div class="w-12 h-1 bg-gray-200" id="line2"></div>
                            </div>
                            <div id="step3-indicator" class="w-8 h-8 rounded-full bg-gray-200 text-gray-400 flex items-center justify-center text-sm font-bold">3</div>
                        </div>
                        <p class="text-xs text-gray-500 text-center" id="step-text">Langkah 1: Verifikasi Identitas</p>
                    </div>

                    <!-- Alert Container -->
                    <div id="alert-container"></div>

                    <!-- Step 1: Email/Username & CAPTCHA -->
                    <div id="step1" class="slide-in">
                        <div class="mb-6">
                            <h2 class="text-3xl font-bold text-gray-800 mb-2">Lupa Password?</h2>
                            <p class="text-gray-600 text-sm">Masukkan email atau username Anda untuk memulai proses pemulihan</p>
                        </div>

                        <div class="space-y-5">
                            <div class="space-y-2">
                                <label for="identifier" class="block text-sm font-bold text-gray-700">
                                    Email atau Username
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                    <input
                                        id="identifier"
                                        type="text"
                                        class="w-full pl-12 pr-4 py-3.5 border-2 border-gray-200 rounded-xl focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100 transition-all duration-300 outline-none text-gray-800"
                                        placeholder="admin@rri.co.id atau admin_rri"
                                    />
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label class="block text-sm font-bold text-gray-700">
                                    Verifikasi CAPTCHA
                                </label>
                                <div class="bg-gray-50 border-2 border-gray-200 rounded-xl p-4">
                                    <div class="flex items-center justify-between mb-3">
                                        <div class="bg-white px-4 py-2 rounded-lg border-2 border-emerald-500 font-mono text-2xl font-bold text-gray-700 select-none tracking-widest" id="captcha-text"></div>
                                        <button type="button" onclick="generateCaptcha()" class="p-2 hover:bg-gray-200 rounded-lg transition-colors">
                                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                            </svg>
                                        </button>
                                    </div>
                                    <input
                                        id="captcha-input"
                                        type="text"
                                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100 transition-all duration-300 outline-none"
                                        placeholder="Masukkan kode di atas"
                                    />
                                </div>
                            </div>

                            <button
                                type="button"
                                onclick="verifyStep1()"
                                class="w-full bg-gradient-to-r from-emerald-500 via-teal-500 to-emerald-600 text-white py-4 px-6 rounded-xl font-bold shadow-xl hover:shadow-2xl hover:from-emerald-600 hover:via-teal-600 hover:to-emerald-700 transform hover:-translate-y-1 transition-all duration-300 relative overflow-hidden group"
                            >
                                <span class="relative z-10 flex items-center justify-center gap-2">
                                    Verifikasi & Lanjutkan
                                    <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                    </svg>
                                </span>
                                <div class="absolute inset-0 shimmer"></div>
                            </button>
                        </div>
                    </div>

                    <!-- Step 2: New Password -->
                    <div id="step2" class="hidden">
                        <div class="mb-6">
                            <h2 class="text-3xl font-bold text-gray-800 mb-2">Buat Password Baru</h2>
                            <p class="text-gray-600 text-sm">Password harus memenuhi kriteria keamanan yang ditentukan</p>
                        </div>

                        <div class="space-y-5">
                            <div class="space-y-2">
                                <label for="new-password" class="block text-sm font-bold text-gray-700">
                                    Password Baru
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                        </svg>
                                    </div>
                                    <input
                                        id="new-password"
                                        type="password"
                                        oninput="checkPasswordStrength()"
                                        class="w-full pl-12 pr-12 py-3.5 border-2 border-gray-200 rounded-xl focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100 transition-all duration-300 outline-none"
                                        placeholder="Minimal 8 karakter"
                                    />
                                    <button type="button" onclick="togglePasswordVisibility('new-password', 'eye-new', 'eye-off-new')" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-emerald-600 transition-colors">
                                        <svg id="eye-new" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        <svg id="eye-off-new" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                                        </svg>
                                    </button>
                                </div>
                                <div class="mt-2">
                                    <div class="flex gap-1 mb-2">
                                        <div id="strength-bar-1" class="password-strength-bar flex-1 bg-gray-200"></div>
                                        <div id="strength-bar-2" class="password-strength-bar flex-1 bg-gray-200"></div>
                                        <div id="strength-bar-3" class="password-strength-bar flex-1 bg-gray-200"></div>
                                        <div id="strength-bar-4" class="password-strength-bar flex-1 bg-gray-200"></div>
                                    </div>
                                    <p id="strength-text" class="text-xs text-gray-500">Kekuatan password: -</p>
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label for="confirm-password" class="block text-sm font-bold text-gray-700">
                                    Konfirmasi Password
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                        </svg>
                                    </div>
                                    <input
                                        id="confirm-password"
                                        type="password"
                                        class="w-full pl-12 pr-12 py-3.5 border-2 border-gray-200 rounded-xl focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100 transition-all duration-300 outline-none"
                                        placeholder="Ketik ulang password"
                                    />
                                    <button type="button" onclick="togglePasswordVisibility('confirm-password', 'eye-confirm', 'eye-off-confirm')" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-emerald-600 transition-colors">
                                        <svg id="eye-confirm" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        <svg id="eye-off-confirm" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <div class="bg-blue-50 border border-blue-200 rounded-xl p-4">
                                <p class="text-sm font-bold text-blue-800 mb-2">Kriteria Password:</p>
                                <ul class="space-y-1 text-xs text-blue-700">
                                    <li id="req-length" class="flex items-center gap-2">
                                        <span class="text-gray-400">○</span> Minimal 8 karakter
                                    </li>
                                    <li id="req-upper" class="flex items-center gap-2">
                                        <span class="text-gray-400">○</span> Minimal 1 huruf besar (A-Z)
                                    </li>
                                    <li id="req-lower" class="flex items-center gap-2">
                                        <span class="text-gray-400">○</span> Minimal 1 huruf kecil (a-z)
                                    </li>
                                    <li id="req-symbol" class="flex items-center gap-2">
                                        <span class="text-gray-400">○</span> Minimal 1 simbol (!@#$%^&*)
                                    </li>
                                </ul>
                            </div>

                            <button
                                type="button"
                                onclick="verifyStep2()"
                                class="w-full bg-gradient-to-r from-emerald-500 via-teal-500 to-emerald-600 text-white py-4 px-6 rounded-xl font-bold shadow-xl hover:shadow-2xl hover:from-emerald-600 hover:via-teal-600 hover:to-emerald-700 transform hover:-translate-y-1 transition-all duration-300 relative overflow-hidden group"
                            >
                                <span class="relative z-10 flex items-center justify-center gap-2">
                                    Reset Password
                                    <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </span>
                                <div class="absolute inset-0 shimmer"></div>
                            </button>
                        </div>
                    </div>

                    <!-- Step 3: Success -->
                    <div id="step3" class="hidden text-center">
                        <div class="mb-6">
                            <div class="w-20 h-20 bg-emerald-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-10 h-10 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h2 class="text-3xl font-bold text-gray-800 mb-3">Password Berhasil Direset!</h2>
                            <p class="text-gray-600 mb-8">Password Anda telah berhasil diperbarui. Silakan login dengan password baru Anda.</p>
                            
                            <div class="bg-emerald-50 border border-emerald-200 rounded-xl p-6 mb-6 text-left">
                                <div class="flex items-start gap-3 mb-3">
                                    <svg class="w-5 h-5 text-emerald-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <div>
                                        <p class="text-sm font-bold text-emerald-800 mb-1">Tips Keamanan:</p>
                                        <ul class="text-xs text-emerald-700 space-y-1">
                                            <li>• Jangan bagikan password Anda kepada siapapun</li>
                                            <li>• Gunakan password yang berbeda untuk setiap akun</li>
                                            <li>• Ubah password secara berkala</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <a href="#" onclick="location.reload()" class="inline-flex items-center justify-center gap-2 bg-gradient-to-r from-emerald-500 via-teal-500 to-emerald-600 text-white py-4 px-8 rounded-xl font-bold shadow-xl hover:shadow-2xl hover:from-emerald-600 hover:via-teal-600 hover:to-emerald-700 transform hover:-translate-y-1 transition-all duration-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                </svg>
                                Kembali ke Halaman Login
                            </a>
                        </div>
                    </div>

                    <!-- Back to Login Link -->
                    <div class="mt-6 text-center">
                        <a href="#" onclick="location.reload()" class="text-sm text-emerald-600 hover:text-emerald-700 font-bold transition-colors inline-flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Kembali ke Login
                        </a>
                    </div>

                    <!-- Copyright -->
                    <div class="mt-8 pt-6 border-t border-gray-200 text-center">
                        <p class="text-xs text-gray-500 font-medium">
                            © 2025 Radio Republik Indonesia Lhokseumawe
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Data dummy users
        const dummyUsers = [
            { identifier: 'admin@rri.co.id', name: 'Administrator Utama' },
            { identifier: 'admin_rri', name: 'Admin RRI Lhokseumawe' },
            { identifier: 'operator@rri.co.id', name: 'Operator Siaran' }
        ];

        let currentCaptcha = '';
        let currentUser = null;

        // Generate CAPTCHA
        function generateCaptcha() {
            const chars = 'ABCDEFGHJKLMNPQRSTUVWXYZabcdefghjkmnpqrstuvwxyz23456789';
            let captcha = '';
            for (let i = 0; i < 6; i++) {
                captcha += chars.charAt(Math.floor(Math.random() * chars.length));
            }
            currentCaptcha = captcha;
            document.getElementById('captcha-text').textContent = captcha;
        }

        // Show alert
        function showAlert(type, message) {
            const container = document.getElementById('alert-container');
            const alertClass = type === 'success' ? 'bg-emerald-50 border-emerald-200 text-emerald-800' :
                               type === 'error' ? 'bg-red-50 border-red-200 text-red-800' :
                               'bg-blue-50 border-blue-200 text-blue-800';
            
            const icon = type === 'success' ? 
                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>' :
                type === 'error' ?
                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>' :
                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>';

            container.innerHTML = `
                <div class="mb-5 ${alertClass} border rounded-xl p-4 slide-in">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            ${icon}
                        </svg>
                        <p class="text-sm font-medium">${message}</p>
                    </div>
                </div>
            `;

            setTimeout(() => {
                container.innerHTML = '';
            }, 5000);
        }

        // Update step indicator
        function updateStepIndicator(step) {
            const indicators = ['step1-indicator', 'step2-indicator', 'step3-indicator'];
            const lines = ['line1', 'line2'];
            const texts = [
                'Langkah 1: Verifikasi Identitas',
                'Langkah 2: Buat Password Baru',
                'Langkah 3: Selesai'
            ];

            indicators.forEach((id, index) => {
                const element = document.getElementById(id);
                if (index < step) {
                    element.className = 'w-8 h-8 rounded-full bg-emerald-500 text-white flex items-center justify-center text-sm font-bold';
                } else if (index === step) {
                    element.className = 'w-8 h-8 rounded-full bg-emerald-500 text-white flex items-center justify-center text-sm font-bold';
                } else {
                    element.className = 'w-8 h-8 rounded-full bg-gray-200 text-gray-400 flex items-center justify-center text-sm font-bold';
                }
            });

            lines.forEach((id, index) => {
                const element = document.getElementById(id);
                if (index < step) {
                    element.className = 'w-12 h-1 bg-emerald-500';
                } else {
                    element.className = 'w-12 h-1 bg-gray-200';
                }
            });

            document.getElementById('step-text').textContent = texts[step];
        }

        // Verify Step 1
        function verifyStep1() {
            const identifier = document.getElementById('identifier').value.trim();
            const captchaInput = document.getElementById('captcha-input').value.trim();

            if (!identifier) {
                showAlert('error', 'Mohon masukkan email atau username Anda.');
                return;
            }

            if (!captchaInput) {
                showAlert('error', 'Mohon masukkan kode CAPTCHA.');
                return;
            }

            if (captchaInput !== currentCaptcha) {
                showAlert('error', 'Kode CAPTCHA tidak sesuai. Silakan coba lagi.');
                generateCaptcha();
                document.getElementById('captcha-input').value = '';
                return;
            }

            // Check if user exists
            const user = dummyUsers.find(u => u.identifier.toLowerCase() === identifier.toLowerCase());
            
            if (!user) {
                showAlert('error', 'Email atau username tidak ditemukan dalam sistem.');
                generateCaptcha();
                document.getElementById('captcha-input').value = '';
                return;
            }

            currentUser = user;
            showAlert('info', `Akun ditemukan: ${user.name}. Silakan buat password baru Anda.`);

            // Move to step 2
            setTimeout(() => {
                document.getElementById('step1').classList.add('hidden');
                document.getElementById('step2').classList.remove('hidden');
                document.getElementById('step2').classList.add('slide-in');
                updateStepIndicator(1);
            }, 1500);
        }

        // Check password strength
        function checkPasswordStrength() {
            const password = document.getElementById('new-password').value;
            const requirements = {
                length: password.length >= 8,
                upper: /[A-Z]/.test(password),
                lower: /[a-z]/.test(password),
                symbol: /[!@#$%^&*(),.?":{}|<>]/.test(password)
            };

            // Update requirement checklist
            updateRequirement('req-length', requirements.length);
            updateRequirement('req-upper', requirements.upper);
            updateRequirement('req-lower', requirements.lower);
            updateRequirement('req-symbol', requirements.symbol);

            // Calculate strength
            const strength = Object.values(requirements).filter(Boolean).length;
            updateStrengthBar(strength);
        }

        function updateRequirement(id, met) {
            const element = document.getElementById(id);
            if (met) {
                element.innerHTML = element.innerHTML.replace('○', '✓').replace('text-gray-400', 'text-emerald-600');
                element.className = 'flex items-center gap-2 text-emerald-600';
            } else {
                element.innerHTML = element.innerHTML.replace('✓', '○');
                if (element.innerHTML.includes('text-emerald-600')) {
                    element.innerHTML = element.innerHTML.replace('text-emerald-600', 'text-gray-400');
                }
                element.className = 'flex items-center gap-2';
            }
        }

        function updateStrengthBar(strength) {
            const bars = ['strength-bar-1', 'strength-bar-2', 'strength-bar-3', 'strength-bar-4'];
            const colors = ['bg-red-500', 'bg-orange-500', 'bg-yellow-500', 'bg-emerald-500'];
            const texts = ['Sangat Lemah', 'Lemah', 'Sedang', 'Kuat'];
            const textColors = ['text-red-600', 'text-orange-600', 'text-yellow-600', 'text-emerald-600'];

            bars.forEach((id, index) => {
                const element = document.getElementById(id);
                element.className = 'password-strength-bar flex-1 ' + (index < strength ? colors[strength - 1] : 'bg-gray-200');
            });

            const strengthText = document.getElementById('strength-text');
            if (strength > 0) {
                strengthText.textContent = `Kekuatan password: ${texts[strength - 1]}`;
                strengthText.className = `text-xs font-medium ${textColors[strength - 1]}`;
            } else {
                strengthText.textContent = 'Kekuatan password: -';
                strengthText.className = 'text-xs text-gray-500';
            }
        }

        // Toggle password visibility
        function togglePasswordVisibility(inputId, eyeId, eyeOffId) {
            const input = document.getElementById(inputId);
            const eyeIcon = document.getElementById(eyeId);
            const eyeOffIcon = document.getElementById(eyeOffId);

            if (input.type === 'password') {
                input.type = 'text';
                eyeIcon.classList.add('hidden');
                eyeOffIcon.classList.remove('hidden');
            } else {
                input.type = 'password';
                eyeIcon.classList.remove('hidden');
                eyeOffIcon.classList.add('hidden');
            }
        }

        // Verify Step 2
        function verifyStep2() {
            const newPassword = document.getElementById('new-password').value;
            const confirmPassword = document.getElementById('confirm-password').value;

            // Validate password requirements
            const requirements = {
                length: newPassword.length >= 8,
                upper: /[A-Z]/.test(newPassword),
                lower: /[a-z]/.test(newPassword),
                symbol: /[!@#$%^&*(),.?":{}|<>]/.test(newPassword)
            };

            if (!newPassword || !confirmPassword) {
                showAlert('error', 'Mohon lengkapi semua field password.');
                return;
            }

            if (!requirements.length) {
                showAlert('error', 'Password harus minimal 8 karakter.');
                return;
            }

            if (!requirements.upper) {
                showAlert('error', 'Password harus mengandung minimal 1 huruf besar.');
                return;
            }

            if (!requirements.lower) {
                showAlert('error', 'Password harus mengandung minimal 1 huruf kecil.');
                return;
            }

            if (!requirements.symbol) {
                showAlert('error', 'Password harus mengandung minimal 1 simbol.');
                return;
            }

            if (newPassword !== confirmPassword) {
                showAlert('error', 'Password dan konfirmasi password tidak sama.');
                return;
            }

            showAlert('success', 'Password berhasil direset!');

            // Move to step 3
            setTimeout(() => {
                document.getElementById('step2').classList.add('hidden');
                document.getElementById('step3').classList.remove('hidden');
                document.getElementById('step3').classList.add('slide-in');
                updateStepIndicator(2);
            }, 1500);
        }

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            generateCaptcha();
        });
    </script>
</body>
</html>