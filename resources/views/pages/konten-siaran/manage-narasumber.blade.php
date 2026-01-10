@extends('layouts.app')

@section('title', 'Kelola Narasumber')
@section('page-title', 'Kelola Narasumber')
@section('page-subtitle', $kontenSiaran->judul)

@section('content')
<div class="max-w-full mx-auto">
    
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('konten-siaran.show', $kontenSiaran) }}" class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-800 font-medium transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali ke Detail Konten
        </a>
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
        
        <!-- Konten Info (Left) -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden sticky top-6">
                <div class="relative h-48">
                    <img src="{{ $kontenSiaran->thumbnail_url }}" alt="{{ $kontenSiaran->judul }}" class="w-full h-full object-cover">
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
                            {{ $kontenSiaran->status_text }}
                        </span>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-sm text-gray-600 mb-2">{{ $kontenSiaran->kode_konten }}</p>
                    <h2 class="text-xl font-bold text-gray-900 mb-4">{{ $kontenSiaran->judul }}</h2>
                    
                    <div class="space-y-3 pt-4 border-t border-gray-200">
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600">Program</span>
                            <span class="font-medium text-gray-900 text-sm">{{ $kontenSiaran->program->nama_program ?? '-' }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600">Tanggal Siaran</span>
                            <span class="font-medium text-gray-900 text-sm">{{ $kontenSiaran->tanggal_siaran_formatted }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600">Jam Siaran</span>
                            <span class="font-medium text-gray-900 text-sm">{{ $kontenSiaran->jam_siaran_formatted }} WIB</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600">Durasi</span>
                            <span class="font-medium text-gray-900 text-sm">{{ $kontenSiaran->durasi_formatted }}</span>
                        </div>
                    </div>

                    <!-- Summary -->
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <h3 class="text-sm font-bold text-gray-700 mb-3 uppercase">Ringkasan</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-purple-50 p-3 rounded-lg text-center">
                                <p class="text-2xl font-bold text-purple-600">{{ $kontenSiaran->narasumbers->count() }}</p>
                                <p class="text-xs text-purple-700 mt-1">Narasumber</p>
                            </div>
                            <div class="bg-emerald-50 p-3 rounded-lg text-center">
                                <p class="text-2xl font-bold text-emerald-600">{{ number_format($kontenSiaran->total_honor, 0, ',', '.') }}</p>
                                <p class="text-xs text-emerald-700 mt-1">Total Honor</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content (Right) -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Form Tambah Narasumber -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-blue-500 to-indigo-500 px-6 py-4">
                    <h2 class="text-xl font-bold text-white flex items-center gap-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Tambah Narasumber
                    </h2>
                </div>
                <form action="{{ route('konten-siaran.store-narasumber', $kontenSiaran) }}" method="POST" class="p-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Narasumber <span class="text-red-500">*</span></label>
                            <select name="narasumber_id" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none @error('narasumber_id') border-red-500 @enderror">
                                <option value="">-- Pilih Narasumber --</option>
                                @foreach($narasumbers as $narasumber)
                                    @if(!$kontenSiaran->narasumbers->contains($narasumber->id))
                                    <option value="{{ $narasumber->id }}">
                                        {{ $narasumber->nama_lengkap_with_gelar }} - {{ $narasumber->instansi ?? 'Independen' }}
                                    </option>
                                    @endif
                                @endforeach
                            </select>
                            @error('narasumber_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Peran <span class="text-red-500">*</span></label>
                            <select name="peran" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none">
                                @foreach(\App\Models\KontenSiaranNarasumber::PERAN_OPTIONS as $k => $v)
                                    <option value="{{ $k }}">{{ $v }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Durasi Tampil (Menit)</label>
                            <input type="number" name="durasi_tampil" min="1" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none" placeholder="30">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Honor (Rp)</label>
                            <input type="number" name="honor" min="0" step="1000" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none" placeholder="500000">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Catatan</label>
                            <textarea name="catatan" rows="2" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none" placeholder="Catatan khusus"></textarea>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-gradient-to-r from-blue-500 to-indigo-500 text-white px-6 py-3 rounded-lg font-medium hover:shadow-lg transition-all flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Tambah Narasumber ke Konten
                    </button>
                </form>
            </div>

            <!-- Daftar Narasumber -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-purple-500 to-pink-500 px-6 py-4">
                    <h2 class="text-xl font-bold text-white flex items-center gap-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                        Daftar Narasumber ({{ $kontenSiaran->narasumbers->count() }})
                    </h2>
                </div>

                @if($kontenSiaran->narasumbers->count() > 0)
                <div class="divide-y divide-gray-200">
                    @foreach($kontenSiaran->narasumbers as $narasumber)
                    <div class="p-6 hover:bg-gray-50 transition-colors">
                        <div class="flex items-start gap-4">
                            <!-- Avatar -->
                            <img src="{{ $narasumber->foto_profil_url }}" alt="{{ $narasumber->nama_lengkap }}" class="w-20 h-20 rounded-full object-cover border-2 border-purple-200 shadow-sm flex-shrink-0">
                            
                            <!-- Info -->
                            <div class="flex-1 min-w-0">
                                <div class="flex items-start justify-between mb-2">
                                    <div>
                                        <h3 class="font-bold text-lg text-gray-900">{{ $narasumber->nama_lengkap_with_gelar }}</h3>
                                        <p class="text-sm text-gray-600 mt-1">{{ $narasumber->instansi ?? 'Independen' }}</p>
                                        @if($narasumber->bidang_keahlian)
                                        <p class="text-xs text-gray-500 mt-1">🎯 {{ $narasumber->bidang_keahlian }}</p>
                                        @endif
                                    </div>
                                    <form action="{{ route('konten-siaran.remove-narasumber', [$kontenSiaran, $narasumber]) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus narasumber ini dari konten?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 p-2 hover:bg-red-50 rounded-lg transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>

                                <!-- Detail Grid -->
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mt-4">
                                    <div class="bg-purple-50 p-3 rounded-lg">
                                        <p class="text-xs text-purple-600 font-medium mb-1">Peran</p>
                                        <p class="text-sm font-bold text-purple-900">{{ $narasumber->pivot->peran_text ?? '-' }}</p>
                                    </div>

                                    @if($narasumber->pivot->durasi_tampil)
                                    <div class="bg-blue-50 p-3 rounded-lg">
                                        <p class="text-xs text-blue-600 font-medium mb-1">Durasi Tampil</p>
                                        <p class="text-sm font-bold text-blue-900">{{ $narasumber->pivot->durasi_tampil_formatted }}</p>
                                    </div>
                                    @endif

                                    @if($narasumber->pivot->honor && $narasumber->pivot->honor > 0)
                                    <div class="bg-emerald-50 p-3 rounded-lg">
                                        <p class="text-xs text-emerald-600 font-medium mb-1">Honor</p>
                                        <p class="text-sm font-bold text-emerald-900">{{ $narasumber->pivot->honor_formatted }}</p>
                                    </div>
                                    @endif

                                    @if($narasumber->telepon_pribadi || $narasumber->whatsapp)
                                    <div class="bg-gray-50 p-3 rounded-lg">
                                        <p class="text-xs text-gray-600 font-medium mb-1">Kontak</p>
                                        <p class="text-sm font-bold text-gray-900">{{ $narasumber->whatsapp ?? $narasumber->telepon_pribadi }}</p>
                                    </div>
                                    @endif
                                </div>

                                @if($narasumber->pivot->catatan)
                                <div class="mt-3 bg-yellow-50 border-l-4 border-yellow-400 p-3 rounded">
                                    <p class="text-xs font-medium text-yellow-700 mb-1">Catatan:</p>
                                    <p class="text-sm text-yellow-800">{{ $narasumber->pivot->catatan }}</p>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="p-12 text-center">
                    <svg class="w-20 h-20 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                    <p class="text-gray-500 font-medium text-lg">Belum ada narasumber</p>
                    <p class="text-gray-400 text-sm mt-2">Gunakan form di atas untuk menambahkan narasumber</p>
                </div>
                @endif
            </div>

        </div>
    </div>
</div>
@endsection