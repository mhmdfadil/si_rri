<header class="h-16 bg-white shadow-md flex items-center justify-between px-4 lg:px-6 z-30">
    
    <!-- Left Side -->
    <div class="flex items-center gap-4">
        <button id="openSidebar" class="lg:hidden text-gray-700 hover:bg-gray-100 p-2 rounded-lg transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>
        
        <div class="hidden lg:block">
            <h1 class="text-xl font-bold text-gray-800">@yield('page-title', 'Dashboard')</h1>
            <p class="text-xs text-gray-600">@yield('page-subtitle', 'Selamat datang di sistem database RRI')</p>
        </div>
    </div>

    <!-- Right Side -->
    <div class="flex items-center gap-3">
        
        <!-- Search Button (Mobile) -->
        <button class="lg:hidden text-gray-700 hover:bg-gray-100 p-2 rounded-lg transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </button>

        <!-- Search Bar (Desktop) -->
        <div class="hidden lg:flex relative">
            <input 
                type="text" 
                placeholder="Cari..." 
                class="w-64 pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 transition-all outline-none text-sm"
            />
            <svg class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </div>

        <!-- Notifications -->
        <button class="relative text-gray-700 hover:bg-gray-100 p-2 rounded-lg transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
            </svg>
            <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
        </button>

        <!-- User Profile -->
        <div class="hidden lg:flex items-center gap-2 pl-3 border-l border-gray-300">
            <div class="w-9 h-9 rounded-full overflow-hidden bg-gray-200">
                <img 
                    src="{{ Auth::user()?->photo_url }}"
                    alt="User Avatar"
                    class="w-full h-full object-cover"
                >
            </div>

            <div class="hidden xl:block">
                <p class="text-sm font-bold text-gray-800 leading-tight">
                    {{ Auth::user()?->name ?? 'Admin User' }}
                </p>
                <p class="text-xs text-gray-600">
                    {{ Auth::user()?->role ?? 'Administrator' }}
                </p>
            </div>
        </div>

    </div>
</header>