@extends('layouts.app')

@section('title', 'Edit Program')
@section('page-title', 'Edit Program')
@section('page-subtitle', 'Perbarui data program')

@section('content')
<div class="max-w-full mx-auto">
    
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('program.show', $program) }}" class="inline-flex items-center gap-2 text-gray-600 dark:text-gray-300 hover:text-gray-800 dark:hover:text-white font-medium transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali
        </a>
    </div>

    <form action="{{ route('program.update', $program) }}" method="POST">
        @csrf
        @method('PUT')

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
                
                <!-- Kode Program (Read Only) -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Kode Program
                    </label>
                    <div class="px-4 py-3 bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 rounded-lg">
                        <span class="text-sm font-bold text-gray-800 dark:text-white">{{ $program->kode_program }}</span>
                    </div>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Kode tidak dapat diubah</p>
                </div>

                <!-- Nama Program -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Nama Program <span class="text-red-500 dark:text-red-400">*</span>
                    </label>
                    <input 
                        type="text" 
                        name="nama_program" 
                        value="{{ old('nama_program', $program->nama_program) }}" 
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
                            <option value="{{ $kategori->id }}" {{ old('kategori_id', $program->kategori_id) == $kategori->id ? 'selected' : '' }}>
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
                            value="{{ old('durasi', $program->durasi) }}" 
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
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Saat ini: {{ $program->durasi_formatted }}</p>
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
                    >{{ old('deskripsi', $program->deskripsi) }}</textarea>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Opsional - Penjelasan tentang program</p>
                </div>

                <!-- Status -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Status <span class="text-red-500 dark:text-red-400">*</span>
                    </label>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                        @foreach(\App\Models\Program::STATUS_OPTIONS as $key => $value)
                            <label class="relative flex items-center p-4 border rounded-lg cursor-pointer transition-colors {{ old('status', $program->status) == $key ? 'border-purple-500 dark:border-purple-400 bg-purple-50 dark:bg-purple-900/30' : 'border-gray-200 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700/50' }}">
                                <input 
                                    type="radio" 
                                    name="status" 
                                    value="{{ $key }}"
                                    {{ old('status', $program->status) == $key ? 'checked' : '' }}
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

                <!-- Edit Info -->
                <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                    <div class="flex items-start gap-3 text-xs text-gray-500 dark:text-gray-400">
                        <svg class="w-4 h-4 mt-0.5 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div>
                            <p>Terakhir diperbarui: <span class="font-medium text-gray-600 dark:text-gray-300">{{ $program->updated_at->format('d M Y, H:i') }} WIB</span></p>
                            <p class="mt-1">Dibuat: <span class="font-medium text-gray-600 dark:text-gray-300">{{ $program->created_at->format('d M Y, H:i') }} WIB</span></p>
                        </div>
                    </div>
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
                Update Program
            </button>
            
            <a 
                href="{{ route('program.show', $program) }}" 
                class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 px-8 py-3 rounded-lg font-medium hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors flex items-center gap-2"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                Batal
            </a>

            <div class="flex-1"></div>

            <!-- Delete Button -->
            <form action="{{ route('program.destroy', $program) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button 
                    type="submit" 
                    onclick="return confirm('Yakin ingin menghapus program ini? Data yang dihapus tidak dapat dikembalikan!')"
                    class="bg-red-50 dark:bg-red-900/20 border-2 border-red-200 dark:border-red-700 text-red-600 dark:text-red-400 px-6 py-3 rounded-lg font-medium hover:bg-red-100 dark:hover:bg-red-900/30 transition-colors flex items-center gap-2"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                    Hapus Program
                </button>
            </form>
        </div>
    </form>
</div>

@push('scripts')
<script>
// Auto-focus pada field nama program
document.addEventListener('DOMContentLoaded', function() {
    const nameInput = document.querySelector('input[name="nama_program"]');
    if (nameInput) {
        nameInput.focus();
        // Set cursor di akhir text
        nameInput.setSelectionRange(nameInput.value.length, nameInput.value.length);
    }

    // Format durasi input
    const durasiInput = document.querySelector('input[name="durasi"]');
    if (durasiInput) {
        durasiInput.addEventListener('input', function(e) {
            // Remove non-numeric characters
            this.value = this.value.replace(/[^0-9]/g, '');
        });
    }

    // Highlight radio button container on selection
    const radioInputs = document.querySelectorAll('input[type="radio"][name="status"]');
    radioInputs.forEach(radio => {
        radio.addEventListener('change', function() {
            // Remove highlight from all labels
            radioInputs.forEach(r => {
                const label = r.closest('label');
                label.classList.remove('border-purple-500', 'dark:border-purple-400', 'bg-purple-50', 'dark:bg-purple-900/30');
                label.classList.add('border-gray-200', 'dark:border-gray-600');
            });
            
            // Add highlight to selected label
            if (this.checked) {
                const label = this.closest('label');
                label.classList.remove('border-gray-200', 'dark:border-gray-600');
                label.classList.add('border-purple-500', 'dark:border-purple-400', 'bg-purple-50', 'dark:bg-purple-900/30');
            }
        });
    });
});
</script>
@endpush

@endsection