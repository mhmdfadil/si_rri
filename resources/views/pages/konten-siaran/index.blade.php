@extends('layouts.app')

@section('title', 'Data Konten Siaran')
@section('page-title', 'Data Konten Siaran')
@section('page-subtitle', 'Kelola konten siaran RRI Lhokseumawe')

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

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-6">
        <div class="bg-white rounded-xl p-4 shadow-lg border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Total Konten</p>
                    <p class="text-2xl font-bold text-gray-800 mt-1">{{ \App\Models\KontenSiaran::count() }}</p>
                </div>
                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-500 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-4 shadow-lg border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Hari Ini</p>
                    <p class="text-2xl font-bold text-blue-600 mt-1">{{ \App\Models\KontenSiaran::hariIni()->count() }}</p>
                </div>
                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-4 shadow-lg border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Siap Tayang</p>
                    <p class="text-2xl font-bold text-yellow-600 mt-1">{{ \App\Models\KontenSiaran::siapTayang()->count() }}</p>
                </div>
                <div class="w-12 h-12 bg-gradient-to-br from-yellow-500 to-orange-500 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-4 shadow-lg border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Sedang Tayang</p>
                    <p class="text-2xl font-bold text-green-600 mt-1">{{ \App\Models\KontenSiaran::tayang()->count() }}</p>
                </div>
                <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-500 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-4 shadow-lg border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Draft</p>
                    <p class="text-2xl font-bold text-gray-600 mt-1">{{ \App\Models\KontenSiaran::draft()->count() }}</p>
                </div>
                <div class="w-12 h-12 bg-gradient-to-br from-gray-500 to-gray-600 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter & Search Section -->
    <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6 mb-6">
        <form action="{{ route('konten-siaran.index') }}" method="GET" class="space-y-4">
            
            <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                <!-- Search -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Pencarian</label>
                    <div class="relative">
                        <input 
                            type="text" 
                            name="search" 
                            value="{{ request('search') }}"
                            placeholder="Cari judul, kode, topik..." 
                            class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all outline-none"
                        >
                        <svg class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>

                <!-- Status Filter -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select 
                        name="status" 
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all outline-none"
                    >
                        <option value="">Semua Status</option>
                        @foreach(\App\Models\KontenSiaran::STATUS_OPTIONS as $key => $value)
                            <option value="{{ $key }}" {{ request('status') == $key ? 'selected' : '' }}>{{ $value }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Program Filter -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Program</label>
                    <select 
                        name="program_id" 
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all outline-none"
                    >
                        <option value="">Semua Program</option>
                        @foreach($programs as $program)
                            <option value="{{ $program->id }}" {{ request('program_id') == $program->id ? 'selected' : '' }}>{{ $program->nama_program }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Tipe Siaran Filter -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tipe Siaran</label>
                    <select 
                        name="tipe_siaran" 
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all outline-none"
                    >
                        <option value="">Semua Tipe</option>
                        @foreach(\App\Models\KontenSiaran::TIPE_SIARAN_OPTIONS as $key => $value)
                            <option value="{{ $key }}" {{ request('tipe_siaran') == $key ? 'selected' : '' }}>{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Filter Tanggal -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Quick Filter</label>
                    <select 
                        name="filter_tanggal" 
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all outline-none"
                    >
                        <option value="">Pilih Periode</option>
                        <option value="hari_ini" {{ request('filter_tanggal') == 'hari_ini' ? 'selected' : '' }}>Hari Ini</option>
                        <option value="besok" {{ request('filter_tanggal') == 'besok' ? 'selected' : '' }}>Besok</option>
                        <option value="minggu_ini" {{ request('filter_tanggal') == 'minggu_ini' ? 'selected' : '' }}>Minggu Ini</option>
                        <option value="bulan_ini" {{ request('filter_tanggal') == 'bulan_ini' ? 'selected' : '' }}>Bulan Ini</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Dari Tanggal</label>
                    <input 
                        type="date" 
                        name="tanggal_dari" 
                        value="{{ request('tanggal_dari') }}"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all outline-none"
                    >
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Sampai Tanggal</label>
                    <input 
                        type="date" 
                        name="tanggal_sampai" 
                        value="{{ request('tanggal_sampai') }}"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all outline-none"
                    >
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center gap-3">
                <button 
                    type="submit" 
                    class="bg-blue-500 text-white px-6 py-2.5 rounded-lg hover:bg-blue-600 transition-colors font-medium flex items-center gap-2"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    Cari
                </button>

                @if(request()->hasAny(['search', 'status', 'program_id', 'tipe_siaran', 'filter_tanggal', 'tanggal_dari', 'tanggal_sampai']))
                <a 
                    href="{{ route('konten-siaran.index') }}" 
                    class="bg-gray-100 text-gray-700 px-6 py-2.5 rounded-lg hover:bg-gray-200 transition-colors font-medium flex items-center gap-2"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    Reset
                </a>
                @endif

                <div class="flex-1"></div>

                <a 
                    href="{{ route('konten-siaran.create') }}" 
                    class="bg-gradient-to-r from-blue-500 to-indigo-500 text-white px-6 py-2.5 rounded-lg hover:shadow-lg transition-all font-medium flex items-center gap-2"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Tambah Konten Siaran
                </a>
            </div>
        </form>
    </div>

    <!-- Konten Siaran Table -->
    <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
        
        <!-- Table Header -->
        <div class="bg-gradient-to-r from-blue-500 to-indigo-500 px-6 py-4">
            <h2 class="text-xl font-bold text-white flex items-center gap-2">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"></path>
                </svg>
                Daftar Konten Siaran
            </h2>
            <p class="text-blue-50 text-sm mt-1">Total: {{ $kontenSiaran->total() }} konten</p>
        </div>

        <!-- Table Content -->
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Konten</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Program & Kategori</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Jadwal Tayang</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Narasumber</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($kontenSiaran as $item)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <!-- Konten Info -->
                        <td class="px-6 py-4">
                            <div class="flex items-start gap-3">
                                <img
                                    src="{{ $item->thumbnail_url }}"
                                    alt="{{ $item->judul }}"
                                    class="w-16 h-16 rounded-lg object-cover border border-gray-200"
                                >
                                <div>
                                    <p class="text-sm font-bold text-gray-800 line-clamp-2">{{ $item->judul }}</p>
                                    <p class="text-xs text-gray-600 mt-1">{{ $item->kode_konten }}</p>
                                    <div class="flex items-center gap-2 mt-1">
                                        @if($item->tipe_siaran == 'live')
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-medium bg-red-50 text-red-700">
                                            <span class="w-1.5 h-1.5 bg-red-500 rounded-full animate-pulse"></span>
                                            Live
                                        </span>
                                        @else
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-700">
                                            {{ $item->tipe_siaran_text }}
                                        </span>
                                        @endif
                                        <span class="text-xs text-gray-500">• {{ $item->durasi_formatted }}</span>
                                    </div>
                                </div>
                            </div>
                        </td>

                        <!-- Program & Kategori -->
                        <td class="px-6 py-4">
                            <p class="text-sm font-medium text-gray-800">{{ $item->program->nama_program ?? '-' }}</p>
                            <p class="text-xs text-gray-600 mt-1">{{ $item->kategori->nama_kategori ?? '-' }}</p>
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-purple-50 text-purple-700 mt-1">
                                {{ $item->jenis_konten_text }}
                            </span>
                        </td>

                        <!-- Jadwal Tayang -->
                        <td class="px-6 py-4">
                            <div class="flex items-start gap-2">
                                <svg class="w-4 h-4 text-gray-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <div>
                                    <p class="text-sm text-gray-800">{{ $item->tanggal_siaran_formatted }}</p>
                                    <p class="text-xs text-gray-600 mt-0.5">{{ $item->jam_siaran_formatted }} WIB</p>
                                </div>
                            </div>
                        </td>

                        <!-- Narasumber -->
                        <td class="px-6 py-4">
                            @if($item->narasumbers->count() > 0)
                                <div class="flex -space-x-2">
                                    @foreach($item->narasumbers->take(3) as $narasumber)
                                    <img
                                        src="{{ $narasumber->foto_profil_url }}"
                                        alt="{{ $narasumber->nama_lengkap }}"
                                        class="w-8 h-8 rounded-full border-2 border-white"
                                        title="{{ $narasumber->nama_lengkap }}"
                                    >
                                    @endforeach
                                    @if($item->narasumbers->count() > 3)
                                    <div class="w-8 h-8 rounded-full border-2 border-white bg-gray-200 flex items-center justify-center">
                                        <span class="text-xs font-medium text-gray-600">+{{ $item->narasumbers->count() - 3 }}</span>
                                    </div>
                                    @endif
                                </div>
                                <p class="text-xs text-gray-600 mt-1">{{ $item->narasumbers->count() }} narasumber</p>
                            @else
                                <p class="text-xs text-gray-500 italic">Belum ada narasumber</p>
                            @endif
                        </td>

                        <!-- Status -->
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
                                    'dibatalkan' => 'red',
                                ];
                                $color = $statusColors[$item->status] ?? 'gray';
                            @endphp
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-{{ $color }}-50 text-{{ $color }}-700">
                                <span class="w-2 h-2 bg-{{ $color }}-500 rounded-full"></span>
                                {{ $item->status_text }}
                            </span>
                        </td>

                        <!-- Actions -->
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2">
                                
                                <!-- View Button -->
                                <a 
                                    href="{{ route('konten-siaran.show', $item) }}" 
                                    class="text-blue-600 hover:text-blue-800 p-1.5 hover:bg-blue-50 rounded transition-colors"
                                    title="Detail"
                                >
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </a>

                                <!-- Edit Button -->
                                @if(in_array($item->status, ['draft', 'ditolak']))
                                <a 
                                    href="{{ route('konten-siaran.edit', $item) }}" 
                                    class="text-emerald-600 hover:text-emerald-800 p-1.5 hover:bg-emerald-50 rounded transition-colors"
                                    title="Edit"
                                >
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </a>
                                @endif

                                <!-- Delete Button -->
                                @if(in_array($item->status, ['draft']))
                                <form action="{{ route('konten-siaran.destroy', $item) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button 
                                        type="submit" 
                                        class="text-red-600 hover:text-red-800 p-1.5 hover:bg-red-50 rounded transition-colors"
                                        title="Hapus"
                                        onclick="return confirm('Yakin ingin menghapus konten ini?')"
                                    >
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center">
                            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"></path>
                            </svg>
                            <p class="text-gray-500 font-medium">Tidak ada data konten siaran</p>
                            <p class="text-gray-400 text-sm mt-1">Silakan tambah konten siaran baru</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($kontenSiaran->hasPages())
        <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
            {{ $kontenSiaran->links() }}
        </div>
        @endif
    </div>
</div>
@endsection