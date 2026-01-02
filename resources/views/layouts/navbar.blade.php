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
        <button id="mobileSearchBtn" class="lg:hidden text-gray-700 hover:bg-gray-100 p-2 rounded-lg transition-colors">
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
                class="w-64 pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 transition-all outline-none text-sm"
            />
            <svg class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
            <button id="clearSearch" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 hidden">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
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

<!-- Mobile Search Modal -->
<div id="mobileSearchModal" class="fixed inset-0 bg-white z-50 hidden lg:hidden flex-col">
    <div class="flex items-center gap-3 p-4 border-b bg-white shadow-sm">
        <button id="closeMobileSearch" class="text-gray-700 hover:bg-gray-100 p-2 rounded-lg transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </button>
        <div class="flex-1 relative">
            <input 
                type="text" 
                id="mobileSearchInput"
                placeholder="Cari konten..." 
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 outline-none"
            />
            <button id="clearMobileSearch" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 hidden">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    </div>
    <div id="mobileSearchInfo" class="px-4 py-2 bg-emerald-50 border-b hidden">
        <p class="text-sm text-emerald-700">
            <span id="mobileMatchCount">0</span> hasil ditemukan
            <span id="mobileCurrentMatch" class="ml-2 hidden">
                (<span id="mobileCurrentNum">1</span> dari <span id="mobileTotalNum">0</span>)
            </span>
        </p>
    </div>
    <div id="mobileSearchContent" class="flex-1 overflow-y-auto bg-gradient-to-br from-emerald-50 via-teal-50 to-green-50 p-4">
        <!-- Content will be cloned here -->
    </div>
    <div class="p-4 bg-white border-t flex gap-2" id="mobileSearchNav">
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
    
    .search-highlight-current {
        background-color: #fb923c;
        color: #7c2d12;
    }
</style>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
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

    // Function to escape regex special characters
    function escapeRegex(string) {
        return string.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
    }

    // Function to highlight text in container
    function highlightTextInContainer(container, searchTerm) {
        if (!searchTerm || searchTerm.length < 2) return [];

        // Get all text nodes
        const walker = document.createTreeWalker(
            container,
            NodeFilter.SHOW_TEXT,
            {
                acceptNode: function(node) {
                    // Skip script and style tags
                    if (node.parentElement.tagName === 'SCRIPT' || 
                        node.parentElement.tagName === 'STYLE') {
                        return NodeFilter.FILTER_REJECT;
                    }
                    // Only accept nodes with text content
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

        // Highlight matches
        const regex = new RegExp(`(${escapeRegex(searchTerm)})`, 'gi');
        
        textNodes.forEach(textNode => {
            const text = textNode.textContent;
            if (regex.test(text)) {
                const span = document.createElement('span');
                span.innerHTML = text.replace(regex, '<mark class="search-highlight">$1</mark>');
                textNode.parentNode.replaceChild(span, textNode);
            }
        });

        // Collect and return all highlighted elements
        return Array.from(container.querySelectorAll('.search-highlight'));
    }

    // Function to highlight text (Desktop)
    function highlightText(searchTerm) {
        // Remove previous highlights
        removeHighlights();
        
        const mainContent = document.querySelector('main');
        if (!mainContent) return;

        highlightedElements = highlightTextInContainer(mainContent, searchTerm);
        
        if (highlightedElements.length > 0) {
            currentHighlightIndex = 0;
            scrollToHighlight(0);
            showSearchInfo();
        }
    }

    // Function to remove highlights
    function removeHighlights() {
        const mainContent = document.querySelector('main');
        if (!mainContent) return;

        const highlights = mainContent.querySelectorAll('.search-highlight');
        highlights.forEach(highlight => {
            const parent = highlight.parentNode;
            parent.replaceChild(document.createTextNode(highlight.textContent), highlight);
            parent.normalize(); // Merge adjacent text nodes
        });

        // Remove wrapper spans
        const spans = mainContent.querySelectorAll('span');
        spans.forEach(span => {
            if (span.childNodes.length === 1 && span.childNodes[0].nodeType === Node.TEXT_NODE) {
                span.parentNode.replaceChild(span.firstChild, span);
            }
        });

        highlightedElements = [];
        currentHighlightIndex = 0;
        hideSearchInfo();
    }

    // Function to scroll to highlight
    function scrollToHighlight(index) {
        if (highlightedElements.length === 0) return;

        // Remove current highlight from all
        highlightedElements.forEach(el => {
            el.classList.remove('search-highlight-current');
        });

        // Add current highlight
        const element = highlightedElements[index];
        element.classList.add('search-highlight-current');
        
        // Scroll to element
        element.scrollIntoView({
            behavior: 'smooth',
            block: 'center'
        });
    }

    // Function to scroll to mobile highlight
    function scrollToMobileHighlight(index) {
        if (mobileHighlightedElements.length === 0) return;

        // Remove current highlight from all
        mobileHighlightedElements.forEach(el => {
            el.classList.remove('search-highlight-current');
        });

        // Add current highlight
        const element = mobileHighlightedElements[index];
        element.classList.add('search-highlight-current');
        
        // Scroll to element in mobile modal
        element.scrollIntoView({
            behavior: 'smooth',
            block: 'center'
        });
    }

    // Function to show search info
    function showSearchInfo() {
        // You can add a notification or counter here
        console.log(`Found ${highlightedElements.length} matches`);
    }

    // Function to hide search info
    function hideSearchInfo() {
        // Hide any search info notification
    }

    // Desktop search
    if (searchInput) {
        let searchTimeout;
        searchInput.addEventListener('input', function(e) {
            const value = e.target.value.trim();
            
            // Show/hide clear button
            if (value.length > 0) {
                clearSearchBtn.classList.remove('hidden');
            } else {
                clearSearchBtn.classList.add('hidden');
            }

            // Debounce search
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                highlightText(value);
            }, 300);
        });

        // Navigate with Enter and Shift+Enter
        searchInput.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' && highlightedElements.length > 0) {
                if (e.shiftKey) {
                    // Previous match
                    currentHighlightIndex = (currentHighlightIndex - 1 + highlightedElements.length) % highlightedElements.length;
                } else {
                    // Next match
                    currentHighlightIndex = (currentHighlightIndex + 1) % highlightedElements.length;
                }
                scrollToHighlight(currentHighlightIndex);
            }
        });

        // Clear search
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
            // Clone main content to mobile modal
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

        // Update mobile search info
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
            
            // Show/hide clear button
            if (value.length > 0) {
                clearMobileSearchBtn.classList.remove('hidden');
            } else {
                clearMobileSearchBtn.classList.add('hidden');
                mobileSearchInfo.classList.add('hidden');
            }

            clearTimeout(mobileSearchTimeout);
            mobileSearchTimeout = setTimeout(() => {
                // Remove previous highlights in mobile content
                mobileSearchContent.querySelectorAll('.search-highlight').forEach(el => {
                    const parent = el.parentNode;
                    parent.replaceChild(document.createTextNode(el.textContent), el);
                    parent.normalize();
                });
                
                // Remove wrapper spans
                mobileSearchContent.querySelectorAll('span').forEach(span => {
                    if (span.childNodes.length === 1 && span.childNodes[0].nodeType === Node.TEXT_NODE) {
                        span.parentNode.replaceChild(span.firstChild, span);
                    }
                });
                
                // Highlight in mobile content
                mobileHighlightedElements = highlightTextInContainer(mobileSearchContent, value);
                mobileCurrentIndex = 0;
                
                if (mobileHighlightedElements.length > 0) {
                    scrollToMobileHighlight(0);
                }
                
                updateMobileSearchInfo();
            }, 300);
        });

        // Clear mobile search
        clearMobileSearchBtn.addEventListener('click', function() {
            mobileSearchInput.value = '';
            clearMobileSearchBtn.classList.add('hidden');
            mobileSearchInfo.classList.add('hidden');
            
            // Remove highlights
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

        // Mobile navigation buttons
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

    // Clear highlights when navigating away
    window.addEventListener('beforeunload', function() {
        removeHighlights();
    });
});
</script>
@endpush