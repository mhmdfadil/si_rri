@extends('layouts.app')

@section('title', 'Tambah Kategori')
@section('page-title', 'Tambah Kategori')
@section('page-subtitle', 'Tambahkan kategori baru')

@section('content')
<div class="max-w-full mx-auto">
    
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('kategori.index') }}" class="inline-flex items-center gap-2 text-gray-600 dark:text-gray-300 hover:text-gray-800 dark:hover:text-white font-medium transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali
        </a>
    </div>

    <form action="{{ route('kategori.store') }}" method="POST">
        @csrf

        <!-- Form Card -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-100 dark:border-gray-700 overflow-hidden mb-6 transition-colors duration-200">
            <div class="bg-gradient-to-r from-blue-500 to-indigo-500 px-6 py-4">
                <h2 class="text-xl font-bold text-white flex items-center gap-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                    </svg>
                    Data Kategori
                </h2>
            </div>
            
            <div class="p-6 space-y-6">
                
                <!-- Info Alert -->
                <div class="bg-blue-50 dark:bg-blue-900/30 border-l-4 border-blue-500 dark:border-blue-400 p-4 rounded-r-lg">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-blue-500 dark:text-blue-400 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div>
                            <p class="text-sm text-blue-700 dark:text-blue-300 font-medium">Kode kategori akan digenerate otomatis</p>
                            <p class="text-xs text-blue-600 dark:text-blue-400 mt-1">Format: KAT20260001, KAT20260002, dst.</p>
                        </div>
                    </div>
                </div>

                <!-- Nama Kategori -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Nama Kategori <span class="text-red-500 dark:text-red-400">*</span>
                    </label>
                    <input 
                        type="text" 
                        name="nama_kategori" 
                        value="{{ old('nama_kategori') }}" 
                        required
                        placeholder="Contoh: Berita, Talkshow, Wawancara"
                        class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:border-blue-500 dark:focus:border-blue-400 focus:ring-2 focus:ring-blue-100 dark:focus:ring-blue-900 outline-none bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 @error('nama_kategori') border-red-500 dark:border-red-400 @enderror transition-colors duration-200"
                    >
                    @error('nama_kategori')
                        <p class="text-red-500 dark:text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Nama kategori harus unik</p>
                </div>

                <!-- Deskripsi -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Deskripsi
                    </label>
                    <textarea 
                        name="deskripsi" 
                        rows="4"
                        placeholder="Jelaskan tentang kategori ini..."
                        class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:border-blue-500 dark:focus:border-blue-400 focus:ring-2 focus:ring-blue-100 dark:focus:ring-blue-900 outline-none bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 transition-colors duration-200"
                    >{{ old('deskripsi') }}</textarea>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Opsional - Penjelasan tentang kategori</p>
                </div>

                <!-- Status -->
                <div>
                    <label class="flex items-center gap-3 cursor-pointer group">
                        <div class="relative">
                            <input 
                                type="checkbox" 
                                name="is_active" 
                                value="1"
                                {{ old('is_active', true) ? 'checked' : '' }}
                                class="sr-only peer"
                            >
                            <div class="w-14 h-8 bg-gray-200 dark:bg-gray-600 rounded-full peer peer-checked:bg-green-500 dark:peer-checked:bg-green-600 transition-colors"></div>
                            <div class="absolute left-1 top-1 w-6 h-6 bg-white dark:bg-gray-300 rounded-full transition-transform peer-checked:translate-x-6 shadow-md"></div>
                        </div>
                        <div>
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Status Aktif</span>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Kategori dapat digunakan</p>
                        </div>
                    </label>
                </div>

            </div>
        </div>

        <!-- Submit Buttons -->
        <div class="flex items-center gap-3 mb-6 flex-wrap">
            <button 
                type="submit" 
                class="bg-gradient-to-r from-blue-500 to-indigo-500 text-white px-8 py-3 rounded-lg font-medium hover:shadow-lg transition-all flex items-center gap-2"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Simpan Kategori
            </button>
            
            <a 
                href="{{ route('kategori.index') }}" 
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
    const firstInput = document.querySelector('input[name="nama_kategori"]');
    if (firstInput) {
        firstInput.focus();
    }
});
</script>
@endpush

@endsection