@extends('layouts.app')

@section('title', 'Laporan')
@section('page-title', 'Laporan & Statistik')
@section('page-subtitle', 'Generate laporan dalam berbagai format')

@section('content')
<div class="max-w-full mx-auto">
    
    <!-- Header Banner -->
    <div class="bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 rounded-xl shadow-lg p-8 mb-6 text-white">
        <div class="flex items-center gap-4">
            <div class="w-16 h-16 bg-white bg-opacity-20 rounded-xl flex items-center justify-center">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
            </div>
            <div>
                <h1 class="text-3xl font-bold">Pusat Laporan</h1>
                <p class="text-purple-100 mt-1">Pilih jenis laporan yang ingin Anda generate</p>
            </div>
        </div>
    </div>

    <!-- Laporan Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        
        <!-- Laporan Konten Siaran -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-100 dark:border-gray-700 overflow-hidden hover:shadow-2xl transition-all group">
            <div class="bg-gradient-to-br from-blue-500 to-indigo-600 p-6">
                <div class="w-16 h-16 bg-white bg-opacity-20 rounded-xl flex items-center justify-center mb-4">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"></path>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-white mb-2">Laporan Konten Siaran</h2>
                <p class="text-blue-100 text-sm">Data lengkap konten siaran dengan filter custom</p>
            </div>
            <div class="p-6">
                <ul class="space-y-3 mb-6">
                    <li class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400">
                        <svg class="w-5 h-5 text-green-500 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Filter berdasarkan tanggal, status, program
                    </li>
                    <li class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400">
                        <svg class="w-5 h-5 text-green-500 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Export ke Excel, PDF, PDF dengan Kop
                    </li>
                    <li class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400">
                        <svg class="w-5 h-5 text-green-500 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Statistik lengkap konten siaran
                    </li>
                </ul>
                <a href="{{ route('laporan.konten-siaran') }}" class="block w-full bg-gradient-to-r from-blue-500 to-indigo-600 text-white text-center px-6 py-3 rounded-lg font-medium hover:shadow-lg transition-all group-hover:scale-105">
                    Generate Laporan
                    <svg class="w-5 h-5 inline ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                </a>
            </div>
        </div>

        <!-- Laporan Narasumber -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-100 dark:border-gray-700 overflow-hidden hover:shadow-2xl transition-all group">
            <div class="bg-gradient-to-br from-emerald-500 to-teal-600 p-6">
                <div class="w-16 h-16 bg-white bg-opacity-20 rounded-xl flex items-center justify-center mb-4">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-white mb-2">Laporan Narasumber</h2>
                <p class="text-emerald-100 text-sm">Data narasumber dan statistik keterlibatan</p>
            </div>
            <div class="p-6">
                <ul class="space-y-3 mb-6">
                    <li class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400">
                        <svg class="w-5 h-5 text-green-500 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Data lengkap narasumber aktif
                    </li>
                    <li class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400">
                        <svg class="w-5 h-5 text-green-500 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Statistik jumlah konten per narasumber
                    </li>
                    <li class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400">
                        <svg class="w-5 h-5 text-green-500 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Filter berdasarkan status & keahlian
                    </li>
                </ul>
                <a href="{{ route('laporan.narasumber') }}" class="block w-full bg-gradient-to-r from-emerald-500 to-teal-600 text-white text-center px-6 py-3 rounded-lg font-medium hover:shadow-lg transition-all group-hover:scale-105">
                    Generate Laporan
                    <svg class="w-5 h-5 inline ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                </a>
            </div>
        </div>

        <!-- Laporan Program -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-100 dark:border-gray-700 overflow-hidden hover:shadow-2xl transition-all group">
            <div class="bg-gradient-to-br from-purple-500 to-pink-600 p-6">
                <div class="w-16 h-16 bg-white bg-opacity-20 rounded-xl flex items-center justify-center mb-4">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z"></path>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-white mb-2">Laporan Program</h2>
                <p class="text-purple-100 text-sm">Statistik program siaran dan produktivitas</p>
            </div>
            <div class="p-6">
                <ul class="space-y-3 mb-6">
                    <li class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400">
                        <svg class="w-5 h-5 text-green-500 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Data program dan kategori
                    </li>
                    <li class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400">
                        <svg class="w-5 h-5 text-green-500 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Jumlah konten per program
                    </li>
                    <li class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400">
                        <svg class="w-5 h-5 text-green-500 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Produktivitas program siaran
                    </li>
                </ul>
                <a href="{{ route('laporan.program') }}" class="block w-full bg-gradient-to-r from-purple-500 to-pink-600 text-white text-center px-6 py-3 rounded-lg font-medium hover:shadow-lg transition-all group-hover:scale-105">
                    Generate Laporan
                    <svg class="w-5 h-5 inline ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                </a>
            </div>
        </div>

    </div>

    <!-- Info Box -->
    <div class="mt-8 bg-blue-50 dark:bg-blue-900/70 border-l-4 border-blue-500 dark:border-blue-400 p-6 rounded-lg transition-colors">
        <div class="flex items-start gap-4">
            <svg class="w-6 h-6 text-blue-500 dark:text-blue-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <div>
                <h3 class="font-bold text-blue-900 dark:text-blue-200 mb-2">Informasi Export Laporan</h3>
                <ul class="space-y-1 text-sm text-blue-800 dark:text-blue-300">
                    <li>• <strong>Excel (.xlsx)</strong>: Format tabel lengkap dengan semua kolom data</li>
                    <li>• <strong>PDF Normal</strong>: Laporan format standar tanpa kop surat</li>
                    <li>• <strong>PDF dengan Kop</strong>: Laporan resmi dengan kop surat RRI Lhokseumawe</li>
                </ul>
            </div>
        </div>
    </div>

</div>
@endsection