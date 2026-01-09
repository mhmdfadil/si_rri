<aside id="sidebar"
    class="fixed lg:static inset-y-0 left-0 z-50 w-64 bg-white dark:bg-gray-800 shadow-2xl
           transform -translate-x-full lg:translate-x-0 transition-all
           duration-300 flex flex-col">

    <!-- Header -->
    <div class="h-16 flex items-center justify-between px-6 border-b dark:border-gray-700 bg-gradient-to-r from-emerald-500 to-teal-500">
        <div class="flex items-center gap-3">
            <div class="bg-white/20 p-2 rounded-lg">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4" />
                </svg>
            </div>
            <div>
                <h2 class="text-white font-bold text-sm">RRI</h2>
                <p class="text-white/80 text-xs">Lhokseumawe</p>
            </div>
        </div>
        <button id="closeSidebar" class="lg:hidden text-white hover:bg-white/20 p-1.5 rounded-lg">
            ✕
        </button>
    </div>

    <!-- Menu -->
    <nav class="flex-1 overflow-y-auto p-4 space-y-1 custom-scrollbar">

        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}"
            class="flex items-center gap-3 px-4 py-3
                    {{ request()->routeIs('dashboard')
                        ? 'text-white bg-gradient-to-r from-emerald-500 to-teal-500'
                        : 'text-gray-700 dark:text-gray-300 hover:bg-emerald-50 dark:hover:bg-gray-700' }}
                    rounded-xl font-medium transition-all group">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3" />
            </svg>
            <span>Dashboard</span>
        </a>

        <!-- Data Narasumber -->
        <a href="{{ route('narasumber.index') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium
                   {{ request()->routeIs('narasumber.*')
                        ? 'text-white bg-gradient-to-r from-emerald-500 to-teal-500'
                        : 'text-gray-700 dark:text-gray-300 hover:bg-emerald-50 dark:hover:bg-gray-700' }} transition-all group">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            <span>Data Narasumber</span>
        </a>

        <!-- Kategori -->
        <a href="{{ route('kategori.index') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium
                   {{ request()->routeIs('kategori.*')
                        ? 'text-white bg-gradient-to-r from-emerald-500 to-teal-500'
                        : 'text-gray-700 dark:text-gray-300 hover:bg-emerald-50 dark:hover:bg-gray-700' }} transition-all group">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
            </svg>
            <span>Kategori</span>
        </a>

        <!-- Program Siaran -->
        <a href="{{ route('program.index') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium
                   {{ request()->routeIs('program.*')
                        ? 'text-white bg-gradient-to-r from-emerald-500 to-teal-500'
                        : 'text-gray-700 dark:text-gray-300 hover:bg-emerald-50 dark:hover:bg-gray-700' }} transition-all group">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            <span>Program Siaran</span>
        </a>

        <!-- Konten Siaran -->
        <a href="#"
            class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium
                   text-gray-700 dark:text-gray-300 hover:bg-emerald-50 dark:hover:bg-gray-700 transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z" />
            </svg>
            <span>Konten Siaran</span>
        </a>

        <div class="border-t dark:border-gray-700 my-3"></div>

        <!-- Laporan -->
        <a href="#"
            class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium
                   text-gray-700 dark:text-gray-300 hover:bg-emerald-50 dark:hover:bg-gray-700 transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            <span>Laporan</span>
        </a>

        <div class="border-t dark:border-gray-700 my-3"></div>

        <!-- Pengguna -->
        <a href="{{ route('users.index') }}"
            class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('users.*')
                        ? 'text-white bg-gradient-to-r from-emerald-500 to-teal-500'
                        : 'text-gray-700 dark:text-gray-300 hover:bg-emerald-50 dark:hover:bg-gray-700' }} rounded-xl font-medium transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
            <span>Pengguna</span>
        </a>

        <!-- Profile Saya -->
        <a href="{{ route('profile.index') }}"
            class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('profile.*')
                        ? 'text-white bg-gradient-to-r from-emerald-500 to-teal-500'
                        : 'text-gray-700 dark:text-gray-300 hover:bg-emerald-50 dark:hover:bg-gray-700' }} rounded-xl font-medium transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
            <span>Profile Saya</span>
        </a>

        <!-- Pengaturan -->
        <a href="#"
            class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium
                   text-gray-700 dark:text-gray-300 hover:bg-emerald-50 dark:hover:bg-gray-700 transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            <span>Pengaturan Sistem</span>
        </a>

    </nav>

    <!-- Footer -->
    <div class="p-4 border-t dark:border-gray-700">
        <div class="bg-emerald-50 dark:bg-gray-700/50 rounded-xl p-4">
            <p class="text-sm font-bold text-gray-800 dark:text-white">{{ Auth::user()->name ?? 'Admin User' }}</p>
            <p class="text-xs text-gray-600 dark:text-gray-400 mb-3">{{ Auth::user()->role ?? 'Administrator' }}</p>
            <button
                class="w-full bg-white dark:bg-gray-600 border dark:border-gray-500 text-emerald-700 dark:text-emerald-300 py-2 rounded-lg hover:bg-emerald-100 dark:hover:bg-gray-500 transition-colors">
                Logout
            </button>
        </div>
    </div>
</aside>