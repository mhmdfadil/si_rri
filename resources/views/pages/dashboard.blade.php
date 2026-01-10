@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard Overview')
@section('page-subtitle', 'Sistem Informasi Manajemen Konten Siaran RRI Lhokseumawe')

@section('content')
<div class="max-w-full mx-auto">
    
    <!-- Welcome Banner -->
    <div class="bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-500 rounded-xl shadow-lg p-8 mb-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold mb-2">Selamat Datang, {{ auth()->user()->name }}! 👋</h1>
                <p class="text-blue-100">{{ now()->format('l, d F Y') }}</p>
                <p class="text-blue-50 text-sm mt-1">Kelola konten siaran Anda dengan mudah dan efisien</p>
            </div>
            <div class="hidden lg:block">
                <svg class="w-32 h-32 text-white opacity-20" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M2 5a2 2 0 012-2h7a2 2 0 012 2v4a2 2 0 01-2 2H9l-3 3v-3H4a2 2 0 01-2-2V5z"></path>
                    <path d="M15 7v2a4 4 0 01-4 4H9.828l-1.766 1.767c.28.149.599.233.938.233h2l3 3v-3h2a2 2 0 002-2V9a2 2 0 00-2-2h-1z"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Main Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        
        <!-- Total Konten -->
        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg border border-gray-100 dark:border-gray-700 hover:shadow-xl transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Total Konten</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ number_format($stats['total_konten']) }}</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">Semua konten siaran</p>
                </div>
                <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-indigo-500 rounded-xl flex items-center justify-center">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Narasumber -->
        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg border border-gray-100 dark:border-gray-700 hover:shadow-xl transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Total Narasumber</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ number_format($stats['total_narasumber']) }}</p>
                    <p class="text-xs text-green-600 dark:text-green-400 mt-2">{{ $stats['narasumber_aktif'] }} aktif</p>
                </div>
                <div class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-teal-500 rounded-xl flex items-center justify-center">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Program -->
        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg border border-gray-100 dark:border-gray-700 hover:shadow-xl transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Total Program</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ number_format($stats['total_program']) }}</p>
                    <p class="text-xs text-purple-600 dark:text-purple-400 mt-2">{{ $stats['program_aktif'] }} aktif</p>
                </div>
                <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-pink-500 rounded-xl flex items-center justify-center">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Kategori -->
        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg border border-gray-100 dark:border-gray-700 hover:shadow-xl transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Total Kategori</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ number_format($stats['total_kategori']) }}</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">Kategori konten</p>
                </div>
                <div class="w-16 h-16 bg-gradient-to-br from-orange-500 to-red-500 rounded-xl flex items-center justify-center">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-6">
        <div class="bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-900/30 dark:to-blue-800/30 border border-blue-200 dark:border-blue-700 rounded-xl p-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-blue-700 dark:text-blue-300 font-medium">Hari Ini</p>
                    <p class="text-2xl font-bold text-blue-900 dark:text-blue-100">{{ $stats['konten_hari_ini'] }}</p>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 dark:from-yellow-900/30 dark:to-yellow-800/30 border border-yellow-200 dark:border-yellow-700 rounded-xl p-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-yellow-500 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-yellow-700 dark:text-yellow-300 font-medium">Siap Tayang</p>
                    <p class="text-2xl font-bold text-yellow-900 dark:text-yellow-100">{{ $stats['konten_siap_tayang'] }}</p>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-green-50 to-green-100 dark:from-green-900/30 dark:to-green-800/30 border border-green-200 dark:border-green-700 rounded-xl p-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-green-700 dark:text-green-300 font-medium">Tayang</p>
                    <p class="text-2xl font-bold text-green-900 dark:text-green-100">{{ $stats['konten_tayang'] }}</p>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-purple-50 to-purple-100 dark:from-purple-900/30 dark:to-purple-800/30 border border-purple-200 dark:border-purple-700 rounded-xl p-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-purple-500 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-purple-700 dark:text-purple-300 font-medium">Diajukan</p>
                    <p class="text-2xl font-bold text-purple-900 dark:text-purple-100">{{ $stats['konten_diajukan'] }}</p>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-800/50 dark:to-gray-700/50 border border-gray-200 dark:border-gray-600 rounded-xl p-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-gray-500 dark:bg-gray-600 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-gray-700 dark:text-gray-300 font-medium">Draft</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $stats['konten_draft'] }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        
        <!-- Konten Hari Ini -->
        <div class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-100 dark:border-gray-700 overflow-hidden">
            <div class="bg-gradient-to-r from-blue-500 to-indigo-500 px-6 py-4 flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-bold text-white flex items-center gap-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        Jadwal Siaran Hari Ini
                    </h2>
                    <p class="text-blue-50 text-sm mt-1">{{ $kontenHariIni->count() }} konten dijadwalkan</p>
                </div>
                <a href="{{ route('konten-siaran.index', ['filter_tanggal' => 'hari_ini']) }}" class="bg-white text-blue-600 px-4 py-2 rounded-lg hover:bg-blue-50 transition-colors font-medium text-sm">
                    Lihat Semua
                </a>
            </div>
            <div class="divide-y divide-gray-200 dark:divide-gray-700 max-h-96 overflow-y-auto">
                @forelse($kontenHariIni as $konten)
                <div class="p-4 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                    <div class="flex items-start gap-4">
                        <div class="text-center bg-blue-50 dark:bg-blue-900/30 rounded-lg p-3 flex-shrink-0">
                            <p class="text-xs text-blue-600 dark:text-blue-400 font-medium">{{ \Carbon\Carbon::parse($konten->jam_siaran)->format('H:i') }}</p>
                            <p class="text-xs text-blue-500 dark:text-blue-300 mt-1">WIB</p>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="font-bold text-gray-900 dark:text-white text-sm line-clamp-1">{{ $konten->judul }}</h3>
                            <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">{{ $konten->program->nama_program ?? '-' }}</p>
                            <div class="flex items-center gap-2 mt-2">
                                @if($konten->tipe_siaran == 'live')
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-xs font-medium bg-red-50 dark:bg-red-900/30 text-red-700 dark:text-red-300">
                                    <span class="w-1.5 h-1.5 bg-red-500 rounded-full"></span>
                                    Live
                                </span>
                                @endif
                                <span class="text-xs text-gray-500 dark:text-gray-400">{{ $konten->durasi }} menit</span>
                                @if($konten->narasumbers->count() > 0)
                                <span class="text-xs text-gray-500 dark:text-gray-400">• {{ $konten->narasumbers->count() }} narasumber</span>
                                @endif
                            </div>
                        </div>
                        <a href="{{ route('konten-siaran.show', $konten) }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
                @empty
                <div class="p-12 text-center">
                    <svg class="w-16 h-16 text-gray-300 dark:text-gray-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <p class="text-gray-500 dark:text-gray-400 font-medium">Tidak ada jadwal siaran hari ini</p>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Konten Butuh Persetujuan -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-100 dark:border-gray-700 overflow-hidden">
            <div class="bg-gradient-to-r from-purple-500 to-pink-500 px-6 py-4">
                <h2 class="text-lg font-bold text-white flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Butuh Persetujuan
                </h2>
                <p class="text-purple-50 text-sm mt-1">{{ $kontenButuhPersetujuan->count() }} konten</p>
            </div>
            <div class="divide-y divide-gray-200 dark:divide-gray-700 max-h-96 overflow-y-auto">
                @forelse($kontenButuhPersetujuan as $konten)
                <div class="p-4 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                    <h3 class="font-bold text-gray-900 dark:text-white text-sm line-clamp-2">{{ $konten->judul }}</h3>
                    <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">{{ $konten->program->nama_program ?? '-' }}</p>
                    <div class="flex items-center justify-between mt-2">
                        <span class="text-xs text-gray-500 dark:text-gray-400">{{ $konten->tanggal_diajukan->diffForHumans() }}</span>
                        <a href="{{ route('konten-siaran.show', $konten) }}" class="text-purple-600 dark:text-purple-400 hover:text-purple-800 dark:hover:text-purple-300 text-xs font-medium">
                            Review →
                        </a>
                    </div>
                </div>
                @empty
                <div class="p-8 text-center">
                    <svg class="w-12 h-12 text-gray-300 dark:text-gray-600 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="text-gray-500 dark:text-gray-400 text-sm">Tidak ada konten yang menunggu persetujuan</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        
        <!-- Konten Upcoming -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-100 dark:border-gray-700 overflow-hidden">
            <div class="bg-gradient-to-r from-emerald-500 to-teal-500 px-6 py-4">
                <h2 class="text-lg font-bold text-white flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Upcoming (7 Hari)
                </h2>
                <p class="text-emerald-50 text-sm mt-1">{{ $kontenUpcoming->count() }} konten akan tayang</p>
            </div>
            <div class="divide-y divide-gray-200 dark:divide-gray-700 max-h-80 overflow-y-auto">
                @forelse($kontenUpcoming as $konten)
                <div class="p-4 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                    <div class="flex items-start gap-3">
                        <div class="text-center bg-emerald-50 dark:bg-emerald-900/30 rounded-lg p-2 flex-shrink-0">
                            <p class="text-xs text-emerald-600 dark:text-emerald-400 font-bold">{{ $konten->tanggal_siaran->format('d') }}</p>
                            <p class="text-xs text-emerald-500 dark:text-emerald-300">{{ $konten->tanggal_siaran->format('M') }}</p>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="font-bold text-gray-900 dark:text-white text-sm line-clamp-1">{{ $konten->judul }}</h3>
                            <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">{{ $konten->program->nama_program ?? '-' }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ \Carbon\Carbon::parse($konten->jam_siaran)->format('H:i') }} WIB</p>
                        </div>
                    </div>
                </div>
                @empty
                <div class="p-8 text-center">
                    <p class="text-gray-500 dark:text-gray-400 text-sm">Tidak ada konten upcoming</p>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Narasumber Populer -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-100 dark:border-gray-700 overflow-hidden">
            <div class="bg-gradient-to-r from-orange-500 to-red-500 px-6 py-4">
                <h2 class="text-lg font-bold text-white flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                    </svg>
                    Narasumber Populer
                </h2>
            </div>
            <div class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($narasumberPopuler as $narasumber)
                <div class="p-4 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                    <div class="flex items-center gap-3">
                        <img src="{{ $narasumber->foto_profil_url }}" alt="{{ $narasumber->nama_lengkap }}" class="w-12 h-12 rounded-full object-cover border-2 border-orange-200 dark:border-orange-700">
                        <div class="flex-1 min-w-0">
                            <h3 class="font-bold text-gray-900 dark:text-white text-sm line-clamp-1">{{ $narasumber->nama_lengkap }}</h3>
                            <p class="text-xs text-gray-600 dark:text-gray-400 mt-0.5">{{ $narasumber->instansi ?? 'Independen' }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-lg font-bold text-orange-600 dark:text-orange-400">{{ $narasumber->konten_siarans_count }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">konten</p>
                        </div>
                    </div>
                </div>
                @empty
                <div class="p-8 text-center">
                    <p class="text-gray-500 dark:text-gray-400 text-sm">Belum ada data</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Charts -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        
        <!-- Konten per Bulan Chart -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-100 dark:border-gray-700 overflow-hidden">
            <div class="bg-gradient-to-r from-cyan-500 to-blue-500 px-6 py-4">
                <h2 class="text-lg font-bold text-white">Konten per Bulan (6 Bulan Terakhir)</h2>
            </div>
            <div class="p-6">
                <canvas id="kontenPerBulanChart" height="200"></canvas>
            </div>
        </div>

        <!-- Konten per Status Chart -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-100 dark:border-gray-700 overflow-hidden">
            <div class="bg-gradient-to-r from-pink-500 to-rose-500 px-6 py-4">
                <h2 class="text-lg font-bold text-white">Konten per Status</h2>
            </div>
            <div class="p-6">
                <canvas id="kontenPerStatusChart" height="200"></canvas>
            </div>
        </div>
    </div>

    <!-- Recent Activities -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-100 dark:border-gray-700 overflow-hidden">
        <div class="bg-gradient-to-r from-indigo-500 to-purple-500 px-6 py-4">
            <h2 class="text-lg font-bold text-white flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Aktivitas Terbaru
            </h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 dark:bg-gray-700/50 border-b border-gray-200 dark:border-gray-600">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase">Judul</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase">Program</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase">Dibuat Oleh</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase">Waktu</th>
                        <th class="px-6 py-3 text-center text-xs font-bold text-gray-700 dark:text-gray-300 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($recentActivities as $activity)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                        <td class="px-6 py-4">
                            <p class="font-medium text-gray-900 dark:text-white text-sm line-clamp-1">{{ $activity->judul }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ $activity->kode_konten }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm text-gray-700 dark:text-gray-300">{{ $activity->program->nama_program ?? '-' }}</p>
                        </td>
                        <td class="px-6 py-4">
                            @php
                                $statusColors = [
                                    'draft' => 'gray',
                                    'diajukan' => 'blue',
                                    'disetujui' => 'green',
                                    'ditolak' => 'red',
                                    'siap_tayang' => 'yellow',
                                    'tayang' => 'green',
                                    'selesai' => 'gray',
                                ];
                                $color = $statusColors[$activity->status] ?? 'gray';
                            @endphp
                            <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-{{ $color }}-50 dark:bg-{{ $color }}-900/30 text-{{ $color }}-700 dark:text-{{ $color }}-300">
                                {{ $activity->status_text }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm text-gray-700 dark:text-gray-300">{{ $activity->pengaju->name ?? '-' }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm text-gray-700 dark:text-gray-300">{{ $activity->created_at->diffForHumans() }}</p>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <a href="{{ route('konten-siaran.show', $activity) }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300">
                                <svg class="w-5 h-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center">
                            <p class="text-gray-500 dark:text-gray-400">Belum ada aktivitas</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Function to get chart colors based on theme
    function getChartColors() {
        const isDark = document.documentElement.classList.contains('dark');
        return {
            gridColor: isDark ? 'rgba(75, 85, 99, 0.3)' : 'rgba(209, 213, 219, 0.5)',
            textColor: isDark ? 'rgba(243, 244, 246, 0.8)' : 'rgba(55, 65, 81, 0.8)',
            tooltipBg: isDark ? 'rgba(31, 41, 55, 0.9)' : 'rgba(255, 255, 255, 0.9)',
            tooltipBorder: isDark ? 'rgba(75, 85, 99, 0.5)' : 'rgba(209, 213, 219, 0.5)',
        };
    }

    // Konten per Bulan Chart
    const kontenPerBulanCtx = document.getElementById('kontenPerBulanChart').getContext('2d');
    let kontenPerBulanChart = new Chart(kontenPerBulanCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode(array_column($kontenPerBulan, 'bulan')) !!},
            datasets: [{
                label: 'Jumlah Konten',
                data: {!! json_encode(array_column($kontenPerBulan, 'total')) !!},
                borderColor: 'rgb(59, 130, 246)',
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: getChartColors().tooltipBg,
                    titleColor: getChartColors().textColor,
                    bodyColor: getChartColors().textColor,
                    borderColor: getChartColors().tooltipBorder,
                    borderWidth: 1
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1,
                        color: getChartColors().textColor
                    },
                    grid: {
                        color: getChartColors().gridColor
                    }
                },
                x: {
                    ticks: {
                        color: getChartColors().textColor
                    },
                    grid: {
                        color: getChartColors().gridColor
                    }
                }
            }
        }
    });

    // Konten per Status Chart
    const kontenPerStatusCtx = document.getElementById('kontenPerStatusChart').getContext('2d');
    let kontenPerStatusChart = new Chart(kontenPerStatusCtx, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode(array_column($kontenPerStatus, 'status')) !!},
            datasets: [{
                data: {!! json_encode(array_column($kontenPerStatus, 'total')) !!},
                backgroundColor: [
                    'rgba(156, 163, 175, 0.8)', // gray - draft
                    'rgba(59, 130, 246, 0.8)',  // blue - diajukan
                    'rgba(251, 191, 36, 0.8)',  // yellow - siap_tayang
                    'rgba(34, 197, 94, 0.8)',   // green - tayang
                    'rgba(107, 114, 128, 0.8)', // gray - selesai
                ],
                borderWidth: 2,
                borderColor: document.documentElement.classList.contains('dark') ? '#1f2937' : '#fff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        color: getChartColors().textColor,
                        padding: 15
                    }
                },
                tooltip: {
                    backgroundColor: getChartColors().tooltipBg,
                    titleColor: getChartColors().textColor,
                    bodyColor: getChartColors().textColor,
                    borderColor: getChartColors().tooltipBorder,
                    borderWidth: 1
                }
            }
        }
    });

    // Update charts when theme changes
    function updateCharts() {
        const colors = getChartColors();
        
        // Update line chart
        kontenPerBulanChart.options.plugins.tooltip.backgroundColor = colors.tooltipBg;
        kontenPerBulanChart.options.plugins.tooltip.titleColor = colors.textColor;
        kontenPerBulanChart.options.plugins.tooltip.bodyColor = colors.textColor;
        kontenPerBulanChart.options.plugins.tooltip.borderColor = colors.tooltipBorder;
        kontenPerBulanChart.options.scales.y.ticks.color = colors.textColor;
        kontenPerBulanChart.options.scales.y.grid.color = colors.gridColor;
        kontenPerBulanChart.options.scales.x.ticks.color = colors.textColor;
        kontenPerBulanChart.options.scales.x.grid.color = colors.gridColor;
        kontenPerBulanChart.update();
        
        // Update doughnut chart
        const isDark = document.documentElement.classList.contains('dark');
        kontenPerStatusChart.data.datasets[0].borderColor = isDark ? '#1f2937' : '#fff';
        kontenPerStatusChart.options.plugins.legend.labels.color = colors.textColor;
        kontenPerStatusChart.options.plugins.tooltip.backgroundColor = colors.tooltipBg;
        kontenPerStatusChart.options.plugins.tooltip.titleColor = colors.textColor;
        kontenPerStatusChart.options.plugins.tooltip.bodyColor = colors.textColor;
        kontenPerStatusChart.options.plugins.tooltip.borderColor = colors.tooltipBorder;
        kontenPerStatusChart.update();
    }

    // Listen for theme changes
    const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if (mutation.attributeName === 'class') {
                updateCharts();
            }
        });
    });

    observer.observe(document.documentElement, {
        attributes: true
    });
</script>

@endsection