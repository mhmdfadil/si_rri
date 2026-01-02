<header class="h-16 bg-white dark:bg-gray-800 shadow-md flex items-center justify-between px-4 lg:px-6 z-30 transition-colors duration-200">
    
    <!-- Left Side -->
    <div class="flex items-center gap-4">
        <button id="openSidebar" class="lg:hidden text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 p-2 rounded-lg transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>
        
        <div class="hidden lg:block">
            <h1 class="text-xl font-bold text-gray-800 dark:text-white">@yield('page-title', 'Dashboard')</h1>
            <p class="text-xs text-gray-600 dark:text-gray-400">@yield('page-subtitle', 'Selamat datang di sistem database RRI')</p>
        </div>
    </div>

    <!-- Right Side -->
    <div class="flex items-center gap-3">
        
        <!-- Search Button (Mobile) -->
        <button id="mobileSearchBtn" class="lg:hidden text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 p-2 rounded-lg transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </button>

        <!-- Search Bar (Desktop) -->
        <div class="hidden lg:flex relative">
            <input 
                type="text" 
                id="searchInput"
                placeholder="Cari konten..." 
                class="w-64 pl-10 pr-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:border-emerald-500 dark:focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 dark:focus:ring-emerald-900 transition-all outline-none text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100"
            />
            <svg class="w-5 h-5 text-gray-400 dark:text-gray-500 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
            <button id="clearSearch" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 hidden">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Dark Mode Toggle -->
        <button id="themeToggle" class="relative text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 p-2 rounded-lg transition-colors" title="Toggle Dark Mode">
            <!-- Sun Icon (Show in Dark Mode) -->
            <svg id="sunIcon" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
            </svg>
            <!-- Moon Icon (Show in Light Mode) -->
            <svg id="moonIcon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
            </svg>
        </button>

        <!-- User Profile -->
        <div class="hidden lg:flex items-center gap-2 pl-3 border-l border-gray-300 dark:border-gray-600">
            <div class="w-9 h-9 rounded-full overflow-hidden bg-gray-200 dark:bg-gray-700">
                <img 
                    src="{{ Auth::user()?->photo_url }}"
                    alt="User Avatar"
                    class="w-full h-full object-cover"
                >
            </div>

            <div class="hidden xl:block">
                <p class="text-sm font-bold text-gray-800 dark:text-white leading-tight">
                    {{ Auth::user()?->name ?? 'Admin User' }}
                </p>
                <p class="text-xs text-gray-600 dark:text-gray-400">
                    {{ Auth::user()?->role ?? 'Administrator' }}
                </p>
            </div>
        </div>

    </div>
</header>

<!-- Mobile Search Modal -->
<div id="mobileSearchModal" class="fixed inset-0 bg-white dark:bg-gray-800 z-50 hidden lg:hidden flex-col">
    <div class="flex items-center gap-3 p-4 border-b dark:border-gray-700 bg-white dark:bg-gray-800 shadow-sm">
        <button id="closeMobileSearch" class="text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 p-2 rounded-lg transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </button>
        <div class="flex-1 relative">
            <input 
                type="text" 
                id="mobileSearchInput"
                placeholder="Cari konten..." 
                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:border-emerald-500 dark:focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 dark:focus:ring-emerald-900 outline-none bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100"
            />
            <button id="clearMobileSearch" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 hidden">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    </div>
    <div id="mobileSearchInfo" class="px-4 py-2 bg-emerald-50 dark:bg-emerald-900/30 border-b dark:border-gray-700 hidden">
        <p class="text-sm text-emerald-700 dark:text-emerald-300">
            <span id="mobileMatchCount">0</span> hasil ditemukan
            <span id="mobileCurrentMatch" class="ml-2 hidden">
                (<span id="mobileCurrentNum">1</span> dari <span id="mobileTotalNum">0</span>)
            </span>
        </p>
    </div>
    <div id="mobileSearchContent" class="flex-1 overflow-y-auto bg-gradient-to-br from-emerald-50 via-teal-50 to-green-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 p-4">
        <!-- Content will be cloned here -->
    </div>
    <div class="p-4 bg-white dark:bg-gray-800 border-t dark:border-gray-700 flex gap-2" id="mobileSearchNav">
        <button id="mobilePrevMatch" class="flex-1 px-4 py-2 bg-emerald-500 text-white rounded-lg hover:bg-emerald-600 transition-colors disabled:opacity-50 disabled:cursor-not-allowed" disabled>
            ← Sebelumnya
        </button>
        <button id="mobileNextMatch" class="flex-1 px-4 py-2 bg-emerald-500 text-white rounded-lg hover:bg-emerald-600 transition-colors disabled:opacity-50 disabled:cursor-not-allowed" disabled>
            Selanjutnya →
        </button>
    </div>
</div>

<style>
    /* Highlight style */
    .search-highlight {
        background-color: #fde047;
        color: #854d0e;
        font-weight: 600;
        padding: 2px 0;
        border-radius: 2px;
    }
    
    .dark .search-highlight {
        background-color: #fbbf24;
        color: #451a03;
    }
    
    .search-highlight-current {
        background-color: #fb923c;
        color: #7c2d12;
    }
    
    .dark .search-highlight-current {
        background-color: #f97316;
        color: #431407;
    }
</style>

@push('scripts')
<script>
// Initialize theme IMMEDIATELY before DOM loads (moved to inline script)
(function() {
    function getStoredTheme() {
        try {
            const stored = localStorage.getItem('theme');
            if (stored) return stored;
            return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
        } catch (e) {
            return 'light';
        }
    }
    
    function applyTheme(theme) {
        if (theme === 'dark') {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    }
    
    // Apply immediately
    applyTheme(getStoredTheme());
})();

document.addEventListener('DOMContentLoaded', function() {
    // ============================================
    // DARK MODE FUNCTIONALITY
    // ============================================
    const themeToggle = document.getElementById('themeToggle');
    const sunIcon = document.getElementById('sunIcon');
    const moonIcon = document.getElementById('moonIcon');
    const htmlElement = document.documentElement;
    
    // Update icon visibility
    function updateIcons() {
        const isDark = htmlElement.classList.contains('dark');
        if (isDark) {
            sunIcon.classList.remove('hidden');
            moonIcon.classList.add('hidden');
        } else {
            sunIcon.classList.add('hidden');
            moonIcon.classList.remove('hidden');
        }
    }
    
    // Initialize icons
    updateIcons();
    
    // Toggle theme
    if (themeToggle) {
        themeToggle.addEventListener('click', function() {
            const currentTheme = htmlElement.classList.contains('dark') ? 'dark' : 'light';
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            
            if (newTheme === 'dark') {
                htmlElement.classList.add('dark');
            } else {
                htmlElement.classList.remove('dark');
            }
            
            try {
                localStorage.setItem('theme', newTheme);
            } catch (e) {
                console.warn('Could not save theme preference');
            }
            
            updateIcons();
        });
    }
    
    // Listen for system theme changes (optional)
    try {
        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
            // Only update if user hasn't manually set a preference
            if (!localStorage.getItem('theme')) {
                if (e.matches) {
                    htmlElement.classList.add('dark');
                } else {
                    htmlElement.classList.remove('dark');
                }
                updateIcons();
            }
        });
    } catch (e) {
        // Ignore if browser doesn't support this
    }

    // ============================================
    // SEARCH FUNCTIONALITY
    // ============================================
    const searchInput = document.getElementById('searchInput');
    const clearSearchBtn = document.getElementById('clearSearch');
    const mobileSearchBtn = document.getElementById('mobileSearchBtn');
    const mobileSearchModal = document.getElementById('mobileSearchModal');
    const mobileSearchInput = document.getElementById('mobileSearchInput');
    const closeMobileSearch = document.getElementById('closeMobileSearch');
    const mobileSearchContent = document.getElementById('mobileSearchContent');
    
    let currentHighlightIndex = 0;
    let highlightedElements = [];
    let mobileHighlightedElements = [];
    let mobileCurrentIndex = 0;

    function escapeRegex(string) {
        return string.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
    }

    function highlightTextInContainer(container, searchTerm) {
        if (!searchTerm || searchTerm.length < 2) return [];

        const walker = document.createTreeWalker(
            container,
            NodeFilter.SHOW_TEXT,
            {
                acceptNode: function(node) {
                    if (node.parentElement.tagName === 'SCRIPT' || 
                        node.parentElement.tagName === 'STYLE') {
                        return NodeFilter.FILTER_REJECT;
                    }
                    if (node.textContent.trim().length > 0) {
                        return NodeFilter.FILTER_ACCEPT;
                    }
                    return NodeFilter.FILTER_REJECT;
                }
            }
        );

        const textNodes = [];
        let node;
        while (node = walker.nextNode()) {
            textNodes.push(node);
        }

        const regex = new RegExp(`(${escapeRegex(searchTerm)})`, 'gi');
        
        textNodes.forEach(textNode => {
            const text = textNode.textContent;
            if (regex.test(text)) {
                const span = document.createElement('span');
                span.innerHTML = text.replace(regex, '<mark class="search-highlight">$1</mark>');
                textNode.parentNode.replaceChild(span, textNode);
            }
        });

        return Array.from(container.querySelectorAll('.search-highlight'));
    }

    function highlightText(searchTerm) {
        removeHighlights();
        
        const mainContent = document.querySelector('main');
        if (!mainContent) return;

        highlightedElements = highlightTextInContainer(mainContent, searchTerm);
        
        if (highlightedElements.length > 0) {
            currentHighlightIndex = 0;
            scrollToHighlight(0);
        }
    }

    function removeHighlights() {
        const mainContent = document.querySelector('main');
        if (!mainContent) return;

        const highlights = mainContent.querySelectorAll('.search-highlight');
        highlights.forEach(highlight => {
            const parent = highlight.parentNode;
            parent.replaceChild(document.createTextNode(highlight.textContent), highlight);
            parent.normalize();
        });

        const spans = mainContent.querySelectorAll('span');
        spans.forEach(span => {
            if (span.childNodes.length === 1 && span.childNodes[0].nodeType === Node.TEXT_NODE) {
                span.parentNode.replaceChild(span.firstChild, span);
            }
        });

        highlightedElements = [];
        currentHighlightIndex = 0;
    }

    function scrollToHighlight(index) {
        if (highlightedElements.length === 0) return;

        highlightedElements.forEach(el => {
            el.classList.remove('search-highlight-current');
        });

        const element = highlightedElements[index];
        element.classList.add('search-highlight-current');
        
        element.scrollIntoView({
            behavior: 'smooth',
            block: 'center'
        });
    }

    function scrollToMobileHighlight(index) {
        if (mobileHighlightedElements.length === 0) return;

        mobileHighlightedElements.forEach(el => {
            el.classList.remove('search-highlight-current');
        });

        const element = mobileHighlightedElements[index];
        element.classList.add('search-highlight-current');
        
        element.scrollIntoView({
            behavior: 'smooth',
            block: 'center'
        });
    }

    // Desktop search
    if (searchInput) {
        let searchTimeout;
        searchInput.addEventListener('input', function(e) {
            const value = e.target.value.trim();
            
            if (value.length > 0) {
                clearSearchBtn.classList.remove('hidden');
            } else {
                clearSearchBtn.classList.add('hidden');
            }

            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                highlightText(value);
            }, 300);
        });

        searchInput.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' && highlightedElements.length > 0) {
                if (e.shiftKey) {
                    currentHighlightIndex = (currentHighlightIndex - 1 + highlightedElements.length) % highlightedElements.length;
                } else {
                    currentHighlightIndex = (currentHighlightIndex + 1) % highlightedElements.length;
                }
                scrollToHighlight(currentHighlightIndex);
            }
        });

        clearSearchBtn.addEventListener('click', function() {
            searchInput.value = '';
            clearSearchBtn.classList.add('hidden');
            removeHighlights();
        });
    }

    // Mobile search
    if (mobileSearchBtn) {
        const clearMobileSearchBtn = document.getElementById('clearMobileSearch');
        const mobileSearchInfo = document.getElementById('mobileSearchInfo');
        const mobileMatchCount = document.getElementById('mobileMatchCount');
        const mobileCurrentMatch = document.getElementById('mobileCurrentMatch');
        const mobileCurrentNum = document.getElementById('mobileCurrentNum');
        const mobileTotalNum = document.getElementById('mobileTotalNum');
        const mobilePrevMatch = document.getElementById('mobilePrevMatch');
        const mobileNextMatch = document.getElementById('mobileNextMatch');

        mobileSearchBtn.addEventListener('click', function() {
            const mainContent = document.querySelector('main');
            if (mainContent) {
                const clonedContent = mainContent.cloneNode(true);
                mobileSearchContent.innerHTML = '';
                mobileSearchContent.appendChild(clonedContent);
            }
            
            mobileSearchModal.classList.remove('hidden');
            mobileSearchModal.classList.add('flex');
            setTimeout(() => {
                mobileSearchInput.focus();
            }, 100);
        });

        closeMobileSearch.addEventListener('click', function() {
            mobileSearchModal.classList.add('hidden');
            mobileSearchModal.classList.remove('flex');
            mobileSearchInput.value = '';
            clearMobileSearchBtn.classList.add('hidden');
            mobileSearchInfo.classList.add('hidden');
            mobileSearchContent.innerHTML = '';
            mobileHighlightedElements = [];
            mobileCurrentIndex = 0;
        });

        function updateMobileSearchInfo() {
            if (mobileHighlightedElements.length > 0) {
                mobileSearchInfo.classList.remove('hidden');
                mobileMatchCount.textContent = mobileHighlightedElements.length;
                mobileCurrentMatch.classList.remove('hidden');
                mobileCurrentNum.textContent = mobileCurrentIndex + 1;
                mobileTotalNum.textContent = mobileHighlightedElements.length;
                
                mobilePrevMatch.disabled = false;
                mobileNextMatch.disabled = false;
            } else {
                mobileSearchInfo.classList.add('hidden');
                mobilePrevMatch.disabled = true;
                mobileNextMatch.disabled = true;
            }
        }

        let mobileSearchTimeout;
        mobileSearchInput.addEventListener('input', function(e) {
            const value = e.target.value.trim();
            
            if (value.length > 0) {
                clearMobileSearchBtn.classList.remove('hidden');
            } else {
                clearMobileSearchBtn.classList.add('hidden');
                mobileSearchInfo.classList.add('hidden');
            }

            clearTimeout(mobileSearchTimeout);
            mobileSearchTimeout = setTimeout(() => {
                mobileSearchContent.querySelectorAll('.search-highlight').forEach(el => {
                    const parent = el.parentNode;
                    parent.replaceChild(document.createTextNode(el.textContent), el);
                    parent.normalize();
                });
                
                mobileSearchContent.querySelectorAll('span').forEach(span => {
                    if (span.childNodes.length === 1 && span.childNodes[0].nodeType === Node.TEXT_NODE) {
                        span.parentNode.replaceChild(span.firstChild, span);
                    }
                });
                
                mobileHighlightedElements = highlightTextInContainer(mobileSearchContent, value);
                mobileCurrentIndex = 0;
                
                if (mobileHighlightedElements.length > 0) {
                    scrollToMobileHighlight(0);
                }
                
                updateMobileSearchInfo();
            }, 300);
        });

        clearMobileSearchBtn.addEventListener('click', function() {
            mobileSearchInput.value = '';
            clearMobileSearchBtn.classList.add('hidden');
            mobileSearchInfo.classList.add('hidden');
            
            mobileSearchContent.querySelectorAll('.search-highlight').forEach(el => {
                const parent = el.parentNode;
                parent.replaceChild(document.createTextNode(el.textContent), el);
                parent.normalize();
            });
            
            mobileHighlightedElements = [];
            mobileCurrentIndex = 0;
            updateMobileSearchInfo();
            mobileSearchInput.focus();
        });

        mobilePrevMatch.addEventListener('click', function() {
            if (mobileHighlightedElements.length > 0) {
                mobileCurrentIndex = (mobileCurrentIndex - 1 + mobileHighlightedElements.length) % mobileHighlightedElements.length;
                scrollToMobileHighlight(mobileCurrentIndex);
                updateMobileSearchInfo();
            }
        });

        mobileNextMatch.addEventListener('click', function() {
            if (mobileHighlightedElements.length > 0) {
                mobileCurrentIndex = (mobileCurrentIndex + 1) % mobileHighlightedElements.length;
                scrollToMobileHighlight(mobileCurrentIndex);
                updateMobileSearchInfo();
            }
        });
    }

    window.addEventListener('beforeunload', function() {
        removeHighlights();
    });
});
</script>
@endpush