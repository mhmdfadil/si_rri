@extends('layouts.app')

@section('title', 'Tambah Program')
@section('page-title', 'Tambah Program')
@section('page-subtitle', 'Tambahkan program siaran baru')

@section('content')
<div class="max-w-full mx-auto">
    
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('program.index') }}" class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-800 font-medium transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali
        </a>
    </div>

    <form action="{{ route('program.store') }}" method="POST">
        @csrf

        <!-- Form Card -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden mb-6">
            <div class="bg-gradient-to-r from-purple-500 to-indigo-500 px-6 py-4">
                <h2 class="text-xl font-bold text-white flex items-center gap-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                    </svg>
                    Data Program
                </h2>
            </div>
            
            <div class="p-6 space-y-6">
                
                <!-- Info Alert -->
                <div class="bg-purple-50 border-l-4 border-purple-500 p-4 rounded-r-lg">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-purple-500 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div>
                            <p class="text-sm text-purple-700 font-medium">Kode program akan digenerate otomatis</p>
                            <p class="text-xs text-purple-600 mt-1">Format: PRG + Tahun + Nomor urut (PRG20260001)</p>
                        </div>
                    </div>
                </div>

                <!-- Nama Program -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Nama Program <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        name="nama_program" 
                        value="{{ old('nama_program') }}" 
                        required
                        placeholder="Contoh: Berita Pagi, Zona Musik, Dialog Interaktif"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:border-purple-500 focus:ring-2 focus:ring-purple-100 outline-none @error('nama_program') border-red-500 @enderror"
                    >
                    @error('nama_program')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Kategori -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Kategori <span class="text-red-500">*</span>
                    </label>
                    <select 
                        name="kategori_id" 
                        required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:border-purple-500 focus:ring-2 focus:ring-purple-100 outline-none @error('kategori_id') border-red-500 @enderror"
                    >
                        <option value="">Pilih Kategori</option>
                        @foreach($kategoris as $kategori)
                            <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                {{ $kategori->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                    @error('kategori_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Durasi -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Durasi (dalam menit) <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input 
                            type="number" 
                            name="durasi" 
                            value="{{ old('durasi') }}" 
                            required
                            min="1"
                            placeholder="Contoh: 30, 60, 90"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:border-purple-500 focus:ring-2 focus:ring-purple-100 outline-none @error('durasi') border-red-500 @enderror"
                        >
                        <div class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm">
                            menit
                        </div>
                    </div>
                    @error('durasi')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-xs text-gray-500 mt-1">Contoh: 30 menit, 60 menit (1 jam), 90 menit (1.5 jam)</p>
                </div>

                <!-- Deskripsi -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Deskripsi
                    </label>
                    <textarea 
                        name="deskripsi" 
                        rows="4"
                        placeholder="Jelaskan tentang program ini..."
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:border-purple-500 focus:ring-2 focus:ring-purple-100 outline-none"
                    >{{ old('deskripsi') }}</textarea>
                    <p class="text-xs text-gray-500 mt-1">Opsional - Penjelasan tentang program</p>
                </div>

                <!-- Status -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Status <span class="text-red-500">*</span>
                    </label>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                        @foreach(\App\Models\Program::STATUS_OPTIONS as $key => $value)
                            <label class="relative flex items-center p-4 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                                <input 
                                    type="radio" 
                                    name="status" 
                                    value="{{ $key }}"
                                    {{ old('status', 'draft') == $key ? 'checked' : '' }}
                                    class="w-4 h-4 text-purple-600 focus:ring-purple-500"
                                    required
                                >
                                <span class="ml-3 text-sm font-medium text-gray-700">{{ $value }}</span>
                            </label>
                        @endforeach
                    </div>
                    @error('status')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

            </div>
        </div>

        <!-- Submit Buttons -->
        <div class="flex items-center gap-3 mb-6">
            <button 
                type="submit" 
                class="bg-gradient-to-r from-purple-500 to-indigo-500 text-white px-8 py-3 rounded-lg font-medium hover:shadow-lg transition-all flex items-center gap-2"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Simpan Program
            </button>
            
            <a 
                href="{{ route('program.index') }}" 
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