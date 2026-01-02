@extends('layouts.app')

@section('title', 'Detail Kategori')
@section('page-title', 'Detail Kategori')
@section('page-subtitle', 'Informasi lengkap kategori')

@section('content')
<div class="max-w-5xl mx-auto">
    
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

    <!-- Back Button -->
    <div class="mb-6">
        <a 
            href="{{ route('kategori.index') }}" 
            class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-800 font-medium transition-colors"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali ke Daftar Kategori
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Quick Info Card -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                
                <!-- Header -->
                <div class="bg-gradient-to-r from-blue-500 to-indigo-500 px-6 py-8 text-center">
                    <div class="w-20 h-20 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-xl">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-2">{{ $kategori->nama_kategori }}</h3>
                    <p class="text-blue-100 text-sm">{{ $kategori->kode_kategori }}</p>
                </div>
                
                <!-- Status Badge -->
                <div class="px-6 py-4 border-b border-gray-100">
                    <div class="flex items-center justify-center gap-2">
                        @if($kategori->is_active)
                            <span class="inline-flex items-center gap-2 px-4 py-2 bg-green-50 text-green-700 rounded-lg font-medium">
                                <span class="w-2.5 h-2.5 bg-green-500 rounded-full animate-pulse"></span>
                                Status Aktif
                            </span>
                        @else
                            <span class="inline-flex items-center gap-2 px-4 py-2 bg-red-50 text-red-700 rounded-lg font-medium">
                                <span class="w-2.5 h-2.5 bg-red-500 rounded-full"></span>
                                Status Nonaktif
                            </span>
                        @endif
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="p-6 space-y-3">
                    <a
                        href="{{ route('kategori.edit', $kategori) }}"
                        class="w-full bg-blue-500 text-white px-4 py-3 rounded-lg hover:bg-blue-600 transition-colors font-medium text-sm flex items-center justify-center gap-2"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                            </path>
                        </svg>
                        Edit Kategori
                    </a>

                    <form action="{{ route('kategori.toggle-status', $kategori) }}" method="POST">
                        @csrf
                        <button
                            type="submit"
                            class="w-full bg-amber-500 text-white px-4 py-3 rounded-lg hover:bg-amber-600 transition-colors font-medium text-sm flex items-center justify-center gap-2"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            {{ $kategori->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                        </button>
                    </form>

                    <form action="{{ route('kategori.destroy', $kategori) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button
                            type="submit"
                            onclick="return confirm('Yakin ingin menghapus kategori ini? Data yang dihapus tidak dapat dikembalikan!')"
                            class="w-full bg-red-500 text-white px-4 py-3 rounded-lg hover:bg-red-600 transition-colors font-medium text-sm flex items-center justify-center gap-2"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                </path>
                            </svg>
                            Hapus Kategori
                        </button>
                    </form>
                </div>

            </div>
        </div>

        <!-- Detail Information -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Informasi Kategori -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-blue-500 to-indigo-500 px-6 py-4">
                    <h2 class="text-xl font-bold text-white flex items-center gap-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Informasi Kategori
                    </h2>
                </div>

                <div class="p-6">
                    <div class="space-y-6">
                        
                        <div>
                            <label class="text-sm font-medium text-gray-600 block mb-2">Kode Kategori</label>
                            <div class="bg-gray-50 px-4 py-3 rounded-lg border border-gray-200">
                                <span class="text-base font-bold text-gray-800">{{ $kategori->kode_kategori }}</span>
                            </div>
                        </div>

                        <div>
                            <label class="text-sm font-medium text-gray-600 block mb-2">Nama Kategori</label>
                            <div class="bg-gray-50 px-4 py-3 rounded-lg border border-gray-200">
                                <span class="text-base font-semibold text-gray-800">{{ $kategori->nama_kategori }}</span>
                            </div>
                        </div>

                        @if($kategori->deskripsi)
                        <div>
                            <label class="text-sm font-medium text-gray-600 block mb-2">Deskripsi</label>
                            <div class="bg-gray-50 px-4 py-3 rounded-lg border border-gray-200">
                                <p class="text-base text-gray-800 whitespace-pre-line">{{ $kategori->deskripsi }}</p>
                            </div>
                        </div>
                        @else
                        <div>
                            <label class="text-sm font-medium text-gray-600 block mb-2">Deskripsi</label>
                            <div class="bg-gray-50 px-4 py-3 rounded-lg border border-gray-200">
                                <p class="text-sm text-gray-500 italic">Tidak ada deskripsi</p>
                            </div>
                        </div>
                        @endif

                        <div>
                            <label class="text-sm font-medium text-gray-600 block mb-2">Status</label>
                            <div class="bg-gray-50 px-4 py-3 rounded-lg border border-gray-200">
                                @if($kategori->is_active)
                                    <span class="inline-flex items-center gap-2 text-green-700 font-semibold">
                                        <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                                        Aktif
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-2 text-red-700 font-semibold">
                                        <span class="w-2 h-2 bg-red-500 rounded-full"></span>
                                        Nonaktif
                                    </span>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Informasi Sistem -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-gray-600 to-gray-800 px-6 py-4">
                    <h2 class="text-xl font-bold text-white flex items-center gap-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Informasi Sistem
                    </h2>
                </div>

                <div class="p-6">
                    <div class="space-y-4">
                        
                        <div class="flex items-start gap-4 p-4 bg-gray-50 rounded-lg">
                            <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-bold text-gray-800">Dibuat</p>
                                <p class="text-sm text-gray-600 mt-1">
                                    {{ $kategori->created_at->format('d M Y, H:i') }} WIB
                                </p>
                                <p class="text-xs text-gray-500 mt-1">{{ $kategori->created_at->diffForHumans() }}</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4 p-4 bg-gray-50 rounded-lg">
                            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-bold text-gray-800">Terakhir Diperbarui</p>
                                <p class="text-sm text-gray-600 mt-1">
                                    {{ $kategori->updated_at->format('d M Y, H:i') }} WIB
                                </p>
                                <p class="text-xs text-gray-500 mt-1">{{ $kategori->updated_at->diffForHumans() }}</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection