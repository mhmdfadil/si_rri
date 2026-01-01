<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login Admin - RRI Lhokseumawe</title>
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
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"></path>
            </svg>
        </div>
        <div class="absolute top-1/3 left-16 opacity-10 wave-animation">
            <svg class="w-16 h-16 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"></path>
            </svg>
        </div>

        <!-- Main Login Card -->
        <div class="w-full max-w-6xl mx-auto grid md:grid-cols-5 gap-0 glass-effect rounded-3xl overflow-hidden relative z-10 border border-emerald-100/50">
            
            <!-- Left Side - Branding (3 columns) -->
            <div class="hidden md:flex md:col-span-3 flex-col justify-center items-center p-16 bg-gradient-to-br from-emerald-500 via-teal-500 to-emerald-600 text-white relative overflow-hidden">
                <!-- Decorative Background Pattern -->
                <div class="absolute inset-0 opacity-10">
                    <div class="absolute inset-0" style="background-image: radial-gradient(circle, white 1px, transparent 1px); background-size: 30px 30px;"></div>
                </div>
                
                <!-- Shimmer Effect Overlay -->
                <div class="absolute inset-0 shimmer"></div>
                
                <div class="relative z-10 text-center max-w-xl">
                    <!-- Logo Container -->
                    <div class="mb-10 flex justify-center">
                        <div class="relative">
                            <div class="absolute inset-0 bg-white/20 blur-2xl rounded-full"></div>
                            <div class="relative bg-white/25 backdrop-blur-xl p-8 rounded-3xl border-2 border-white/30 shadow-2xl transform hover:scale-105 transition-transform duration-500">
                                <svg class="w-20 h-20 text-white drop-shadow-lg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Main Title -->
                    <h1 class="text-5xl font-extrabold mb-3 tracking-tight drop-shadow-lg">
                        RRI Lhokseumawe
                    </h1>
                    <div class="w-32 h-1.5 bg-white/60 mx-auto mb-8 rounded-full"></div>
                    
                    <!-- Subtitle -->
                    <p class="text-2xl font-semibold mb-6 text-white/95">
                        Sistem Database Narasumber
                    </p>
                    
                    <!-- Description -->
                    <p class="text-base text-white/85 leading-relaxed px-4 mb-10">
                        Platform terintegrasi untuk pengelolaan data narasumber dan konten penyiaran Radio Republik Indonesia Lhokseumawe
                    </p>
                    
                    <!-- Admin Badge -->
                    <div class="inline-flex items-center gap-2 bg-white/20 backdrop-blur-sm px-6 py-3 rounded-full border border-white/30">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                        <span class="text-sm font-bold text-white">Administrator Access Only</span>
                    </div>
                    
                    <!-- Feature Highlights -->
                    <div class="grid grid-cols-3 gap-6 mt-12">
                        <div class="text-center transform hover:scale-110 transition-transform duration-300">
                            <div class="bg-white/20 backdrop-blur-sm w-14 h-14 rounded-2xl flex items-center justify-center mx-auto mb-3 border border-white/30">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                            </div>
                            <p class="text-sm font-medium text-white/90">Data Narasumber</p>
                        </div>
                        <div class="text-center transform hover:scale-110 transition-transform duration-300">
                            <div class="bg-white/20 backdrop-blur-sm w-14 h-14 rounded-2xl flex items-center justify-center mx-auto mb-3 border border-white/30">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <p class="text-sm font-medium text-white/90">Konten Siaran</p>
                        </div>
                        <div class="text-center transform hover:scale-110 transition-transform duration-300">
                            <div class="bg-white/20 backdrop-blur-sm w-14 h-14 rounded-2xl flex items-center justify-center mx-auto mb-3 border border-white/30">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                </svg>
                            </div>
                            <p class="text-sm font-medium text-white/90">Aman Terpercaya</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side - Login Form (2 columns) -->
            <div class="md:col-span-2 p-10 md:p-12 flex flex-col justify-center bg-white">
                <!-- Mobile Logo -->
                <div class="md:hidden mb-8 text-center">
                    <div class="inline-flex bg-gradient-to-br from-emerald-500 to-teal-600 p-5 rounded-3xl mb-4 shadow-lg">
                        <svg class="w-14 h-14 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold gradient-text">RRI Lhokseumawe</h2>
                </div>

                <!-- Welcome Text -->
                <div class="mb-8">
                    <div class="inline-flex items-center gap-2 bg-emerald-50 text-emerald-700 px-4 py-2 rounded-lg mb-4 border border-emerald-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                        <span class="text-xs font-bold">Admin Area</span>
                    </div>
                    <h2 class="text-4xl font-bold text-gray-800 mb-3 tracking-tight">Selamat Datang</h2>
                    <p class="text-gray-600 text-base">Masuk sebagai Administrator</p>
                </div>

                <!-- Alert Messages -->
                <div id="alert-container"></div>

                <!-- Login Form -->
                <form id="loginForm" class="space-y-6">
                    @csrf
                    
                    <!-- Email/Username Input -->
                    <div class="space-y-2">
                        <label for="email" class="block text-sm font-bold text-gray-700">
                            Email atau Username
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <input
                                id="email"
                                type="text"
                                name="email"
                                class="w-full pl-12 pr-4 py-3.5 border-2 border-gray-200 rounded-xl focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100 transition-all duration-300 outline-none text-gray-800 placeholder-gray-400"
                                placeholder="Masukkan email atau username"
                                required
                            />
                        </div>
                    </div>

                    <!-- Password Input -->
                    <div class="space-y-2">
                        <label for="password" class="block text-sm font-bold text-gray-700">
                            Password
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                            </div>
                            <input
                                id="password"
                                type="password"
                                name="password"
                                class="w-full pl-12 pr-12 py-3.5 border-2 border-gray-200 rounded-xl focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100 transition-all duration-300 outline-none text-gray-800 placeholder-gray-400"
                                placeholder="Masukkan password"
                                required
                            />
                            <button
                                type="button"
                                onclick="togglePassword()"
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-emerald-600 transition-colors"
                            >
                                <svg id="eye-icon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                <svg id="eye-off-icon" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between">
                        <label class="flex items-center cursor-pointer group">
                            <input type="checkbox" name="remember" class="w-4 h-4 text-emerald-600 border-gray-300 rounded focus:ring-emerald-500 cursor-pointer" />
                            <span class="ml-2 text-sm text-gray-700 group-hover:text-emerald-600 transition-colors">Ingat saya</span>
                        </label>
                        <a href="#" class="text-sm text-emerald-600 hover:text-emerald-700 font-bold transition-colors">
                            Lupa password?
                        </a>
                    </div>

                    <!-- Login Button -->
                    <button
                        type="submit"
                        id="loginButton"
                        class="w-full bg-gradient-to-r from-emerald-500 via-teal-500 to-emerald-600 text-white py-4 px-6 rounded-xl font-bold text-base shadow-xl hover:shadow-2xl hover:from-emerald-600 hover:via-teal-600 hover:to-emerald-700 transform hover:-translate-y-1 active:translate-y-0 transition-all duration-300 relative overflow-hidden group"
                    >
                        <span class="relative z-10 flex items-center justify-center gap-2">
                            <span id="buttonText">Masuk ke Dashboard</span>
                            <svg id="buttonIcon" class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                            <svg id="loadingIcon" class="w-5 h-5 animate-spin hidden" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </span>
                        <div class="absolute inset-0 shimmer"></div>
                    </button>
                </form>

                <!-- Copyright -->
                <div class="mt-10 pt-6 border-t border-gray-200 text-center">
                    <p class="text-xs text-gray-500 font-medium">
                        © 2025 Radio Republik Indonesia Lhokseumawe
                    </p>
                    <p class="text-xs text-gray-400 mt-1">All rights reserved</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Toggle password visibility
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');
            const eyeOffIcon = document.getElementById('eye-off-icon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.add('hidden');
                eyeOffIcon.classList.remove('hidden');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('hidden');
                eyeOffIcon.classList.add('hidden');
            }
        }

        // Show alert message
        function showAlert(message, type = 'error') {
            const alertContainer = document.getElementById('alert-container');
            const bgColor = type === 'success' ? 'bg-emerald-50 border-emerald-500 text-emerald-800' : 'bg-red-50 border-red-500 text-red-800';
            const icon = type === 'success' 
                ? '<svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>'
                : '<svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>';
            
            alertContainer.innerHTML = `
                <div class="${bgColor} border-l-4 p-4 rounded-lg mb-6 animate-pulse">
                    <div class="flex items-center">
                        ${icon}
                        <p class="ml-3 text-sm font-medium">${message}</p>
                    </div>
                </div>
            `;
            
            // Auto hide after 5 seconds
            setTimeout(() => {
                alertContainer.innerHTML = '';
            }, 5000);
        }

        // Handle login form submission
        document.getElementById('loginForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const loginButton = document.getElementById('loginButton');
            const buttonText = document.getElementById('buttonText');
            const buttonIcon = document.getElementById('buttonIcon');
            const loadingIcon = document.getElementById('loadingIcon');
            const alertContainer = document.getElementById('alert-container');
            
            // Clear previous alerts
            alertContainer.innerHTML = '';
            
            // Disable button and show loading
            loginButton.disabled = true;
            buttonText.textContent = 'Memproses...';
            buttonIcon.classList.add('hidden');
            loadingIcon.classList.remove('hidden');
            
            // Get form data
            const formData = new FormData(this);
            
            try {
                const response = await fetch('{{ route("login.submit") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                    },
                    body: formData
                });
                
                const data = await response.json();
                
                if (data.success) {
                    showAlert(data.message, 'success');
                    
                    // Redirect after 1 second
                    setTimeout(() => {
                        window.location.href = data.redirect;
                    }, 1000);
                } else {
                    showAlert(data.message, 'error');
                    
                    // Re-enable button
                    loginButton.disabled = false;
                    buttonText.textContent = 'Masuk ke Dashboard';
                    buttonIcon.classList.remove('hidden');
                    loadingIcon.classList.add('hidden');
                }
            } catch (error) {
                showAlert('Terjadi kesalahan. Silakan coba lagi.', 'error');
                
                // Re-enable button
                loginButton.disabled = false;
                buttonText.textContent = 'Masuk ke Dashboard';
                buttonIcon.classList.remove('hidden');
                loadingIcon.classList.add('hidden');
            }
        });
    </script>
</body>
</html>