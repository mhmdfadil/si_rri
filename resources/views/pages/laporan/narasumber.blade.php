@extends('layouts.app')

@section('title', 'Laporan Narasumber')
@section('page-title', 'Laporan Narasumber')
@section('page-subtitle', 'Generate dan export laporan narasumber')

@section('content')
<div class="max-w-full mx-auto">
    
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('laporan.index') }}" class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-800 font-medium transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali ke Laporan
        </a>
    </div>

    <!-- Filter Section -->
    <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6 mb-6">
        <form action="{{ route('laporan.narasumber') }}" method="GET" class="space-y-4">
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Status -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select name="status" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 outline-none">
                        <option value="">Semua Status</option>
                        @foreach(\App\Models\Narasumber::STATUS_OPTIONS as $k => $v)
                            <option value="{{ $k }}" {{ request('status') == $k ? 'selected' : '' }}>{{ $v }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Bidang Keahlian -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Bidang Keahlian</label>
                    <input type="text" name="bidang_keahlian" value="{{ request('bidang_keahlian') }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 outline-none" placeholder="Cari bidang keahlian...">
                </div>

                <!-- Instansi -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Instansi</label>
                    <input type="text" name="instansi" value="{{ request('instansi') }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 outline-none" placeholder="Cari instansi...">
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center gap-3 pt-4 border-t border-gray-200">
                <button type="submit" class="bg-emerald-500 text-white px-6 py-2.5 rounded-lg hover:bg-emerald-600 transition-colors font-medium flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    Filter Data
                </button>

                @if(request()->hasAny(['status', 'bidang_keahlian', 'instansi']))
                <a href="{{ route('laporan.narasumber') }}" class="bg-gray-100 text-gray-700 px-6 py-2.5 rounded-lg hover:bg-gray-200 transition-colors font-medium flex items-center gap-2">
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
        <div class="bg-gradient-to-br from-emerald-500 to-teal-500 rounded-xl p-6 text-white shadow-lg">
            <p class="text-emerald-100 text-sm mb-2">Total Narasumber</p>
            <p class="text-4xl font-bold">{{ number_format($stats['total']) }}</p>
        </div>

        <div class="bg-gradient-to-br from-blue-500 to-indigo-500 rounded-xl p-6 text-white shadow-lg">
            <p class="text-blue-100 text-sm mb-2">Narasumber Aktif</p>
            <p class="text-4xl font-bold">{{ number_format($stats['total_aktif']) }}</p>
        </div>

        <div class="bg-gradient-to-br from-purple-500 to-pink-500 rounded-xl p-6 text-white shadow-lg">
            <p class="text-purple-100 text-sm mb-2">Total Keterlibatan</p>
            <p class="text-4xl font-bold">{{ number_format($stats['total_konten']) }}</p>
            <p class="text-purple-100 text-xs mt-1">konten siaran</p>
        </div>
    </div>

    <!-- Export Buttons -->
    <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6 mb-6">
        <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
            <svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
            </svg>
            Export Laporan
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <!-- Export Excel -->
            <form action="{{ route('laporan.export-narasumber-excel') }}" method="GET">
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
            <form action="{{ route('laporan.export-narasumber-pdf') }}" method="GET">
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
            <form action="{{ route('laporan.export-narasumber-pdf-kop') }}" method="GET">
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
    <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="bg-gradient-to-r from-emerald-500 to-teal-500 px-6 py-4">
            <h2 class="text-xl font-bold text-white">Data Narasumber</h2>
            <p class="text-emerald-50 text-sm mt-1">Total: {{ $narasumbers->count() }} narasumber</p>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase">No</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase">Kode</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase">Nama Lengkap</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase">Instansi</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase">Jabatan</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase">Bidang Keahlian</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase">Kontak</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase">Jumlah Konten</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($narasumbers as $index => $item)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $index + 1 }}</td>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $item->kode_narasumber }}</td>
                        <td class="px-6 py-4">
                            <p class="text-sm font-medium text-gray-900">{{ $item->nama_lengkap_with_gelar }}</p>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $item->instansi ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $item->jabatan_instansi ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $item->bidang_keahlian ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">
                            {{ $item->whatsapp ?? $item->telepon_pribadi ?? '-' }}
                        </td>
                        <td class="px-6 py-4">
                            @php
                                $statusColors = [
                                    'aktif' => 'green',
                                    'nonaktif' => 'red',
                                    'blacklist' => 'red',
                                    'pensiun' => 'gray',
                                ];
                                $color = $statusColors[$item->status] ?? 'gray';
                            @endphp
                            <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-{{ $color }}-50 text-{{ $color }}-700">
                                {{ ucfirst($item->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-center font-bold text-gray-900">
                            {{ $item->konten_siarans_count }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="px-6 py-12 text-center">
                            <p class="text-gray-500">Tidak ada data</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection