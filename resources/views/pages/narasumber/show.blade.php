@extends('layouts.app')

@section('title', 'Detail Narasumber')
@section('page-title', 'Detail Narasumber')
@section('page-subtitle', 'Informasi lengkap narasumber')

@section('content')
<div class="max-w-full mx-auto">
    
    <!-- Back Button -->
    <div class="mb-6">
        <a 
            href="{{ route('narasumber.index') }}" 
            class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-800 font-medium transition-colors"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali ke Daftar Narasumber
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Profile Card -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                
                <!-- Header -->
                <div class="bg-gradient-to-r from-emerald-500 to-teal-500 h-24"></div>
                
                <!-- Profile Content -->
                <div class="px-6 pb-6 -mt-12">
                    <div class="text-center">
                        <!-- Photo -->
                        <div class="inline-block relative mb-4">
                            <img
                                src="{{ $narasumber->foto_profil_url }}"
                                alt="{{ $narasumber->nama_lengkap }}"
                                class="w-24 h-24 rounded-full object-cover border-4 border-white shadow-xl"
                            >

                            <!-- Status Badge -->
                            <div class="absolute bottom-0 right-0">
                                @if($narasumber->status == 'aktif')
                                    <span class="inline-flex items-center gap-1 bg-green-500 text-white text-xs font-medium px-2 py-1 rounded-full shadow-lg">
                                        <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                                        Aktif
                                    </span>
                                @elseif($narasumber->status == 'nonaktif')
                                    <span class="inline-flex items-center gap-1 bg-orange-500 text-white text-xs font-medium px-2 py-1 rounded-full shadow-lg">
                                        <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                                        Non-Aktif
                                    </span>
                                @elseif($narasumber->status == 'blacklist')
                                    <span class="inline-flex items-center gap-1 bg-red-500 text-white text-xs font-medium px-2 py-1 rounded-full shadow-lg">
                                        <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                                        Blacklist
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 bg-gray-500 text-white text-xs font-medium px-2 py-1 rounded-full shadow-lg">
                                        <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                                        Pensiun
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Name -->
                        <h3 class="text-xl font-bold text-gray-800 mb-1">
                            {{ $narasumber->nama_lengkap_with_gelar }}
                        </h3>

                        <p class="text-sm text-gray-600 mb-1">
                            {{ $narasumber->kode_narasumber }}
                        </p>

                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-50 text-blue-700 mb-4">
                            {{ $narasumber->bidang_keahlian }}
                        </span>

                        <!-- Action Buttons -->
                        <div class="flex items-center gap-2 justify-center mt-4">
                            <a
                                href="{{ route('narasumber.edit', $narasumber) }}"
                                class="flex-1 bg-emerald-500 text-white px-4 py-2 rounded-lg hover:bg-emerald-600 transition-colors font-medium text-sm flex items-center justify-center gap-2"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                    </path>
                                </svg>
                                Edit
                            </a>

                            <form action="{{ route('narasumber.destroy', $narasumber) }}" method="POST" class="flex-1">
                                @csrf
                                @method('DELETE')
                                <button
                                    type="submit"
                                    onclick="return confirm('Yakin ingin menghapus narasumber ini? Data yang dihapus tidak dapat dikembalikan!')"
                                    class="w-full bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition-colors font-medium text-sm flex items-center justify-center gap-2"
                                >
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                        </path>
                                    </svg>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Quick Info -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6 mt-6">
                <h3 class="text-sm font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Informasi Cepat
                </h3>
                <div class="space-y-3">
                    @if($narasumber->jenis_kelamin)
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <span class="text-sm text-gray-600">Jenis Kelamin</span>
                        <span class="text-sm font-medium text-gray-800">{{ \App\Models\Narasumber::JENIS_KELAMIN_OPTIONS[$narasumber->jenis_kelamin] ?? '-' }}</span>
                    </div>
                    @endif
                    @if($narasumber->tempat_lahir || $narasumber->tanggal_lahir)
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <span class="text-sm text-gray-600">TTL</span>
                        <span class="text-sm font-medium text-gray-800">
                            {{ $narasumber->tempat_lahir ?? '' }}{{ $narasumber->tempat_lahir && $narasumber->tanggal_lahir ? ', ' : '' }}{{ $narasumber->tanggal_lahir ? $narasumber->tanggal_lahir->format('d M Y') : '' }}
                        </span>
                    </div>
                    @endif
                    @if($narasumber->pendidikan_terakhir)
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <span class="text-sm text-gray-600">Pendidikan</span>
                        <span class="text-sm font-medium text-gray-800">{{ $narasumber->pendidikan_terakhir }}</span>
                    </div>
                    @endif
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <span class="text-sm text-gray-600">Bergabung</span>
                        <span class="text-sm font-medium text-gray-800">{{ $narasumber->created_at->diffForHumans() }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Detail Information -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Personal Information -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-emerald-500 to-teal-500 px-6 py-4">
                    <h2 class="text-xl font-bold text-white flex items-center gap-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Data Pribadi
                    </h2>
                </div>

                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        <div>
                            <label class="text-sm font-medium text-gray-600 block mb-2">Nama Lengkap</label>
                            <p class="text-base font-semibold text-gray-800 bg-gray-50 px-4 py-3 rounded-lg">
                                {{ $narasumber->nama_lengkap }}
                            </p>
                        </div>

                        <div>
                            <label class="text-sm font-medium text-gray-600 block mb-2">Kode Narasumber</label>
                            <p class="text-base font-semibold text-gray-800 bg-gray-50 px-4 py-3 rounded-lg">
                                {{ $narasumber->kode_narasumber }}
                            </p>
                        </div>

                        @if($narasumber->gelar_depan)
                        <div>
                            <label class="text-sm font-medium text-gray-600 block mb-2">Gelar Depan</label>
                            <p class="text-base font-semibold text-gray-800 bg-gray-50 px-4 py-3 rounded-lg">
                                {{ $narasumber->gelar_depan }}
                            </p>
                        </div>
                        @endif

                        @if($narasumber->gelar_belakang)
                        <div>
                            <label class="text-sm font-medium text-gray-600 block mb-2">Gelar Belakang</label>
                            <p class="text-base font-semibold text-gray-800 bg-gray-50 px-4 py-3 rounded-lg">
                                {{ $narasumber->gelar_belakang }}
                            </p>
                        </div>
                        @endif

                        @if($narasumber->universitas)
                        <div class="md:col-span-2">
                            <label class="text-sm font-medium text-gray-600 block mb-2">Universitas</label>
                            <p class="text-base font-semibold text-gray-800 bg-gray-50 px-4 py-3 rounded-lg">
                                {{ $narasumber->universitas }}
                            </p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Instansi & Keahlian -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-blue-500 to-indigo-500 px-6 py-4">
                    <h2 class="text-xl font-bold text-white flex items-center gap-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                        Instansi & Keahlian
                    </h2>
                </div>

                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @if($narasumber->instansi)
                        <div>
                            <label class="text-sm font-medium text-gray-600 block mb-2">Instansi</label>
                            <p class="text-base font-semibold text-gray-800 bg-gray-50 px-4 py-3 rounded-lg">
                                {{ $narasumber->instansi }}
                            </p>
                        </div>
                        @endif

                        @if($narasumber->jabatan_instansi)
                        <div>
                            <label class="text-sm font-medium text-gray-600 block mb-2">Jabatan</label>
                            <p class="text-base font-semibold text-gray-800 bg-gray-50 px-4 py-3 rounded-lg">
                                {{ $narasumber->jabatan_instansi }}
                            </p>
                        </div>
                        @endif

                        <div class="md:col-span-2">
                            <label class="text-sm font-medium text-gray-600 block mb-2">Bidang Keahlian</label>
                            <p class="text-base font-semibold text-gray-800 bg-gray-50 px-4 py-3 rounded-lg">
                                {{ $narasumber->bidang_keahlian }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-purple-500 to-pink-500 px-6 py-4">
                    <h2 class="text-xl font-bold text-white flex items-center gap-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        Informasi Kontak
                    </h2>
                </div>

                <div class="p-6">
                    <div class="space-y-4">
                        @if($narasumber->email)
                        <div class="flex items-start gap-4 p-4 bg-gray-50 rounded-lg">
                            <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-bold text-gray-800">Email</p>
                                <a href="mailto:{{ $narasumber->email }}" class="text-sm text-blue-600 hover:text-blue-800 mt-1 block">{{ $narasumber->email }}</a>
                            </div>
                        </div>
                        @endif

                        @if($narasumber->telepon_pribadi)
                        <div class="flex items-start gap-4 p-4 bg-gray-50 rounded-lg">
                            <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-bold text-gray-800">Telepon Pribadi</p>
                                <a href="tel:{{ $narasumber->telepon_pribadi }}" class="text-sm text-blue-600 hover:text-blue-800 mt-1 block">{{ $narasumber->telepon_pribadi }}</a>
                            </div>
                        </div>
                        @endif

                        @if($narasumber->telepon_kantor)
                        <div class="flex items-start gap-4 p-4 bg-gray-50 rounded-lg">
                            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-bold text-gray-800">Telepon Kantor</p>
                                <a href="tel:{{ $narasumber->telepon_kantor }}" class="text-sm text-blue-600 hover:text-blue-800 mt-1 block">{{ $narasumber->telepon_kantor }}</a>
                            </div>
                        </div>
                        @endif

                        @if($narasumber->whatsapp)
                        <div class="flex items-start gap-4 p-4 bg-gray-50 rounded-lg">
                            <div class="w-10 h-10 bg-emerald-100 rounded-full flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-emerald-600" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-bold text-gray-800">WhatsApp</p>
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $narasumber->whatsapp) }}" target="_blank" class="text-sm text-blue-600 hover:text-blue-800 mt-1 block">{{ $narasumber->whatsapp }}</a>
                            </div>
                        </div>
                        @endif

                        @if($narasumber->telegram)
                        <div class="flex items-start gap-4 p-4 bg-gray-50 rounded-lg">
                            <div class="w-10 h-10 bg-sky-100 rounded-full flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-sky-600" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-bold text-gray-800">Telegram</p>
                                <p class="text-sm text-gray-600 mt-1">{{ $narasumber->telegram }}</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Alamat -->
            @if($narasumber->alamat || $narasumber->kelurahan || $narasumber->kecamatan || $narasumber->kota || $narasumber->provinsi)
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-orange-500 to-red-500 px-6 py-4">
                    <h2 class="text-xl font-bold text-white flex items-center gap-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Alamat
                    </h2>
                </div>

                <div class="p-6">
                    @if($narasumber->alamat)
                    <div class="mb-4">
                        <label class="text-sm font-medium text-gray-600 block mb-2">Alamat Lengkap</label>
                        <p class="text-base text-gray-800 bg-gray-50 px-4 py-3 rounded-lg">{{ $narasumber->alamat }}</p>
                    </div>
                    @endif
                    
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        @if($narasumber->kelurahan)
                        <div>
                            <label class="text-xs font-medium text-gray-600 block mb-1">Kelurahan</label>
                            <p class="text-sm text-gray-800">{{ $narasumber->kelurahan }}</p>
                        </div>
                        @endif
                        
                        @if($narasumber->kecamatan)
                        <div>
                            <label class="text-xs font-medium text-gray-600 block mb-1">Kecamatan</label>
                            <p class="text-sm text-gray-800">{{ $narasumber->kecamatan }}</p>
                        </div>
                        @endif
                        
                        @if($narasumber->kota)
                        <div>
                            <label class="text-xs font-medium text-gray-600 block mb-1">Kota</label>
                            <p class="text-sm text-gray-800">{{ $narasumber->kota }}</p>
                        </div>
                        @endif
                        
                        @if($narasumber->provinsi)
                        <div>
                            <label class="text-xs font-medium text-gray-600 block mb-1">Provinsi</label>
                            <p class="text-sm text-gray-800">{{ $narasumber->provinsi }}</p>
                        </div>
                        @endif
                        
                        @if($narasumber->kode_pos)
                        <div>
                            <label class="text-xs font-medium text-gray-600 block mb-1">Kode Pos</label>
                            <p class="text-sm text-gray-800">{{ $narasumber->kode_pos }}</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif

            <!-- Media Sosial -->
            @if($narasumber->linkedin || $narasumber->facebook || $narasumber->instagram || $narasumber->twitter)
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-cyan-500 to-blue-500 px-6 py-4">
                    <h2 class="text-xl font-bold text-white flex items-center gap-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path>
                        </svg>
                        Media Sosial
                    </h2>
                </div>

                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @if($narasumber->linkedin)
                        <a href="{{ $narasumber->linkedin }}" target="_blank" class="flex items-center gap-4 p-4 bg-gray-50 rounded-lg hover:bg-blue-50 transition-colors group">
                            <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-bold text-gray-800 group-hover:text-blue-600">LinkedIn</p>
                                <p class="text-xs text-gray-600 truncate">{{ $narasumber->linkedin }}</p>
                            </div>
                        </a>
                        @endif

                        @if($narasumber->facebook)
                        <a href="https://facebook.com/{{ $narasumber->facebook }}" target="_blank" class="flex items-center gap-4 p-4 bg-gray-50 rounded-lg hover:bg-blue-50 transition-colors group">
                            <div class="w-10 h-10 bg-blue-700 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-bold text-gray-800 group-hover:text-blue-600">Facebook</p>
                                <p class="text-xs text-gray-600">{{ $narasumber->facebook }}</p>
                            </div>
                        </a>
                        @endif

                        @if($narasumber->instagram)
                        <a href="https://instagram.com/{{ ltrim($narasumber->instagram, '@') }}" target="_blank" class="flex items-center gap-4 p-4 bg-gray-50 rounded-lg hover:bg-pink-50 transition-colors group">
                            <div class="w-10 h-10 bg-gradient-to-br from-purple-600 via-pink-600 to-orange-600 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-bold text-gray-800 group-hover:text-pink-600">Instagram</p>
                                <p class="text-xs text-gray-600">{{ $narasumber->instagram }}</p>
                            </div>
                        </a>
                        @endif

                        @if($narasumber->twitter)
                        <a href="https://twitter.com/{{ ltrim($narasumber->twitter, '@') }}" target="_blank" class="flex items-center gap-4 p-4 bg-gray-50 rounded-lg hover:bg-sky-50 transition-colors group">
                            <div class="w-10 h-10 bg-black rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-bold text-gray-800 group-hover:text-sky-600">Twitter/X</p>
                                <p class="text-xs text-gray-600">{{ $narasumber->twitter }}</p>
                            </div>
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            @endif

            <!-- Catatan Khusus -->
            @if($narasumber->catatan_khusus)
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-amber-500 to-orange-500 px-6 py-4">
                    <h2 class="text-xl font-bold text-white flex items-center gap-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Catatan Khusus
                    </h2>
                </div>

                <div class="p-6">
                    <div class="bg-amber-50 border-l-4 border-amber-500 p-4 rounded-r-lg">
                        <p class="text-sm text-gray-700 whitespace-pre-line">{{ $narasumber->catatan_khusus }}</p>
                    </div>
                </div>
            </div>
            @endif

            <!-- Timestamps -->
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
                                    {{ $narasumber->created_at->format('d M Y, H:i') }} WIB
                                </p>
                                <p class="text-xs text-gray-500 mt-1">{{ $narasumber->created_at->diffForHumans() }}</p>
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
                                    {{ $narasumber->updated_at->format('d M Y, H:i') }} WIB
                                </p>
                                <p class="text-xs text-gray-500 mt-1">{{ $narasumber->updated_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection