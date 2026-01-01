<aside id="sidebar"
    class="fixed lg:static inset-y-0 left-0 z-50 w-64 bg-white shadow-2xl
           transform -translate-x-full lg:translate-x-0 transition-transform
           duration-300 flex flex-col">

    <!-- Header -->
    <div class="h-16 flex items-center justify-between px-6 border-b bg-gradient-to-r from-emerald-500 to-teal-500">
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
    <nav class="flex-1 overflow-y-auto p-4 space-y-1">

        <!-- Item -->
        <a href="{{ route('dashboard') }}"
            class="flex items-center gap-3 px-4 py-3
                    {{ request()->routeIs('dashboard')
                        ? 'text-white bg-gradient-to-r from-emerald-500 to-teal-500'
                        : 'text-gray-700 hover:bg-emerald-50' }}
                    rounded-xl font-medium transition-all group">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3" />
                </svg>
                <span>Dashboard</span>
            </a>

        <a href="#"
            class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium
                   text-gray-700 hover:bg-emerald-50 transition-all">
            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 4a4 4 0 100 8 4 4 0 000-8zM4 20a8 8 0 0116 0" />
            </svg>
            <span>Data Narasumber</span>
        </a>

        <a href="#"
            class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium
                   text-gray-700 hover:bg-emerald-50 transition-all">
            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12h6m-6 4h6" />
            </svg>
            <span>Konten Siaran</span>
        </a>

        <a href="#"
            class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium
                   text-gray-700 hover:bg-emerald-50 transition-all">
            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 8v4l3 3" />
            </svg>
            <span>Program Siaran</span>
        </a>

        <div class="border-t my-3"></div>

        <a href="#"
            class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium
                   text-gray-700 hover:bg-emerald-50 transition-all">
            <span>Kategori</span>
        </a>

        <a href="#"
            class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium
                   text-gray-700 hover:bg-emerald-50 transition-all">
            <span>Laporan</span>
        </a>

        <div class="border-t my-3"></div>

        <a href="#"
            class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium
                   text-gray-700 hover:bg-emerald-50 transition-all">
            <span>Pengaturan</span>
        </a>

    </nav>

    <!-- Footer -->
    <div class="p-4 border-t">
        <div class="bg-emerald-50 rounded-xl p-4">
            <p class="text-sm font-bold text-gray-800">{{ Auth::user()->name ?? 'Admin User' }}</p>
            <p class="text-xs text-gray-600 mb-3">{{ Auth::user()->role ?? 'Administrator' }}</p>
            <button
                class="w-full bg-white border text-emerald-700 py-2 rounded-lg hover:bg-emerald-100">
                Logout
            </button>
        </div>
    </div>
</aside>
