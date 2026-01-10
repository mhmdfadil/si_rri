@extends('layouts.app')

@section('title', 'Detail Konten Siaran')
@section('page-title', 'Detail Konten Siaran')
@section('page-subtitle', $kontenSiaran->judul)

@section('content')
<div class="max-w-full mx-auto">
    
    <!-- Back Button & Actions -->
    <div class="flex items-center justify-between mb-6">
        <a href="{{ route('konten-siaran.index') }}" class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-800 font-medium transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali
        </a>

        <div class="flex items-center gap-3">
            @if(in_array($kontenSiaran->status, ['draft', 'ditolak']))
            <a href="{{ route('konten-siaran.edit', $kontenSiaran) }}" class="bg-emerald-500 text-white px-4 py-2 rounded-lg hover:bg-emerald-600 transition-colors font-medium flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Edit Konten
            </a>
            @endif

            @if(in_array($kontenSiaran->status, ['draft']))
            <form action="{{ route('konten-siaran.destroy', $kontenSiaran) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Yakin ingin menghapus konten ini?')" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition-colors font-medium flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                    Hapus
                </button>
            </form>
            @endif
        </div>
    </div>

    <!-- Success/Error Messages -->
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

    @if(session('error'))
    <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-lg">
        <div class="flex items-center">
            <svg class="w-5 h-5 text-red-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <p class="text-red-700 font-medium">{{ session('error') }}</p>
        </div>
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Main Content (Left Side) -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Header Info -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="relative h-64">
                    <img src="{{ $kontenSiaran->thumbnail_url }}" alt="{{ $kontenSiaran->judul }}" class="w-full h-full object-cover">
                    <div class="absolute top-4 left-4 flex gap-2">
                        @if($kontenSiaran->tipe_siaran == 'live')
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-sm font-bold bg-red-500 text-white shadow-lg">
                            <span class="w-2 h-2 bg-white rounded-full animate-pulse"></span>
                            LIVE
                        </span>
                        @else
                        <span class="px-3 py-1.5 rounded-lg text-sm font-bold bg-gray-800 bg-opacity-80 text-white">
                            {{ strtoupper($kontenSiaran->tipe_siaran_text) }}
                        </span>
                        @endif
                    </div>
                    @php
                        $statusColors = [
                            'draft' => 'bg-gray-500',
                            'diajukan' => 'bg-blue-500',
                            'disetujui' => 'bg-green-500',
                            'ditolak' => 'bg-red-500',
                            'siap_tayang' => 'bg-yellow-500',
                            'tayang' => 'bg-green-500',
                            'selesai' => 'bg-gray-600',
                            'dibatalkan' => 'bg-red-600',
                        ];
                        $color = $statusColors[$kontenSiaran->status] ?? 'bg-gray-500';
                    @endphp
                    <div class="absolute top-4 right-4">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-sm font-bold {{ $color }} text-white shadow-lg">
                            <span class="w-2 h-2 bg-white rounded-full"></span>
                            {{ $kontenSiaran->status_text }}
                        </span>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-sm text-gray-600 mb-2">{{ $kontenSiaran->kode_konten }}</p>
                    <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $kontenSiaran->judul }}</h1>
                    
                    <div class="grid grid-cols-3 gap-4 py-4 border-t border-b border-gray-200">
                        <div class="text-center">
                            <p class="text-sm text-gray-600 mb-1">Program</p>
                            <p class="font-bold text-gray-900">{{ $kontenSiaran->program->nama_program ?? '-' }}</p>
                        </div>
                        <div class="text-center">
                            <p class="text-sm text-gray-600 mb-1">Kategori</p>
                            <p class="font-bold text-gray-900">{{ $kontenSiaran->kategori->nama_kategori ?? '-' }}</p>
                        </div>
                        <div class="text-center">
                            <p class="text-sm text-gray-600 mb-1">Jenis Konten</p>
                            <p class="font-bold text-gray-900">{{ $kontenSiaran->jenis_konten_text }}</p>
                        </div>
                    </div>

                    @if($kontenSiaran->deskripsi)
                    <div class="mt-4">
                        <h3 class="text-sm font-medium text-gray-700 mb-2">Deskripsi</h3>
                        <p class="text-gray-600">{{ $kontenSiaran->deskripsi }}</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Jadwal Tayang -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-blue-500 to-indigo-500 px-6 py-4">
                    <h2 class="text-xl font-bold text-white flex items-center gap-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        Jadwal Tayang
                    </h2>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Tanggal Siaran</p>
                            <p class="text-lg font-bold text-gray-900">{{ $kontenSiaran->tanggal_siaran_formatted }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Jam Siaran</p>
                            <p class="text-lg font-bold text-gray-900">{{ $kontenSiaran->jam_siaran_formatted }} WIB</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Durasi</p>
                            <p class="text-lg font-bold text-gray-900">{{ $kontenSiaran->durasi_formatted }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Studio</p>
                            <p class="text-lg font-bold text-gray-900">{{ $kontenSiaran->studio ?? '-' }}</p>
                        </div>
                    </div>
                    @if($kontenSiaran->segmen)
                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <p class="text-sm text-gray-600 mb-1">Segmen</p>
                        <p class="text-gray-900">{{ $kontenSiaran->segmen }}</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Tim Produksi -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-emerald-500 to-teal-500 px-6 py-4">
                    <h2 class="text-xl font-bold text-white flex items-center gap-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        Tim Produksi
                    </h2>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Produser</p>
                            <p class="font-medium text-gray-900">{{ $kontenSiaran->produser ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Penyiar</p>
                            <p class="font-medium text-gray-900">{{ $kontenSiaran->penyiar ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Operator</p>
                            <p class="font-medium text-gray-900">{{ $kontenSiaran->operator ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Narasumber -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-purple-500 to-pink-500 px-6 py-4 flex items-center justify-between">
                    <div>
                        <h2 class="text-xl font-bold text-white flex items-center gap-2">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                            Narasumber
                        </h2>
                        <p class="text-purple-50 text-sm mt-1">Total: {{ $kontenSiaran->narasumbers->count() }} narasumber</p>
                    </div>
                    <a href="{{ route('konten-siaran.manage-narasumber', $kontenSiaran) }}" class="bg-white text-purple-600 px-4 py-2 rounded-lg hover:bg-purple-50 transition-colors font-medium text-sm flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Kelola Narasumber
                    </a>
                </div>
                <div class="p-6">
                    @if($kontenSiaran->narasumbers->count() > 0)
                    <div class="space-y-4">
                        @foreach($kontenSiaran->narasumbers as $narasumber)
                        <div class="flex items-start gap-4 p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                            <img src="{{ $narasumber->foto_profil_url }}" alt="{{ $narasumber->nama_lengkap }}" class="w-16 h-16 rounded-full object-cover border-2 border-white shadow">
                            <div class="flex-1">
                                <h4 class="font-bold text-gray-900">{{ $narasumber->nama_lengkap_with_gelar }}</h4>
                                <p class="text-sm text-gray-600 mt-1">{{ $narasumber->instansi ?? 'Independen' }}</p>
                                <div class="flex items-center gap-4 mt-2">
                                    <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-purple-100 text-purple-700">
                                        {{ $narasumber->pivot->peran_text ?? 'Narasumber' }}
                                    </span>
                                    @if($narasumber->pivot->durasi_tampil)
                                    <span class="text-xs text-gray-600">⏱️ {{ $narasumber->pivot->durasi_tampil_formatted }}</span>
                                    @endif
                                    @if($narasumber->pivot->honor && $narasumber->pivot->honor > 0)
                                    <span class="text-xs text-gray-600">💰 {{ $narasumber->pivot->honor_formatted }}</span>
                                    @endif
                                </div>
                                @if($narasumber->pivot->catatan)
                                <p class="text-xs text-gray-500 mt-2 italic">{{ $narasumber->pivot->catatan }}</p>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="text-center py-8">
                        <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                        <p class="text-gray-500 font-medium">Belum ada narasumber</p>
                        <p class="text-gray-400 text-sm mt-1">Klik tombol "Kelola Narasumber" untuk menambah</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Konten Detail -->
            @if($kontenSiaran->topik_bahasan || $kontenSiaran->rundown || $kontenSiaran->naskah)
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-orange-500 to-red-500 px-6 py-4">
                    <h2 class="text-xl font-bold text-white flex items-center gap-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Konten & Naskah
                    </h2>
                </div>
                <div class="p-6 space-y-6">
                    @if($kontenSiaran->topik_bahasan)
                    <div>
                        <h3 class="text-sm font-bold text-gray-700 mb-2 uppercase">Topik Bahasan</h3>
                        <p class="text-gray-600 whitespace-pre-wrap">{{ $kontenSiaran->topik_bahasan }}</p>
                    </div>
                    @endif

                    @if($kontenSiaran->rundown)
                    <div>
                        <h3 class="text-sm font-bold text-gray-700 mb-2 uppercase">Rundown</h3>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-gray-600 whitespace-pre-wrap">{{ $kontenSiaran->rundown }}</p>
                        </div>
                    </div>
                    @endif

                    @if($kontenSiaran->naskah)
                    <div>
                        <h3 class="text-sm font-bold text-gray-700 mb-2 uppercase">Naskah</h3>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-gray-600 whitespace-pre-wrap">{{ $kontenSiaran->naskah }}</p>
                        </div>
                    </div>
                    @endif

                    @if($kontenSiaran->catatan_produksi)
                    <div>
                        <h3 class="text-sm font-bold text-gray-700 mb-2 uppercase">Catatan Produksi</h3>
                        <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4 rounded">
                            <p class="text-gray-600 whitespace-pre-wrap">{{ $kontenSiaran->catatan_produksi }}</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            @endif

        </div>

        <!-- Sidebar (Right Side) -->
        <div class="lg:col-span-1 space-y-6">
            
            <!-- Workflow Actions -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-indigo-500 to-purple-500 px-6 py-4">
                    <h2 class="text-lg font-bold text-white">Aksi Workflow</h2>
                </div>
                <div class="p-6 space-y-3">
                    @if(in_array($kontenSiaran->status, ['draft', 'ditolak']))
                    <form action="{{ route('konten-siaran.ajukan', $kontenSiaran) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full bg-blue-500 text-white px-4 py-3 rounded-lg hover:bg-blue-600 transition-colors font-medium flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Ajukan untuk Persetujuan
                        </button>
                    </form>
                    @endif

                    @if($kontenSiaran->status === 'diajukan')
                    <form action="{{ route('konten-siaran.setujui', $kontenSiaran) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full bg-green-500 text-white px-4 py-3 rounded-lg hover:bg-green-600 transition-colors font-medium flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Setujui Konten
                        </button>
                    </form>
                    <button onclick="document.getElementById('tolakModal').classList.remove('hidden')" class="w-full bg-red-500 text-white px-4 py-3 rounded-lg hover:bg-red-600 transition-colors font-medium flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Tolak Konten
                    </button>
                    @endif

                    @if(in_array($kontenSiaran->status, ['disetujui', 'draft']))
                    <form action="{{ route('konten-siaran.siapkan-tayang', $kontenSiaran) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full bg-yellow-500 text-white px-4 py-3 rounded-lg hover:bg-yellow-600 transition-colors font-medium flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Siapkan Tayang
                        </button>
                    </form>
                    @endif

                    @if($kontenSiaran->status === 'siap_tayang')
                    <form action="{{ route('konten-siaran.mulai-tayang', $kontenSiaran) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full bg-green-500 text-white px-4 py-3 rounded-lg hover:bg-green-600 transition-colors font-medium flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Mulai Tayang
                        </button>
                    </form>
                    @endif

                    @if($kontenSiaran->status === 'tayang')
                    <form action="{{ route('konten-siaran.selesai-tayang', $kontenSiaran) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full bg-gray-600 text-white px-4 py-3 rounded-lg hover:bg-gray-700 transition-colors font-medium flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Selesai Tayang
                        </button>
                    </form>
                    @endif

                    @if(!in_array($kontenSiaran->status, ['tayang', 'selesai']))
                    <form action="{{ route('konten-siaran.batalkan', $kontenSiaran) }}" method="POST">
                        @csrf
                        <button type="submit" onclick="return confirm('Yakin ingin membatalkan konten ini?')" class="w-full bg-gray-400 text-white px-4 py-3 rounded-lg hover:bg-gray-500 transition-colors font-medium flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Batalkan
                        </button>
                    </form>
                    @endif

                    @if($kontenSiaran->status === 'selesai' && !$kontenSiaran->arsip)
                    <button onclick="document.getElementById('arsipModal').classList.remove('hidden')" class="w-full bg-indigo-500 text-white px-4 py-3 rounded-lg hover:bg-indigo-600 transition-colors font-medium flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                        </svg>
                        Arsipkan
                    </button>
                    @endif
                </div>
            </div>

            <!-- Info Tambahan -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-cyan-500 to-blue-500 px-6 py-4">
                    <h2 class="text-lg font-bold text-white">Info Tambahan</h2>
                </div>
                <div class="p-6 space-y-4">
                    @if($kontenSiaran->hashtag)
                    <div>
                        <p class="text-xs font-medium text-gray-600 mb-2">Hashtag</p>
                        <div class="flex flex-wrap gap-2">
                            @foreach(explode(' ', $kontenSiaran->hashtag) as $tag)
                            <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-blue-50 text-blue-700">{{ $tag }}</span>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    @if($kontenSiaran->kata_kunci)
                    <div>
                        <p class="text-xs font-medium text-gray-600 mb-2">Kata Kunci</p>
                        <p class="text-sm text-gray-700">{{ $kontenSiaran->kata_kunci }}</p>
                    </div>
                    @endif

                    @if($kontenSiaran->jumlah_pendengar)
                    <div>
                        <p class="text-xs font-medium text-gray-600 mb-1">Jumlah Pendengar</p>
                        <p class="text-lg font-bold text-gray-900">{{ number_format($kontenSiaran->jumlah_pendengar) }}</p>
                    </div>
                    @endif

                    @if($kontenSiaran->rating)
                    <div>
                        <p class="text-xs font-medium text-gray-600 mb-1">Rating</p>
                        <p class="text-lg font-bold text-gray-900">{{ $kontenSiaran->rating }}/10</p>
                    </div>
                    @endif

                    @if($kontenSiaran->dapat_diulang)
                    <div class="bg-green-50 border border-green-200 rounded-lg p-3">
                        <p class="text-sm text-green-700 font-medium flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Dapat Ditayangkan Ulang
                        </p>
                    </div>
                    @endif

                    @if($kontenSiaran->arsip)
                    <div class="bg-purple-50 border border-purple-200 rounded-lg p-3">
                        <p class="text-xs font-medium text-purple-600 mb-1">Nomor Arsip</p>
                        <p class="text-sm text-purple-900 font-bold">{{ $kontenSiaran->nomor_arsip }}</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Approval Info -->
            @if($kontenSiaran->diajukan_oleh || $kontenSiaran->disetujui_oleh)
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-pink-500 to-rose-500 px-6 py-4">
                    <h2 class="text-lg font-bold text-white">Info Approval</h2>
                </div>
                <div class="p-6 space-y-4">
                    @if($kontenSiaran->diajukan_oleh)
                    <div>
                        <p class="text-xs font-medium text-gray-600 mb-1">Diajukan Oleh</p>
                        <p class="text-sm font-bold text-gray-900">{{ $kontenSiaran->pengaju->name ?? '-' }}</p>
                        <p class="text-xs text-gray-500">{{ $kontenSiaran->tanggal_diajukan?->format('d M Y H:i') }}</p>
                    </div>
                    @endif

                    @if($kontenSiaran->disetujui_oleh)
                    <div>
                        <p class="text-xs font-medium text-gray-600 mb-1">Disetujui Oleh</p>
                        <p class="text-sm font-bold text-gray-900">{{ $kontenSiaran->penyetuju->name ?? '-' }}</p>
                        <p class="text-xs text-gray-500">{{ $kontenSiaran->tanggal_disetujui?->format('d M Y H:i') }}</p>
                    </div>
                    @endif

                    @if($kontenSiaran->catatan_approval)
                    <div>
                        <p class="text-xs font-medium text-gray-600 mb-1">Catatan</p>
                        <div class="bg-gray-50 p-3 rounded-lg">
                            <p class="text-sm text-gray-700">{{ $kontenSiaran->catatan_approval }}</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            @endif

            <!-- Metadata -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-gray-500 to-gray-600 px-6 py-4">
                    <h2 class="text-lg font-bold text-white">Metadata</h2>
                </div>
                <div class="p-6 space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Dibuat</span>
                        <span class="font-medium text-gray-900">{{ $kontenSiaran->created_at->format('d M Y H:i') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Diperbarui</span>
                        <span class="font-medium text-gray-900">{{ $kontenSiaran->updated_at->format('d M Y H:i') }}</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Modal Tolak -->
<div id="tolakModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-2xl max-w-md w-full">
        <div class="bg-red-500 px-6 py-4 rounded-t-xl">
            <h3 class="text-xl font-bold text-white">Tolak Konten</h3>
        </div>
        <form action="{{ route('konten-siaran.tolak', $kontenSiaran) }}" method="POST" class="p-6">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Alasan Penolakan <span class="text-red-500">*</span></label>
                <textarea name="catatan_approval" required rows="4" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-red-500 focus:ring-2 focus:ring-red-100 outline-none" placeholder="Masukkan alasan penolakan..."></textarea>
            </div>
            <div class="flex gap-3">
                <button type="submit" class="flex-1 bg-red-500 text-white px-4 py-2.5 rounded-lg hover:bg-red-600 transition-colors font-medium">
                    Tolak Konten
                </button>
                <button type="button" onclick="document.getElementById('tolakModal').classList.add('hidden')" class="flex-1 bg-gray-100 text-gray-700 px-4 py-2.5 rounded-lg hover:bg-gray-200 transition-colors font-medium">
                    Batal
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Arsip -->
<div id="arsipModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-2xl max-w-md w-full">
        <div class="bg-indigo-500 px-6 py-4 rounded-t-xl">
            <h3 class="text-xl font-bold text-white">Arsipkan Konten</h3>
        </div>
        <form action="{{ route('konten-siaran.arsipkan', $kontenSiaran) }}" method="POST" class="p-6">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Arsip (Opsional)</label>
                <input type="text" name="nomor_arsip" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 outline-none" placeholder="Akan digenerate otomatis jika kosong">
            </div>
            <div class="flex gap-3">
                <button type="submit" class="flex-1 bg-indigo-500 text-white px-4 py-2.5 rounded-lg hover:bg-indigo-600 transition-colors font-medium">
                    Arsipkan
                </button>
                <button type="button" onclick="document.getElementById('arsipModal').classList.add('hidden')" class="flex-1 bg-gray-100 text-gray-700 px-4 py-2.5 rounded-lg hover:bg-gray-200 transition-colors font-medium">
                    Batal
                </button>
            </div>
        </form>
    </div>
</div>

@endsection