@extends('layouts.app')

@section('title', 'Laporan Program')
@section('page-title', 'Laporan Program')
@section('page-subtitle', 'Statistik program siaran dan produktivitas')

@section('content')
<div class="max-w-full mx-auto">
    
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('laporan.index') }}" class="inline-flex items-center gap-2 text-gray-600 dark:text-gray-300 hover:text-gray-800 dark:hover:text-white font-medium transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali ke Laporan
        </a>
    </div>

    <!-- Filter Section -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-100 dark:border-gray-700 p-6 mb-6 transition-colors duration-200">
        <form action="{{ route('laporan.program') }}" method="GET" class="space-y-4">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Status -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status</label>
                    <select name="status" class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:border-purple-500 dark:focus:border-purple-400 focus:ring-2 focus:ring-purple-100 dark:focus:ring-purple-900 outline-none bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                        <option value="">Semua Status</option>
                        @foreach(\App\Models\Program::STATUS_OPTIONS as $k => $v)
                            <option value="{{ $k }}" {{ request('status') == $k ? 'selected' : '' }}>{{ $v }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Kategori -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Kategori</label>
                    <select name="kategori_id" class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:border-purple-500 dark:focus:border-purple-400 focus:ring-2 focus:ring-purple-100 dark:focus:ring-purple-900 outline-none bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                        <option value="">Semua Kategori</option>
                        @foreach($kategoris as $kategori)
                            <option value="{{ $kategori->id }}" {{ request('kategori_id') == $kategori->id ? 'selected' : '' }}>{{ $kategori->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center gap-3 pt-4 border-t border-gray-200 dark:border-gray-700">
                <button type="submit" class="bg-purple-500 dark:bg-purple-600 text-white px-6 py-2.5 rounded-lg hover:bg-purple-600 dark:hover:bg-purple-700 transition-colors font-medium flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    Filter Data
                </button>

                @if(request()->hasAny(['status', 'kategori_id']))
                <a href="{{ route('laporan.program') }}" class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 px-6 py-2.5 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors font-medium flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    Reset Filter
                </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-gradient-to-br from-purple-500 to-pink-500 rounded-xl p-6 text-white shadow-lg">
            <p class="text-purple-100 text-sm mb-2">Total Program</p>
            <p class="text-4xl font-bold">{{ number_format($stats['total']) }}</p>
        </div>

        <div class="bg-gradient-to-br from-blue-500 to-indigo-500 rounded-xl p-6 text-white shadow-lg">
            <p class="text-blue-100 text-sm mb-2">Program Aktif</p>
            <p class="text-4xl font-bold">{{ number_format($stats['total_aktif']) }}</p>
        </div>

        <div class="bg-gradient-to-br from-emerald-500 to-teal-500 rounded-xl p-6 text-white shadow-lg">
            <p class="text-emerald-100 text-sm mb-2">Total Konten</p>
            <p class="text-4xl font-bold">{{ number_format($stats['total_konten']) }}</p>
            <p class="text-emerald-100 text-xs mt-1">konten siaran</p>
        </div>
    </div>

    <!-- Data Table -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-100 dark:border-gray-700 overflow-hidden transition-colors duration-200">
        <div class="bg-gradient-to-r from-purple-500 to-pink-500 px-6 py-4">
            <h2 class="text-xl font-bold text-white">Data Program Siaran</h2>
            <p class="text-purple-50 text-sm mt-1">Total: {{ $programs->count() }} program</p>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 dark:bg-gray-700/50 border-b border-gray-200 dark:border-gray-600">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase">No</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase">Kode Program</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase">Nama Program</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase">Kategori</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase">Durasi</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase">Jumlah Konten</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase">Deskripsi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($programs as $index => $item)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                        <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-300">{{ $index + 1 }}</td>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900 dark:text-white">{{ $item->kode_program }}</td>
                        <td class="px-6 py-4">
                            <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $item->nama_program }}</p>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-300">{{ $item->kategori->nama_kategori ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-300">{{ $item->durasi_formatted }}</td>
                        <td class="px-6 py-4">
                            @php
                                $statusConfig = [
                                    'draft' => ['bg' => 'bg-gray-50 dark:bg-gray-700', 'text' => 'text-gray-700 dark:text-gray-300'],
                                    'aktif' => ['bg' => 'bg-green-50 dark:bg-green-900/30', 'text' => 'text-green-700 dark:text-green-400'],
                                    'nonaktif' => ['bg' => 'bg-red-50 dark:bg-red-900/30', 'text' => 'text-red-700 dark:text-red-400'],
                                    'selesai' => ['bg' => 'bg-gray-50 dark:bg-gray-700', 'text' => 'text-gray-700 dark:text-gray-300'],
                                    'dibatalkan' => ['bg' => 'bg-red-50 dark:bg-red-900/30', 'text' => 'text-red-700 dark:text-red-400'],
                                ];
                                $config = $statusConfig[$item->status] ?? ['bg' => 'bg-gray-50 dark:bg-gray-700', 'text' => 'text-gray-700 dark:text-gray-300'];
                            @endphp
                            <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium {{ $config['bg'] }} {{ $config['text'] }}">
                                {{ $item->status_text }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-center font-bold text-purple-600 dark:text-purple-400">
                            {{ $item->konten_siarans_count }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-400">
                            {{ $item->deskripsi_singkat }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-6 py-12 text-center">
                            <svg class="w-16 h-16 text-gray-300 dark:text-gray-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                            </svg>
                            <p class="text-gray-500 dark:text-gray-400 font-medium">Tidak ada data</p>
                            <p class="text-gray-400 dark:text-gray-500 text-sm mt-1">Silakan sesuaikan filter untuk menampilkan data</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Info Box -->
    <div class="mt-6 bg-purple-50 dark:bg-purple-900/80 border-l-4 border-purple-500 dark:border-purple-400 p-6 rounded-lg transition-colors duration-200">
        <div class="flex items-start gap-4">
            <svg class="w-6 h-6 text-purple-500 dark:text-purple-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <div>
                <h3 class="font-bold text-purple-900 dark:text-purple-300 mb-2">Informasi Laporan Program</h3>
                <p class="text-sm text-purple-800 dark:text-purple-300">Laporan ini menampilkan statistik produktivitas program siaran berdasarkan jumlah konten yang telah diproduksi. Program dengan jumlah konten lebih tinggi menunjukkan produktivitas yang baik.</p>
            </div>
        </div>
    </div>

</div>
@endsection