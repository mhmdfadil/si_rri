<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard - RRI Lhokseumawe</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes slideIn {
            from { transform: translateX(-100%); }
            to { transform: translateX(0); }
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .sidebar-enter {
            animation: slideIn 0.3s ease-out;
        }
        .overlay-enter {
            animation: fadeIn 0.3s ease-out;
        }
        .gradient-text {
            background: linear-gradient(135deg, #059669 0%, #10b981 50%, #34d399 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        /* Custom scrollbar */
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #10b981;
            border-radius: 3px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #059669;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-emerald-50 via-teal-50 to-green-50 min-h-screen">
    
    <!-- Main Container -->
    <div class="flex h-screen overflow-hidden">
        
        <!-- Sidebar -->
        <aside id="sidebar" class="fixed lg:static inset-y-0 left-0 z-50 w-64 bg-white shadow-2xl transform -translate-x-full lg:translate-x-0 transition-transform duration-300 flex flex-col">
            
            <!-- Sidebar Header -->
            <div class="h-16 flex items-center justify-between px-6 border-b border-gray-200 bg-gradient-to-r from-emerald-500 to-teal-500">
                <div class="flex items-center gap-3">
                    <div class="bg-white/20 backdrop-blur-sm p-2 rounded-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-white font-bold text-sm">RRI</h2>
                        <p class="text-white/80 text-xs">Lhokseumawe</p>
                    </div>
                </div>
                <button id="closeSidebar" class="lg:hidden text-white hover:bg-white/20 p-1.5 rounded-lg transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Sidebar Navigation -->
            <nav class="flex-1 overflow-y-auto custom-scrollbar p-4">
                <div class="space-y-1">
                    <!-- Dashboard -->
                    <a href="#" class="flex items-center gap-3 px-4 py-3 text-white bg-gradient-to-r from-emerald-500 to-teal-500 rounded-xl font-medium transition-all hover:shadow-lg group">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        <span>Dashboard</span>
                    </a>

                    <!-- Narasumber -->
                    <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-emerald-50 rounded-xl font-medium transition-all group">
                        <svg class="w-5 h-5 text-gray-400 group-hover:text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                        <span>Data Narasumber</span>
                    </a>

                    <!-- Konten Siaran -->
                    <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-emerald-50 rounded-xl font-medium transition-all group">
                        <svg class="w-5 h-5 text-gray-400 group-hover:text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <span>Konten Siaran</span>
                    </a>

                    <!-- Program -->
                    <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-emerald-50 rounded-xl font-medium transition-all group">
                        <svg class="w-5 h-5 text-gray-400 group-hover:text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"></path>
                        </svg>
                        <span>Program Siaran</span>
                    </a>

                    <!-- Divider -->
                    <div class="py-2">
                        <div class="border-t border-gray-200"></div>
                    </div>

                    <!-- Kategori -->
                    <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-emerald-50 rounded-xl font-medium transition-all group">
                        <svg class="w-5 h-5 text-gray-400 group-hover:text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                        <span>Kategori</span>
                    </a>

                    <!-- Laporan -->
                    <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-emerald-50 rounded-xl font-medium transition-all group">
                        <svg class="w-5 h-5 text-gray-400 group-hover:text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <span>Laporan</span>
                    </a>

                    <!-- Divider -->
                    <div class="py-2">
                        <div class="border-t border-gray-200"></div>
                    </div>

                    <!-- Pengaturan -->
                    <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-emerald-50 rounded-xl font-medium transition-all group">
                        <svg class="w-5 h-5 text-gray-400 group-hover:text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span>Pengaturan</span>
                    </a>
                </div>
            </nav>

            <!-- Sidebar Footer -->
            <div class="p-4 border-t border-gray-200">
                <div class="bg-gradient-to-br from-emerald-50 to-teal-50 rounded-xl p-4 border border-emerald-200">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-teal-500 rounded-full flex items-center justify-center text-white font-bold text-sm">
                            AD
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-bold text-gray-800">Admin User</p>
                            <p class="text-xs text-gray-600">Administrator</p>
                        </div>
                    </div>
                    <button class="w-full bg-white border border-emerald-200 text-emerald-700 py-2 px-3 rounded-lg text-sm font-medium hover:bg-emerald-50 transition-colors flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        Logout
                    </button>
                </div>
            </div>
        </aside>

        <!-- Overlay for mobile -->
        <div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden lg:hidden"></div>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col overflow-hidden">
            
            <!-- Navbar -->
            <header class="h-16 bg-white shadow-md flex items-center justify-between px-4 lg:px-6 z-30">
                
                <!-- Left Side -->
                <div class="flex items-center gap-4">
                    <button id="openSidebar" class="lg:hidden text-gray-700 hover:bg-gray-100 p-2 rounded-lg transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                    
                    <div class="hidden lg:block">
                        <h1 class="text-xl font-bold text-gray-800">Dashboard</h1>
                        <p class="text-xs text-gray-600">Selamat datang di sistem database RRI</p>
                    </div>
                </div>

                <!-- Right Side -->
                <div class="flex items-center gap-3">
                    
                    <!-- Search Button (Mobile) -->
                    <button class="lg:hidden text-gray-700 hover:bg-gray-100 p-2 rounded-lg transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>

                    <!-- Search Bar (Desktop) -->
                    <div class="hidden lg:flex relative">
                        <input 
                            type="text" 
                            placeholder="Cari..." 
                            class="w-64 pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 transition-all outline-none text-sm"
                        />
                        <svg class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>

                    <!-- Notifications -->
                    <button class="relative text-gray-700 hover:bg-gray-100 p-2 rounded-lg transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                        <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                    </button>

                    <!-- User Profile -->
                    <div class="hidden lg:flex items-center gap-2 pl-3 border-l border-gray-300">
                        <div class="w-9 h-9 bg-gradient-to-br from-emerald-500 to-teal-500 rounded-full flex items-center justify-center text-white font-bold text-sm">
                            AD
                        </div>
                        <div class="hidden xl:block">
                            <p class="text-sm font-bold text-gray-800 leading-tight">Admin User</p>
                            <p class="text-xs text-gray-600">Administrator</p>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content Wrapper -->
            <main class="flex-1 overflow-y-auto custom-scrollbar">
                <div class="p-4 lg:p-6">
                    
                    <!-- Page Content -->
                    <div class="max-w-7xl mx-auto">
                        
                        <!-- Stats Cards -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                            
                            <!-- Card 1 -->
                            <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-100 hover:shadow-xl transition-shadow">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-teal-500 rounded-xl flex items-center justify-center">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                        </svg>
                                    </div>
                                    <span class="text-xs font-medium text-emerald-600 bg-emerald-50 px-2 py-1 rounded-full">+12%</span>
                                </div>
                                <h3 class="text-2xl font-bold text-gray-800 mb-1">256</h3>
                                <p class="text-sm text-gray-600">Total Narasumber</p>
                            </div>

                            <!-- Card 2 -->
                            <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-100 hover:shadow-xl transition-shadow">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-500 rounded-xl flex items-center justify-center">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                    </div>
                                    <span class="text-xs font-medium text-blue-600 bg-blue-50 px-2 py-1 rounded-full">+8%</span>
                                </div>
                                <h3 class="text-2xl font-bold text-gray-800 mb-1">1,429</h3>
                                <p class="text-sm text-gray-600">Konten Siaran</p>
                            </div>

                            <!-- Card 3 -->
                            <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-100 hover:shadow-xl transition-shadow">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-500 rounded-xl flex items-center justify-center">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"></path>
                                        </svg>
                                    </div>
                                    <span class="text-xs font-medium text-purple-600 bg-purple-50 px-2 py-1 rounded-full">Active</span>
                                </div>
                                <h3 class="text-2xl font-bold text-gray-800 mb-1">24</h3>
                                <p class="text-sm text-gray-600">Program Siaran</p>
                            </div>

                            <!-- Card 4 -->
                            <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-100 hover:shadow-xl transition-shadow">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="w-12 h-12 bg-gradient-to-br from-orange-500 to-red-500 rounded-xl flex items-center justify-center">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                        </svg>
                                    </div>
                                    <span class="text-xs font-medium text-orange-600 bg-orange-50 px-2 py-1 rounded-full">+18%</span>
                                </div>
                                <h3 class="text-2xl font-bold text-gray-800 mb-1">89.2%</h3>
                                <p class="text-sm text-gray-600">Engagement Rate</p>
                            </div>
                        </div>

                        <!-- Content Section -->
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                            
                            <!-- Recent Activity -->
                            <div class="lg:col-span-2 bg-white rounded-xl shadow-lg border border-gray-100 p-6">
                                <div class="flex items-center justify-between mb-6">
                                    <h2 class="text-lg font-bold text-gray-800">Aktivitas Terbaru</h2>
                                    <button class="text-sm text-emerald-600 hover:text-emerald-700 font-medium">Lihat Semua</button>
                                </div>
                                
                                <div class="space-y-4">
                                    <!-- Activity Item -->
                                    <div class="flex items-start gap-4 p-4 hover:bg-gray-50 rounded-lg transition-colors">
                                        <div class="w-10 h-10 bg-emerald-100 rounded-full flex items-center justify-center flex-shrink-0">
                                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                            </svg>
                                        </div>
                                        <div class="flex-1">
                                            <p class="text-sm font-medium text-gray-800">Program siaran selesai</p>
                                            <p class="text-xs text-gray-600 mt-1">Berita Siang - 12:00 WIB</p>
                                            <p class="text-xs text-gray-400 mt-1">1 hari yang lalu</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Quick Stats -->
                            <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6">
                                <h2 class="text-lg font-bold text-gray-800 mb-6">Statistik Cepat</h2>
                                
                                <div class="space-y-6">
                                    <!-- Stat Item -->
                                    <div>
                                        <div class="flex items-center justify-between mb-2">
                                            <span class="text-sm font-medium text-gray-700">Narasumber Aktif</span>
                                            <span class="text-sm font-bold text-emerald-600">78%</span>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-2">
                                            <div class="bg-gradient-to-r from-emerald-500 to-teal-500 h-2 rounded-full" style="width: 78%"></div>
                                        </div>
                                    </div>

                                    <!-- Stat Item -->
                                    <div>
                                        <div class="flex items-center justify-between mb-2">
                                            <span class="text-sm font-medium text-gray-700">Konten Bulan Ini</span>
                                            <span class="text-sm font-bold text-blue-600">92%</span>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-2">
                                            <div class="bg-gradient-to-r from-blue-500 to-indigo-500 h-2 rounded-full" style="width: 92%"></div>
                                        </div>
                                    </div>

                                    <!-- Stat Item -->
                                    <div>
                                        <div class="flex items-center justify-between mb-2">
                                            <span class="text-sm font-medium text-gray-700">Target Program</span>
                                            <span class="text-sm font-bold text-purple-600">65%</span>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-2">
                                            <div class="bg-gradient-to-r from-purple-500 to-pink-500 h-2 rounded-full" style="width: 65%"></div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Quick Actions -->
                                <div class="mt-8 pt-6 border-t border-gray-200">
                                    <h3 class="text-sm font-bold text-gray-800 mb-4">Aksi Cepat</h3>
                                    <div class="space-y-2">
                                        <button class="w-full bg-gradient-to-r from-emerald-500 to-teal-500 text-white py-2.5 px-4 rounded-lg font-medium text-sm hover:shadow-lg transition-all flex items-center justify-center gap-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                            </svg>
                                            Tambah Narasumber
                                        </button>
                                        <button class="w-full bg-white border-2 border-emerald-200 text-emerald-700 py-2.5 px-4 rounded-lg font-medium text-sm hover:bg-emerald-50 transition-all flex items-center justify-center gap-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                            Buat Konten Baru
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Additional Content Example -->
                        <div class="mt-6 bg-white rounded-xl shadow-lg border border-gray-100 p-6">
                            <h2 class="text-lg font-bold text-gray-800 mb-4">Area Konten Utama</h2>
                            <div class="bg-gradient-to-br from-emerald-50 to-teal-50 border-2 border-dashed border-emerald-300 rounded-xl p-12 text-center">
                                <svg class="w-16 h-16 text-emerald-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path>
                                </svg>
                                <h3 class="text-xl font-bold text-gray-800 mb-2">Konten Halaman Anda</h3>
                                <p class="text-gray-600 max-w-md mx-auto">
                                    Area ini akan menampilkan konten halaman sesuai dengan menu yang dipilih. 
                                    Konten tidak akan melewati batas layout yang telah ditentukan.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

            <!-- Footer -->
            <footer class="bg-white border-t border-gray-200 px-4 lg:px-6 py-4">
                <div class="max-w-7xl mx-auto">
                    <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                        <div class="text-center md:text-left">
                            <p class="text-sm font-medium text-gray-700">
                                © 2025 Radio Republik Indonesia Lhokseumawe
                            </p>
                            <p class="text-xs text-gray-500 mt-1">
                                Sistem Database Narasumber v1.0
                            </p>
                        </div>
                        
                        <div class="flex items-center gap-6">
                            <a href="#" class="text-xs text-gray-600 hover:text-emerald-600 transition-colors font-medium">
                                Bantuan
                            </a>
                            <a href="#" class="text-xs text-gray-600 hover:text-emerald-600 transition-colors font-medium">
                                Dokumentasi
                            </a>
                            <a href="#" class="text-xs text-gray-600 hover:text-emerald-600 transition-colors font-medium">
                                Kontak
                            </a>
                        </div>
                        
                        <div class="flex items-center gap-2">
                            <div class="flex items-center gap-1.5 bg-emerald-50 px-3 py-1.5 rounded-full">
                                <div class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></div>
                                <span class="text-xs font-medium text-emerald-700">System Online</span>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script>
        // Sidebar Toggle
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        const openSidebarBtn = document.getElementById('openSidebar');
        const closeSidebarBtn = document.getElementById('closeSidebar');

        function openSidebar() {
            sidebar.classList.remove('-translate-x-full');
            sidebar.classList.add('sidebar-enter');
            overlay.classList.remove('hidden');
            overlay.classList.add('overlay-enter');
            document.body.style.overflow = 'hidden';
        }

        function closeSidebar() {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
            document.body.style.overflow = '';
        }

        openSidebarBtn.addEventListener('click', openSidebar);
        closeSidebarBtn.addEventListener('click', closeSidebar);
        overlay.addEventListener('click', closeSidebar);

        // Close sidebar on ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeSidebar();
            }
        });

        // Handle window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 1024) {
                closeSidebar();
            }
        });

        // Prevent content overflow
        function checkContentOverflow() {
            const mainContent = document.querySelector('main');
            const contentWrapper = document.querySelector('.max-w-7xl');
            
            if (contentWrapper && mainContent) {
                const mainRect = mainContent.getBoundingClientRect();
                const contentRect = contentWrapper.getBoundingClientRect();
                
                // Ensure content stays within bounds
                if (contentRect.width > mainRect.width) {
                    contentWrapper.style.maxWidth = '100%';
                }
            }
        }

        // Check on load and resize
        window.addEventListener('load', checkContentOverflow);
        window.addEventListener('resize', checkContentOverflow);

        // Active menu highlight (example)
        const menuLinks = document.querySelectorAll('nav a');
        menuLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                // Remove active class from all links
                menuLinks.forEach(l => {
                    l.classList.remove('bg-gradient-to-r', 'from-emerald-500', 'to-teal-500', 'text-white');
                    l.classList.add('text-gray-700', 'hover:bg-emerald-50');
                });
                
                // Add active class to clicked link
                this.classList.remove('text-gray-700', 'hover:bg-emerald-50');
                this.classList.add('bg-gradient-to-r', 'from-emerald-500', 'to-teal-500', 'text-white');
            });
        });
    </script>
</body>
</html> 