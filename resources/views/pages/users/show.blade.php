@extends('layouts.app')

@section('title', 'Detail User')
@section('page-title', 'Detail User')
@section('page-subtitle', 'Informasi lengkap user')

@section('content')
<div class="max-w-5xl mx-auto">
    
    <!-- Back Button -->
    <div class="mb-6">
        <a 
            href="{{ route('users.index') }}" 
            class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-800 font-medium transition-colors"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali ke Daftar User
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
                            @if($user->photos)
                                <img src="{{ $user->photo_url }}" alt="{{ $user->name }}" class="w-24 h-24 rounded-full object-cover border-4 border-white shadow-xl">
                            @else
                                <div class="w-24 h-24 bg-gradient-to-br from-emerald-500 to-teal-500 rounded-full flex items-center justify-center text-white text-3xl font-bold border-4 border-white shadow-xl">
                                    {{ strtoupper(substr($user->name, 0, 2)) }}
                                </div>
                            @endif
                            
                            <!-- Status Badge -->
                            <div class="absolute bottom-0 right-0">
                                @if($user->is_active)
                                    <span class="inline-flex items-center gap-1 bg-green-500 text-white text-xs font-medium px-2 py-1 rounded-full shadow-lg">
                                        <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                                        Aktif
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 bg-red-500 text-white text-xs font-medium px-2 py-1 rounded-full shadow-lg">
                                        <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                                        Non-Aktif
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Name -->
                        <h3 class="text-xl font-bold text-gray-800 mb-1">{{ $user->name }}</h3>
                        <p class="text-sm text-gray-600 mb-4">{{ '@' . $user->username }}</p>

                        <!-- Action Buttons -->
                        <div class="flex items-center gap-2 justify-center">
                            <a 
                                href="{{ route('users.edit', $user) }}" 
                                class="flex-1 bg-emerald-500 text-white px-4 py-2 rounded-lg hover:bg-emerald-600 transition-colors font-medium text-sm flex items-center justify-center gap-2"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Edit
                            </a>

                            <form action="{{ route('users.destroy', $user) }}" method="POST" class="flex-1">
                                @csrf
                                @method('DELETE')
                                <button 
                                    type="submit" 
                                    onclick="return confirm('Yakin ingin menghapus user ini? Data yang dihapus tidak dapat dikembalikan!')"
                                    class="w-full bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition-colors font-medium text-sm flex items-center justify-center gap-2"
                                >
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6 mt-6">
                <h3 class="text-sm font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    Statistik Cepat
                </h3>
                <div class="space-y-3">
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <span class="text-sm text-gray-600">Status Akun</span>
                        @if($user->is_active)
                            <span class="text-sm font-medium text-green-600">Aktif</span>
                        @else
                            <span class="text-sm font-medium text-red-600">Non-Aktif</span>
                        @endif
                    </div>
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <span class="text-sm text-gray-600">Bergabung</span>
                        <span class="text-sm font-medium text-gray-800">{{ $user->created_at->diffForHumans() }}</span>
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
                        Informasi Personal
                    </h2>
                </div>

                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        <!-- Name -->
                        <div>
                            <label class="text-sm font-medium text-gray-600 block mb-2">Nama Lengkap</label>
                            <p class="text-base font-semibold text-gray-800 bg-gray-50 px-4 py-3 rounded-lg">
                                {{ $user->name }}
                            </p>
                        </div>

                        <!-- Username -->
                        <div>
                            <label class="text-sm font-medium text-gray-600 block mb-2">Username</label>
                            <p class="text-base font-semibold text-gray-800 bg-gray-50 px-4 py-3 rounded-lg">
                                {{ $user->username }}
                            </p>
                        </div>

                        <!-- Email -->
                        <div class="md:col-span-2">
                            <label class="text-sm font-medium text-gray-600 block mb-2">Email</label>
                            <p class="text-base font-semibold text-gray-800 bg-gray-50 px-4 py-3 rounded-lg flex items-center gap-2">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                {{ $user->email }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Account Activity -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-blue-500 to-indigo-500 px-6 py-4">
                    <h2 class="text-xl font-bold text-white flex items-center gap-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Aktivitas Akun
                    </h2>
                </div>

                <div class="p-6">
                    <div class="space-y-4">
                        
                        <!-- Last Login -->
                        <div class="flex items-start gap-4 p-4 bg-gray-50 rounded-lg">
                            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-bold text-gray-800">Login Terakhir</p>
                                <p class="text-sm text-gray-600 mt-1">
                                    {{ $user->last_login_at ? $user->last_login_at->format('d M Y, H:i') . ' WIB' : 'Belum pernah login' }}
                                </p>
                                @if($user->last_login_at)
                                <p class="text-xs text-gray-500 mt-1">{{ $user->last_login_at->diffForHumans() }}</p>
                                @endif
                            </div>
                        </div>

                        <!-- Created At -->
                        <div class="flex items-start gap-4 p-4 bg-gray-50 rounded-lg">
                            <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-bold text-gray-800">Akun Dibuat</p>
                                <p class="text-sm text-gray-600 mt-1">
                                    {{ $user->created_at->format('d M Y, H:i') }} WIB
                                </p>
                                <p class="text-xs text-gray-500 mt-1">{{ $user->created_at->diffForHumans() }}</p>
                            </div>
                        </div>

                        <!-- Updated At -->
                        <div class="flex items-start gap-4 p-4 bg-gray-50 rounded-lg">
                            <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-bold text-gray-800">Terakhir Diperbarui</p>
                                <p class="text-sm text-gray-600 mt-1">
                                    {{ $user->updated_at->format('d M Y, H:i') }} WIB
                                </p>
                                <p class="text-xs text-gray-500 mt-1">{{ $user->updated_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions Card -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                    Aksi Cepat
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    
                    <!-- Toggle Status -->
                    <form action="{{ route('users.toggle-status', $user) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button 
                            type="submit"
                            onclick="return confirm('Yakin ingin {{ $user->is_active ? 'menonaktifkan' : 'mengaktifkan' }} user ini?')"
                            class="w-full bg-orange-50 border-2 border-orange-200 text-orange-700 px-4 py-3 rounded-lg hover:bg-orange-100 transition-colors font-medium text-sm flex items-center justify-center gap-2"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                            </svg>
                            {{ $user->is_active ? 'Nonaktifkan User' : 'Aktifkan User' }}
                        </button>
                    </form>

                    <!-- Edit User -->
                    <a 
                        href="{{ route('users.edit', $user) }}"
                        class="w-full bg-emerald-50 border-2 border-emerald-200 text-emerald-700 px-4 py-3 rounded-lg hover:bg-emerald-100 transition-colors font-medium text-sm flex items-center justify-center gap-2"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit User
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection