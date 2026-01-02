@extends('layouts.app')

@section('title', 'Edit Kategori')
@section('page-title', 'Edit Kategori')
@section('page-subtitle', 'Perbarui data kategori')

@section('content')
<div class="max-w-4xl mx-auto">
    
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('kategori.show', $kategori) }}" class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-800 font-medium transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali
        </a>
    </div>

    <form action="{{ route('kategori.update', $kategori) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Form Card -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden mb-6">
            <div class="bg-gradient-to-r from-blue-500 to-indigo-500 px-6 py-4">
                <h2 class="text-xl font-bold text-white flex items-center gap-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                    </svg>
                    Data Kategori
                </h2>
            </div>
            
            <div class="p-6 space-y-6">
                
                <!-- Kode Kategori (Read Only) -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Kode Kategori
                    </label>
                    <div class="px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg">
                        <span class="text-sm font-bold text-gray-800">{{ $kategori->kode_kategori }}</span>
                    </div>
                    <p class="text-xs text-gray-500 mt-1">Kode tidak dapat diubah</p>
                </div>

                <!-- Nama Kategori -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Nama Kategori <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        name="nama_kategori" 
                        value="{{ old('nama_kategori', $kategori->nama_kategori) }}" 
                        required
                        placeholder="Contoh: Berita, Talkshow, Wawancara"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none @error('nama_kategori') border-red-500 @enderror"
                    >
                    @error('nama_kategori')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-xs text-gray-500 mt-1">Nama kategori harus unik</p>
                </div>

                <!-- Deskripsi -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Deskripsi
                    </label>
                    <textarea 
                        name="deskripsi" 
                        rows="4"
                        placeholder="Jelaskan tentang kategori ini..."
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none"
                    >{{ old('deskripsi', $kategori->deskripsi) }}</textarea>
                    <p class="text-xs text-gray-500 mt-1">Opsional - Penjelasan tentang kategori</p>
                </div>

                <!-- Status -->
                <div>
                    <label class="flex items-center gap-3 cursor-pointer group">
                        <div class="relative">
                            <input 
                                type="checkbox" 
                                name="is_active" 
                                value="1"
                                {{ old('is_active', $kategori->is_active) ? 'checked' : '' }}
                                class="sr-only peer"
                            >
                            <div class="w-14 h-8 bg-gray-200 rounded-full peer peer-checked:bg-green-500 transition-colors"></div>
                            <div class="absolute left-1 top-1 w-6 h-6 bg-white rounded-full transition-transform peer-checked:translate-x-6 shadow-md"></div>
                        </div>
                        <div>
                            <span class="text-sm font-medium text-gray-700">Status Aktif</span>
                            <p class="text-xs text-gray-500">Kategori dapat digunakan</p>
                        </div>
                    </label>
                </div>

            </div>
        </div>

        <!-- Submit Buttons -->
        <div class="flex items-center gap-3 mb-6">
            <button 
                type="submit" 
                class="bg-gradient-to-r from-blue-500 to-indigo-500 text-white px-8 py-3 rounded-lg font-medium hover:shadow-lg transition-all flex items-center gap-2"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Update Kategori
            </button>
            
            <a 
                href="{{ route('kategori.show', $kategori) }}" 
                class="bg-gray-100 text-gray-700 px-8 py-3 rounded-lg font-medium hover:bg-gray-200 transition-colors flex items-center gap-2"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                Batal
            </a>
        </div>
    </form>
</div>
@endsection