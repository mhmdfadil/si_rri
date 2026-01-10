@extends('layouts.app')

@section('title', 'Detail Program')
@section('page-title', 'Detail Program')
@section('page-subtitle', 'Informasi lengkap program')

@section('content')
<div class="max-w-full mx-auto">
    
    <!-- Success Message -->
    @if(session('success'))
    <div class="bg-emerald-50 dark:bg-emerald-900/30 border-l-4 border-emerald-500 dark:border-emerald-400 p-4 mb-6 rounded-lg transition-colors duration-200">
        <div class="flex items-center">
            <svg class="w-5 h-5 text-emerald-500 dark:text-emerald-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <p class="text-emerald-700 dark:text-emerald-300 font-medium">{{ session('success') }}</p>
        </div>
    </div>
    @endif

    <!-- Back Button -->
    <div class="mb-6">
        <a 
            href="{{ route('program.index') }}" 
            class="inline-flex items-center gap-2 text-gray-600 dark:text-gray-300 hover:text-gray-800 dark:hover:text-white font-medium transition-colors"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali ke Daftar Program
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Quick Info Card -->
        <div class="lg:col-span-1">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-100 dark:border-gray-700 overflow-hidden transition-colors duration-200">
                
                <!-- Header -->
                <div class="bg-gradient-to-r from-purple-500 to-indigo-500 px-6 py-8 text-center">
                    <div class="w-20 h-20 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-xl">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-2">{{ $program->nama_program }}</h3>
                    <p class="text-purple-100 text-sm">{{ $program->kode_program }}</p>
                </div>
                
                <!-- Status Badge -->
                <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700">
                    <div class="flex items-center justify-center gap-2">
                        @if($program->status == 'draft')
                            <span class="inline-flex items-center gap-2 px-4 py-2 bg-gray-50 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg font-medium">
                                <span class="w-2.5 h-2.5 bg-gray-500 dark:bg-gray-400 rounded-full"></span>
                                Draft
                            </span>
                        @elseif($program->status == 'aktif')
                            <span class="inline-flex items-center gap-2 px-4 py-2 bg-green-50 dark:bg-green-900/30 text-green-700 dark:text-green-400 rounded-lg font-medium">
                                <span class="w-2.5 h-2.5 bg-green-500 dark:bg-green-400 rounded-full animate-pulse"></span>
                                Aktif
                            </span>
                        @elseif($program->status == 'nonaktif')
                            <span class="inline-flex items-center gap-2 px-4 py-2 bg-red-50 dark:bg-red-900/30 text-red-700 dark:text-red-400 rounded-lg font-medium">
                                <span class="w-2.5 h-2.5 bg-red-500 dark:bg-red-400 rounded-full"></span>
                                Nonaktif
                            </span>
                        @elseif($program->status == 'selesai')
                            <span class="inline-flex items-center gap-2 px-4 py-2 bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 rounded-lg font-medium">
                                <span class="w-2.5 h-2.5 bg-blue-500 dark:bg-blue-400 rounded-full"></span>
                                Selesai
                            </span>
                        @else
                            <span class="inline-flex items-center gap-2 px-4 py-2 bg-orange-50 dark:bg-orange-900/30 text-orange-700 dark:text-orange-400 rounded-lg font-medium">
                                <span class="w-2.5 h-2.5 bg-orange-500 dark:bg-orange-400 rounded-full"></span>
                                Dibatalkan
                            </span>
                        @endif
                    </div>
                </div>

                <!-- Quick Stats -->
                <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600 dark:text-gray-400">Kategori</span>
                        <span class="text-sm font-semibold text-gray-800 dark:text-white">{{ $program->nama_kategori }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600 dark:text-gray-400">Durasi</span>
                        <span class="text-sm font-semibold text-gray-800 dark:text-white">{{ $program->durasi_formatted }}</span>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="p-6 space-y-3">
                    <a
                        href="{{ route('program.edit', $program) }}"
                        class="w-full bg-purple-500 dark:bg-purple-600 text-white px-4 py-3 rounded-lg hover:bg-purple-600 dark:hover:bg-purple-700 transition-colors font-medium text-sm flex items-center justify-center gap-2"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                            </path>
                        </svg>
                        Edit Program
                    </a>

                    <!-- Change Status Dropdown -->
                    <div class="relative">
                        <button
                            onclick="document.getElementById('statusDropdown').classList.toggle('hidden')"
                            class="w-full bg-amber-500 dark:bg-amber-600 text-white px-4 py-3 rounded-lg hover:bg-amber-600 dark:hover:bg-amber-700 transition-colors font-medium text-sm flex items-center justify-center gap-2"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            Ubah Status
                        </button>
                        <div id="statusDropdown" class="hidden absolute top-full left-0 right-0 mt-2 bg-white dark:bg-gray-700 rounded-lg shadow-xl border border-gray-200 dark:border-gray-600 z-10">
                            @foreach(\App\Models\Program::STATUS_OPTIONS as $key => $value)
                                @if($key != $program->status)
                                <form action="{{ route('program.change-status', $program) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="status" value="{{ $key }}">
                                    <button type="submit" class="w-full text-left px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors text-sm text-gray-700 dark:text-gray-300 border-b border-gray-100 dark:border-gray-600 last:border-0">
                                        {{ $value }}
                                    </button>
                                </form>
                                @endif
                            @endforeach
                        </div>
                    </div>

                    <form action="{{ route('program.destroy', $program) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button
                            type="submit"
                            onclick="return confirm('Yakin ingin menghapus program ini? Data yang dihapus tidak dapat dikembalikan!')"
                            class="w-full bg-red-500 dark:bg-red-600 text-white px-4 py-3 rounded-lg hover:bg-red-600 dark:hover:bg-red-700 transition-colors font-medium text-sm flex items-center justify-center gap-2"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                </path>
                            </svg>
                            Hapus Program
                        </button>
                    </form>
                </div>

            </div>
        </div>

        <!-- Detail Information -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Informasi Program -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-100 dark:border-gray-700 overflow-hidden transition-colors duration-200">
                <div class="bg-gradient-to-r from-purple-500 to-indigo-500 px-6 py-4">
                    <h2 class="text-xl font-bold text-white flex items-center gap-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Informasi Program
                    </h2>
                </div>

                <div class="p-6">
                    <div class="space-y-6">
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="text-sm font-medium text-gray-600 dark:text-gray-400 block mb-2">Kode Program</label>
                                <div class="bg-gray-50 dark:bg-gray-700/50 px-4 py-3 rounded-lg border border-gray-200 dark:border-gray-600">
                                    <span class="text-base font-bold text-gray-800 dark:text-white">{{ $program->kode_program }}</span>
                                </div>
                            </div>

                            <div>
                                <label class="text-sm font-medium text-gray-600 dark:text-gray-400 block mb-2">Status</label>
                                <div class="bg-gray-50 dark:bg-gray-700/50 px-4 py-3 rounded-lg border border-gray-200 dark:border-gray-600">
                                    <span class="text-base font-semibold text-gray-800 dark:text-white">{{ $program->status_text }}</span>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="text-sm font-medium text-gray-600 dark:text-gray-400 block mb-2">Nama Program</label>
                            <div class="bg-gray-50 dark:bg-gray-700/50 px-4 py-3 rounded-lg border border-gray-200 dark:border-gray-600">
                                <span class="text-base font-semibold text-gray-800 dark:text-white">{{ $program->nama_program }}</span>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="text-sm font-medium text-gray-600 dark:text-gray-400 block mb-2">Kategori</label>
                                <div class="bg-gray-50 dark:bg-gray-700/50 px-4 py-3 rounded-lg border border-gray-200 dark:border-gray-600">
                                    <span class="text-base font-semibold text-gray-800 dark:text-white">{{ $program->nama_kategori }}</span>
                                </div>
                            </div>

                            <div>
                                <label class="text-sm font-medium text-gray-600 dark:text-gray-400 block mb-2">Durasi</label>
                                <div class="bg-gray-50 dark:bg-gray-700/50 px-4 py-3 rounded-lg border border-gray-200 dark:border-gray-600">
                                    <span class="text-base font-semibold text-gray-800 dark:text-white">{{ $program->durasi_formatted }}</span>
                                </div>
                            </div>
                        </div>

                        @if($program->deskripsi)
                        <div>
                            <label class="text-sm font-medium text-gray-600 dark:text-gray-400 block mb-2">Deskripsi</label>
                            <div class="bg-gray-50 dark:bg-gray-700/50 px-4 py-3 rounded-lg border border-gray-200 dark:border-gray-600">
                                <p class="text-base text-gray-800 dark:text-gray-200 whitespace-pre-line">{{ $program->deskripsi }}</p>
                            </div>
                        </div>
                        @endif

                    </div>
                </div>
            </div>

            <!-- Informasi Sistem -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-100 dark:border-gray-700 overflow-hidden transition-colors duration-200">
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
                        
                        <div class="flex items-start gap-4 p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                            <div class="w-10 h-10 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-bold text-gray-800 dark:text-white">Dibuat</p>
                                <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">
                                    {{ $program->created_at->format('d M Y, H:i') }} WIB
                                </p>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ $program->created_at->diffForHumans() }}</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4 p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                            <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900/30 rounded-full flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-bold text-gray-800 dark:text-white">Terakhir Diperbarui</p>
                                <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">
                                    {{ $program->updated_at->format('d M Y, H:i') }} WIB
                                </p>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ $program->updated_at->diffForHumans() }}</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
// Close dropdown when clicking outside
document.addEventListener('click', function(event) {
    const dropdown = document.getElementById('statusDropdown');
    const button = event.target.closest('button');
    
    if (!button || !button.onclick) {
        dropdown.classList.add('hidden');
    }
});
</script>
@endsection