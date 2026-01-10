@extends('layouts.app')

@section('title', 'Laporan Konten Siaran')
@section('page-title', 'Laporan Konten Siaran')
@section('page-subtitle', 'Generate dan export laporan konten siaran')

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
        <form action="{{ route('laporan.konten-siaran') }}" method="GET" class="space-y-4">
            
            <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                <!-- Tanggal Dari -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Tanggal Dari</label>
                    <input type="date" name="tanggal_dari" value="{{ request('tanggal_dari') }}" class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:border-blue-500 dark:focus:border-blue-400 focus:ring-2 focus:ring-blue-100 dark:focus:ring-blue-900 outline-none bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                </div>

                <!-- Tanggal Sampai -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Tanggal Sampai</label>
                    <input type="date" name="tanggal_sampai" value="{{ request('tanggal_sampai') }}" class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:border-blue-500 dark:focus:border-blue-400 focus:ring-2 focus:ring-blue-100 dark:focus:ring-blue-900 outline-none bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                </div>

                <!-- Status -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status</label>
                    <select name="status" class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:border-blue-500 dark:focus:border-blue-400 focus:ring-2 focus:ring-blue-100 dark:focus:ring-blue-900 outline-none bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                        <option value="">Semua Status</option>
                        @foreach(\App\Models\KontenSiaran::STATUS_OPTIONS as $k => $v)
                            <option value="{{ $k }}" {{ request('status') == $k ? 'selected' : '' }}>{{ $v }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Program -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Program</label>
                    <select name="program_id" class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:border-blue-500 dark:focus:border-blue-400 focus:ring-2 focus:ring-blue-100 dark:focus:ring-blue-900 outline-none bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                        <option value="">Semua Program</option>
                        @foreach($programs as $program)
                            <option value="{{ $program->id }}" {{ request('program_id') == $program->id ? 'selected' : '' }}>{{ $program->nama_program }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Tipe Siaran -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Tipe Siaran</label>
                    <select name="tipe_siaran" class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:border-blue-500 dark:focus:border-blue-400 focus:ring-2 focus:ring-blue-100 dark:focus:ring-blue-900 outline-none bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                        <option value="">Semua Tipe</option>
                        @foreach(\App\Models\KontenSiaran::TIPE_SIARAN_OPTIONS as $k => $v)
                            <option value="{{ $k }}" {{ request('tipe_siaran') == $k ? 'selected' : '' }}>{{ $v }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center gap-3 pt-4 border-t border-gray-200 dark:border-gray-700">
                <button type="submit" class="bg-blue-500 dark:bg-blue-600 text-white px-6 py-2.5 rounded-lg hover:bg-blue-600 dark:hover:bg-blue-700 transition-colors font-medium flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    Filter Data
                </button>

                @if(request()->hasAny(['tanggal_dari', 'tanggal_sampai', 'status', 'program_id', 'tipe_siaran']))
                <a href="{{ route('laporan.konten-siaran') }}" class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 px-6 py-2.5 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors font-medium flex items-center gap-2">
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
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
        <div class="bg-gradient-to-br from-blue-500 to-indigo-500 rounded-xl p-6 text-white shadow-lg">
            <p class="text-blue-100 text-sm mb-2">Total Konten</p>
            <p class="text-4xl font-bold">{{ number_format($stats['total']) }}</p>
        </div>

        <div class="bg-gradient-to-br from-emerald-500 to-teal-500 rounded-xl p-6 text-white shadow-lg">
            <p class="text-emerald-100 text-sm mb-2">Total Durasi</p>
            <p class="text-4xl font-bold">{{ number_format($stats['total_durasi']) }}</p>
            <p class="text-emerald-100 text-xs mt-1">menit</p>
        </div>

        <div class="bg-gradient-to-br from-purple-500 to-pink-500 rounded-xl p-6 text-white shadow-lg">
            <p class="text-purple-100 text-sm mb-2">Total Narasumber</p>
            <p class="text-4xl font-bold">{{ number_format($stats['total_narasumber']) }}</p>
        </div>

        <div class="bg-gradient-to-br from-orange-500 to-red-500 rounded-xl p-6 text-white shadow-lg">
            <p class="text-orange-100 text-sm mb-2">Rata-rata Durasi</p>
            <p class="text-4xl font-bold">{{ $stats['total'] > 0 ? number_format($stats['total_durasi'] / $stats['total'], 0) : 0 }}</p>
            <p class="text-orange-100 text-xs mt-1">menit</p>
        </div>
    </div>

    <!-- Export Buttons -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-100 dark:border-gray-700 p-6 mb-6 transition-colors duration-200">
        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
            <svg class="w-6 h-6 text-blue-500 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
            </svg>
            Export Laporan
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Export Excel -->
            <form action="{{ route('laporan.export-konten-excel') }}" method="GET">
                @foreach(request()->all() as $key => $value)
                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                @endforeach
                <button type="submit" class="w-full bg-gradient-to-r from-green-500 to-emerald-600 text-white px-6 py-4 rounded-lg hover:shadow-lg transition-all font-medium flex items-center justify-center gap-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <div class="text-left">
                        <div class="font-bold">Export Excel</div>
                        <div class="text-xs text-green-100">Format .xlsx</div>
                    </div>
                </button>
            </form>

            <!-- Export PDF Normal -->
            <form action="{{ route('laporan.export-konten-pdf') }}" method="GET">
                @foreach(request()->all() as $key => $value)
                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                @endforeach
                <button type="submit" class="w-full bg-gradient-to-r from-red-500 to-pink-600 text-white px-6 py-4 rounded-lg hover:shadow-lg transition-all font-medium flex items-center justify-center gap-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                    </svg>
                    <div class="text-left">
                        <div class="font-bold">Export PDF</div>
                        <div class="text-xs text-red-100">PDF Normal</div>
                    </div>
                </button>
            </form>

            <!-- Export PDF dengan Kop -->
            <form action="{{ route('laporan.export-konten-pdf-kop') }}" method="GET">
                @foreach(request()->all() as $key => $value)
                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                @endforeach
                <button type="submit" class="w-full bg-gradient-to-r from-indigo-500 to-purple-600 text-white px-6 py-4 rounded-lg hover:shadow-lg transition-all font-medium flex items-center justify-center gap-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <div class="text-left">
                        <div class="font-bold">Export PDF Kop</div>
                        <div class="text-xs text-indigo-100">PDF + Kop Surat</div>
                    </div>
                </button>
            </form>
        </div>
    </div>

    <!-- Data Table -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-100 dark:border-gray-700 overflow-hidden transition-colors duration-200">
        <div class="bg-gradient-to-r from-blue-500 to-indigo-500 px-6 py-4">
            <h2 class="text-xl font-bold text-white">Data Konten Siaran</h2>
            <p class="text-blue-50 text-sm mt-1">Total: {{ $kontenSiaran->count() }} konten</p>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 dark:bg-gray-700/50 border-b border-gray-200 dark:border-gray-600">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase">No</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase">Kode</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase">Judul</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase">Program</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase">Jam</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase">Durasi</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase">Tipe</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase">Narasumber</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($kontenSiaran as $index => $item)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                        <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-300">{{ $index + 1 }}</td>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900 dark:text-white">{{ $item->kode_konten }}</td>
                        <td class="px-6 py-4">
                            <p class="text-sm font-medium text-gray-900 dark:text-white line-clamp-2">{{ $item->judul }}</p>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-300">{{ $item->program->nama_program ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-300">{{ $item->tanggal_siaran->format('d/m/Y') }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-300">{{ \Carbon\Carbon::parse($item->jam_siaran)->format('H:i') }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-300">{{ $item->durasi }} menit</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400">
                                {{ $item->tipe_siaran_text }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            @php
                                $statusConfig = [
                                    'draft' => ['bg' => 'bg-gray-50 dark:bg-gray-700', 'text' => 'text-gray-700 dark:text-gray-300'],
                                    'diajukan' => ['bg' => 'bg-blue-50 dark:bg-blue-900/30', 'text' => 'text-blue-700 dark:text-blue-400'],
                                    'disetujui' => ['bg' => 'bg-green-50 dark:bg-green-900/30', 'text' => 'text-green-700 dark:text-green-400'],
                                    'siap_tayang' => ['bg' => 'bg-yellow-50 dark:bg-yellow-900/30', 'text' => 'text-yellow-700 dark:text-yellow-400'],
                                    'tayang' => ['bg' => 'bg-green-50 dark:bg-green-900/30', 'text' => 'text-green-700 dark:text-green-400'],
                                    'selesai' => ['bg' => 'bg-gray-50 dark:bg-gray-700', 'text' => 'text-gray-700 dark:text-gray-300'],
                                ];
                                $config = $statusConfig[$item->status] ?? ['bg' => 'bg-gray-50 dark:bg-gray-700', 'text' => 'text-gray-700 dark:text-gray-300'];
                            @endphp
                            <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium {{ $config['bg'] }} {{ $config['text'] }}">
                                {{ $item->status_text }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-300">{{ $item->narasumbers->count() }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="10" class="px-6 py-12 text-center">
                            <svg class="w-16 h-16 text-gray-300 dark:text-gray-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <p class="text-gray-500 dark:text-gray-400">Tidak ada data</p>
                            <p class="text-gray-400 dark:text-gray-500 text-sm mt-1">Silakan sesuaikan filter untuk menampilkan data</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection