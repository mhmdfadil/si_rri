@extends('layouts.app')

@section('title', 'Manajemen Pengguna')
@section('page-title', 'Manajemen Pengguna')
@section('page-subtitle', 'Kelola data pengguna sistem')

@section('content')
<div class="max-w-full mx-auto">
    
    <!-- Success Message -->
    @if(session('success'))
    <div class="bg-emerald-50 dark:bg-emerald-900/30 border-l-4 border-emerald-500 dark:border-emerald-400 p-4 mb-6 rounded-lg">
        <div class="flex items-center">
            <svg class="w-5 h-5 text-emerald-500 dark:text-emerald-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <p class="text-emerald-700 dark:text-emerald-300 font-medium">{{ session('success') }}</p>
        </div>
    </div>
    @endif

    <!-- Header Section -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-100 dark:border-gray-700 p-6 mb-6 transition-colors">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
            
            <!-- Search & Filter -->
            <div class="flex-1">
                <form action="{{ route('users.index') }}" method="GET" class="flex flex-col md:flex-row gap-3">
                    
                    <!-- Search -->
                    <div class="flex-1 relative">
                        <input 
                            type="text" 
                            name="search" 
                            value="{{ request('search') }}"
                            placeholder="Cari nama, username, atau email..." 
                            class="w-full pl-10 pr-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:border-emerald-500 dark:focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 dark:focus:ring-emerald-900 transition-all outline-none bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500"
                        >
                        <svg class="w-5 h-5 text-gray-400 dark:text-gray-500 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>

                    <!-- Status Filter -->
                    <select 
                        name="status" 
                        class="px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:border-emerald-500 dark:focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 dark:focus:ring-emerald-900 transition-all outline-none bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100"
                    >
                        <option value="">Semua Status</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                        <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Non-Aktif</option>
                    </select>

                    <!-- Submit Button -->
                    <button 
                        type="submit" 
                        class="bg-emerald-500 hover:bg-emerald-600 text-white px-6 py-2.5 rounded-lg transition-colors font-medium flex items-center justify-center gap-2"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        Cari
                    </button>

                    @if(request('search') || request('status'))
                    <a 
                        href="{{ route('users.index') }}" 
                        class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 px-4 py-2.5 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors font-medium flex items-center justify-center gap-2"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Reset
                    </a>
                    @endif
                </form>
            </div>

            <!-- Add User Button -->
            <div>
                <a 
                    href="{{ route('users.create') }}" 
                    class="bg-gradient-to-r from-emerald-500 to-teal-500 text-white px-6 py-2.5 rounded-lg hover:shadow-lg transition-all font-medium flex items-center gap-2 whitespace-nowrap"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Tambah Pengguna
                </a>
            </div>
        </div>
    </div>

    <!-- Pengguna Table -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-100 dark:border-gray-700 overflow-hidden transition-colors">
        
        <!-- Table Header -->
        <div class="bg-gradient-to-r from-emerald-500 to-teal-500 px-6 py-4">
            <h2 class="text-xl font-bold text-white flex items-center gap-2">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
                Daftar Pengguna
            </h2>
            <p class="text-emerald-50 text-sm mt-1">Total: {{ $users->total() }} pengguna</p>
        </div>

        <!-- Table Content -->
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 dark:bg-gray-700 border-b border-gray-200 dark:border-gray-600">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Pengguna</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Username</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Login Terakhir</th>
                        <th class="px-6 py-4 text-center text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($users as $user)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                        <!-- User Info -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-3">
                                <img 
                                    src="{{ $user->photo_url }}" 
                                    alt="{{ $user->name }}" 
                                    class="w-10 h-10 rounded-full object-cover border-2 border-emerald-100 dark:border-emerald-900"
                                >
                                <div>
                                    <p class="text-sm font-bold text-gray-800 dark:text-gray-200">{{ $user->name }}</p>
                                </div>
                            </div>
                        </td>

                        <!-- Username -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <p class="text-sm text-gray-700 dark:text-gray-300">{{ $user->username }}</p>
                        </td>

                        <!-- Email -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <p class="text-sm text-gray-700 dark:text-gray-300">{{ $user->email }}</p>
                        </td>

                        <!-- Status -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($user->is_active)
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-green-50 dark:bg-green-900/30 text-green-700 dark:text-green-400">
                                    <span class="w-2 h-2 bg-green-500 dark:bg-green-400 rounded-full"></span>
                                    Aktif
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-red-50 dark:bg-red-900/30 text-red-700 dark:text-red-400">
                                    <span class="w-2 h-2 bg-red-500 dark:bg-red-400 rounded-full"></span>
                                    Non-Aktif
                                </span>
                            @endif
                        </td>

                        <!-- Last Login -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <p class="text-sm text-gray-700 dark:text-gray-300">
                                {{ $user->last_login_at ? $user->last_login_at->format('d M Y, H:i') : '-' }}
                            </p>
                        </td>

                        <!-- Actions -->
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <div class="flex items-center justify-center gap-2">
                                
                                <!-- View Button -->
                                <a 
                                    href="{{ route('users.show', $user) }}" 
                                    class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 p-1.5 hover:bg-blue-50 dark:hover:bg-blue-900/30 rounded transition-colors"
                                    title="Detail"
                                >
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </a>

                                <!-- Edit Button -->
                                <a 
                                    href="{{ route('users.edit', $user) }}" 
                                    class="text-emerald-600 dark:text-emerald-400 hover:text-emerald-800 dark:hover:text-emerald-300 p-1.5 hover:bg-emerald-50 dark:hover:bg-emerald-900/30 rounded transition-colors"
                                    title="Edit"
                                >
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </a>

                                <!-- Toggle Status Button -->
                                <form action="{{ route('users.toggle-status', $user) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button 
                                        type="submit" 
                                        class="text-orange-600 dark:text-orange-400 hover:text-orange-800 dark:hover:text-orange-300 p-1.5 hover:bg-orange-50 dark:hover:bg-orange-900/30 rounded transition-colors"
                                        title="{{ $user->is_active ? 'Nonaktifkan' : 'Aktifkan' }}"
                                        onclick="return confirm('Yakin ingin {{ $user->is_active ? 'menonaktifkan' : 'mengaktifkan' }} user ini?')"
                                    >
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                                        </svg>
                                    </button>
                                </form>

                                <!-- Delete Button -->
                                <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button 
                                        type="submit" 
                                        class="text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300 p-1.5 hover:bg-red-50 dark:hover:bg-red-900/30 rounded transition-colors"
                                        title="Hapus"
                                        onclick="return confirm('Yakin ingin menghapus user ini? Data yang dihapus tidak dapat dikembalikan!')"
                                    >
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center">
                            <svg class="w-16 h-16 text-gray-300 dark:text-gray-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                            <p class="text-gray-500 dark:text-gray-400 font-medium">Tidak ada data user</p>
                            <p class="text-gray-400 dark:text-gray-500 text-sm mt-1">Silakan tambah user baru</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($users->hasPages())
        <div class="bg-gray-50 dark:bg-gray-700 px-6 py-4 border-t border-gray-200 dark:border-gray-600">
            {{ $users->links() }}
        </div>
        @endif
    </div>
</div>
@endsection