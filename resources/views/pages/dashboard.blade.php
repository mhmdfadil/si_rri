@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard Overview')
@section('page-subtitle', 'Selamat datang di sistem database RRI')

@section('content')
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
@endsection