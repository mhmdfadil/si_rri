<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') - RRI Lhokseumawe</title>
    <!-- Initialize Theme BEFORE Tailwind loads (prevent flash) -->
    <script>
        (function() {
            try {
                const theme = localStorage.getItem('theme') || 
                             (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
                if (theme === 'dark') {
                    document.documentElement.classList.add('dark');
                }
            } catch (e) {
                // Ignore localStorage errors
            }
        })();
    </script>
    
    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Tailwind Config (AFTER CDN loaded) -->
    <script>
        tailwind.config = {
            darkMode: 'class'
        }
    </script>
    <style>
        @keyframes slideIn {
            from { transform: translateX(-100%); }
            to { transform: translateX(0); }
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .sidebar-enter {
            animation: slideIn 0.3s ease-out;
        }
        .overlay-enter {
            animation: fadeIn 0.3s ease-out;
        }
        .gradient-text {
            background: linear-gradient(135deg, #059669 0%, #10b981 50%, #34d399 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        /* Custom scrollbar */
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #10b981;
            border-radius: 3px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #059669;
        }
    </style>
    @stack('styles')
</head>
<body class="bg-gradient-to-br from-emerald-50 via-teal-50 to-green-50 min-h-screen">
    
    <!-- Main Container -->
    <div class="flex h-screen overflow-hidden">
        
        <!-- Sidebar -->
        @include('layouts.sidebar')

        <!-- Overlay for mobile -->
        <div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden lg:hidden"></div>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col overflow-hidden">
            
            <!-- Navbar -->
            @include('layouts.navbar')

            <!-- Content Wrapper -->
            <main class="flex-1 overflow-y-auto custom-scrollbar">
                <div class="p-4 lg:p-6">
                    @yield('content')
                </div>
            </main>

            <!-- Footer -->
            @include('layouts.footer')
        </div>
    </div>

    <script>
        // Sidebar Toggle
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        const openSidebarBtn = document.getElementById('openSidebar');
        const closeSidebarBtn = document.getElementById('closeSidebar');

        function openSidebar() {
            sidebar.classList.remove('-translate-x-full');
            sidebar.classList.add('sidebar-enter');
            overlay.classList.remove('hidden');
            overlay.classList.add('overlay-enter');
            document.body.style.overflow = 'hidden';
        }

        function closeSidebar() {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
            document.body.style.overflow = '';
        }

        openSidebarBtn.addEventListener('click', openSidebar);
        closeSidebarBtn.addEventListener('click', closeSidebar);
        overlay.addEventListener('click', closeSidebar);

        // Close sidebar on ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeSidebar();
            }
        });

        // Handle window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 1024) {
                closeSidebar();
            }
        });

        // Prevent content overflow
        function checkContentOverflow() {
            const mainContent = document.querySelector('main');
            const contentWrapper = document.querySelector('.max-w-7xl');
            
            if (contentWrapper && mainContent) {
                const mainRect = mainContent.getBoundingClientRect();
                const contentRect = contentWrapper.getBoundingClientRect();
                
                // Ensure content stays within bounds
                if (contentRect.width > mainRect.width) {
                    contentWrapper.style.maxWidth = '100%';
                }
            }
        }

        // Check on load and resize
        window.addEventListener('load', checkContentOverflow);
        window.addEventListener('resize', checkContentOverflow);

        // Active menu highlight
        const menuLinks = document.querySelectorAll('nav a');
        menuLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                // Remove active class from all links
                menuLinks.forEach(l => {
                    l.classList.remove('bg-gradient-to-r', 'from-emerald-500', 'to-teal-500', 'text-white');
                    l.classList.add('text-gray-700', 'hover:bg-emerald-50');
                });
                
                // Add active class to clicked link
                this.classList.remove('text-gray-700', 'hover:bg-emerald-50');
                this.classList.add('bg-gradient-to-r', 'from-emerald-500', 'to-teal-500', 'text-white');
            });
        });
    </script>
    @stack('scripts')
</body>
</html>