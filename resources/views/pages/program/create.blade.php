@extends('layouts.app')

@section('title', 'Tambah Program')
@section('page-title', 'Tambah Program')
@section('page-subtitle', 'Tambahkan program siaran baru')

@section('content')
<div class="max-w-full mx-auto">
    
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('program.index') }}" class="inline-flex items-center gap-2 text-gray-600 dark:text-gray-300 hover:text-gray-800 dark:hover:text-white font-medium transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali
        </a>
    </div>

    <form action="{{ route('program.store') }}" method="POST">
        @csrf

        <!-- Form Card -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-100 dark:border-gray-700 overflow-hidden mb-6 transition-colors duration-200">
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
                <div class="bg-purple-50 dark:bg-purple-900/30 border-l-4 border-purple-500 dark:border-purple-400 p-4 rounded-r-lg">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-purple-500 dark:text-purple-400 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div>
                            <p class="text-sm text-purple-700 dark:text-purple-300 font-medium">Kode program akan digenerate otomatis</p>
                            <p class="text-xs text-purple-600 dark:text-purple-400 mt-1">Format: PRG + Tahun + Nomor urut (PRG20260001)</p>
                        </div>
                    </div>
                </div>

                <!-- Nama Program -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Nama Program <span class="text-red-500 dark:text-red-400">*</span>
                    </label>
                    <input 
                        type="text" 
                        name="nama_program" 
                        value="{{ old('nama_program') }}" 
                        required
                        placeholder="Contoh: Berita Pagi, Zona Musik, Dialog Interaktif"
                        class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:border-purple-500 dark:focus:border-purple-400 focus:ring-2 focus:ring-purple-100 dark:focus:ring-purple-900 outline-none bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 @error('nama_program') border-red-500 dark:border-red-400 @enderror transition-colors duration-200"
                    >
                    @error('nama_program')
                        <p class="text-red-500 dark:text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Kategori -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Kategori <span class="text-red-500 dark:text-red-400">*</span>
                    </label>
                    <select 
                        name="kategori_id" 
                        required
                        class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:border-purple-500 dark:focus:border-purple-400 focus:ring-2 focus:ring-purple-100 dark:focus:ring-purple-900 outline-none bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 @error('kategori_id') border-red-500 dark:border-red-400 @enderror transition-colors duration-200"
                    >
                        <option value="">Pilih Kategori</option>
                        @foreach($kategoris as $kategori)
                            <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                {{ $kategori->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                    @error('kategori_id')
                        <p class="text-red-500 dark:text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Durasi -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Durasi (dalam menit) <span class="text-red-500 dark:text-red-400">*</span>
                    </label>
                    <div class="relative">
                        <input 
                            type="number" 
                            name="durasi" 
                            value="{{ old('durasi') }}" 
                            required
                            min="1"
                            placeholder="Contoh: 30, 60, 90"
                            class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:border-purple-500 dark:focus:border-purple-400 focus:ring-2 focus:ring-purple-100 dark:focus:ring-purple-900 outline-none bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 @error('durasi') border-red-500 dark:border-red-400 @enderror transition-colors duration-200"
                        >
                        <div class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400 text-sm">
                            menit
                        </div>
                    </div>
                    @error('durasi')
                        <p class="text-red-500 dark:text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Contoh: 30 menit, 60 menit (1 jam), 90 menit (1.5 jam)</p>
                </div>

                <!-- Deskripsi -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Deskripsi
                    </label>
                    <textarea 
                        name="deskripsi" 
                        rows="4"
                        placeholder="Jelaskan tentang program ini..."
                        class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:border-purple-500 dark:focus:border-purple-400 focus:ring-2 focus:ring-purple-100 dark:focus:ring-purple-900 outline-none bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 transition-colors duration-200"
                    >{{ old('deskripsi') }}</textarea>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Opsional - Penjelasan tentang program</p>
                </div>

                <!-- Status -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Status <span class="text-red-500 dark:text-red-400">*</span>
                    </label>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                        @foreach(\App\Models\Program::STATUS_OPTIONS as $key => $value)
                            <label class="relative flex items-center p-4 border border-gray-200 dark:border-gray-600 rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors has-[:checked]:border-purple-500 dark:has-[:checked]:border-purple-400 has-[:checked]:bg-purple-50 dark:has-[:checked]:bg-purple-900/30">
                                <input 
                                    type="radio" 
                                    name="status" 
                                    value="{{ $key }}"
                                    {{ old('status', 'draft') == $key ? 'checked' : '' }}
                                    class="w-4 h-4 text-purple-600 dark:text-purple-500 focus:ring-purple-500 dark:focus:ring-purple-400 dark:bg-gray-700 dark:border-gray-600"
                                    required
                                >
                                <span class="ml-3 text-sm font-medium text-gray-700 dark:text-gray-300">{{ $value }}</span>
                            </label>
                        @endforeach
                    </div>
                    @error('status')
                        <p class="text-red-500 dark:text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

            </div>
        </div>

        <!-- Submit Buttons -->
        <div class="flex items-center gap-3 mb-6 flex-wrap">
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
                class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 px-8 py-3 rounded-lg font-medium hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors flex items-center gap-2"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                Batal
            </a>
        </div>
    </form>
</div>

@push('scripts')
<script>
// Auto-focus pada field pertama
document.addEventListener('DOMContentLoaded', function() {
    const firstInput = document.querySelector('input[name="nama_program"]');
    if (firstInput) {
        firstInput.focus();
    }

    // Format durasi input
    const durasiInput = document.querySelector('input[name="durasi"]');
    if (durasiInput) {
        durasiInput.addEventListener('input', function(e) {
            // Remove non-numeric characters
            this.value = this.value.replace(/[^0-9]/g, '');
            
            // Optional: Show formatted duration
            if (this.value) {
                const minutes = parseInt(this.value);
                if (minutes >= 60) {
                    const hours = Math.floor(minutes / 60);
                    const mins = minutes % 60;
                    const formatted = mins > 0 ? `${hours} jam ${mins} menit` : `${hours} jam`;
                    // You could show this in a helper text if desired
                }
            }
        });
    }
});
</script>
@endpush

@endsection