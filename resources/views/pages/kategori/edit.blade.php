@extends('layouts.app')

@section('title', 'Edit Kategori')
@section('page-title', 'Edit Kategori')
@section('page-subtitle', 'Perbarui data kategori')

@section('content')
<div class="max-w-full mx-auto">
    
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('kategori.show', $kategori) }}" class="inline-flex items-center gap-2 text-gray-600 dark:text-gray-300 hover:text-gray-800 dark:hover:text-white font-medium transition-colors">
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
                
                <!-- Kode Kategori (Read Only) -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Kode Kategori
                    </label>
                    <div class="px-4 py-3 bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 rounded-lg">
                        <span class="text-sm font-bold text-gray-800 dark:text-white">{{ $kategori->kode_kategori }}</span>
                    </div>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Kode tidak dapat diubah</p>
                </div>

                <!-- Nama Kategori -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Nama Kategori <span class="text-red-500 dark:text-red-400">*</span>
                    </label>
                    <input 
                        type="text" 
                        name="nama_kategori" 
                        value="{{ old('nama_kategori', $kategori->nama_kategori) }}" 
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
                    >{{ old('deskripsi', $kategori->deskripsi) }}</textarea>
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
                                {{ old('is_active', $kategori->is_active) ? 'checked' : '' }}
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

                <!-- Edit Info -->
                <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                    <div class="flex items-start gap-3 text-xs text-gray-500 dark:text-gray-400">
                        <svg class="w-4 h-4 mt-0.5 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div>
                            <p>Terakhir diperbarui: <span class="font-medium text-gray-600 dark:text-gray-300">{{ $kategori->updated_at->format('d M Y, H:i') }} WIB</span></p>
                            <p class="mt-1">Dibuat: <span class="font-medium text-gray-600 dark:text-gray-300">{{ $kategori->created_at->format('d M Y, H:i') }} WIB</span></p>
                        </div>
                    </div>
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
                Update Kategori
            </button>
            
            <a 
                href="{{ route('kategori.show', $kategori) }}" 
                class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 px-8 py-3 rounded-lg font-medium hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors flex items-center gap-2"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                Batal
            </a>

            <div class="flex-1"></div>

            <!-- Delete Button -->
            <form action="{{ route('kategori.destroy', $kategori) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button 
                    type="submit" 
                    onclick="return confirm('Yakin ingin menghapus kategori ini? Data yang dihapus tidak dapat dikembalikan!')"
                    class="bg-red-50 dark:bg-red-900/20 border-2 border-red-200 dark:border-red-700 text-red-600 dark:text-red-400 px-6 py-3 rounded-lg font-medium hover:bg-red-100 dark:hover:bg-red-900/30 transition-colors flex items-center gap-2"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                    Hapus Kategori
                </button>
            </form>
        </div>
    </form>
</div>

@push('scripts')
<script>
// Auto-focus pada field nama kategori
document.addEventListener('DOMContentLoaded', function() {
    const nameInput = document.querySelector('input[name="nama_kategori"]');
    if (nameInput) {
        nameInput.focus();
        // Set cursor di akhir text
        nameInput.setSelectionRange(nameInput.value.length, nameInput.value.length);
    }
});
</script>
@endpush

@endsection