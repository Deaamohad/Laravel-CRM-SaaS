<div class="relative" x-data="globalSearch()" x-init="init()">
    <div class="relative">
        <input 
            x-model="query"
            x-on:input="handleInput()"
            x-on:focus="showResults = true"
            type="text" 
            placeholder="Search companies, deals, interactions..." 
            class="w-80 pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white"
        >
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </div>
        
        <!-- Loading indicator -->
        <div x-show="loading" class="absolute inset-y-0 right-0 pr-3 flex items-center">
            <svg class="animate-spin h-4 w-4 text-blue-500" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        </div>
    </div>

    <!-- Search Results Dropdown -->
    <div 
        x-show="showResults"
        x-on:click.away="closeResults()"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 translate-y-1"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-1"
        class="absolute top-full left-0 right-0 mt-2 bg-white rounded-lg shadow-lg border border-gray-200 z-50 max-h-96 overflow-y-auto"
    >
        <div x-show="query.length === 0" class="p-4 text-gray-500 text-center">
            Start typing to search...
        </div>
        
        <div x-show="query.length > 0 && query.length < 2" class="p-4 text-gray-500 text-center">
            Type at least 2 characters...
        </div>
        
        <div x-show="query.length >= 2 && loading" class="p-4 text-gray-500 text-center">
            <div class="flex items-center justify-center">
                <svg class="animate-spin h-5 w-5 text-blue-500 mr-2" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Searching...
            </div>
        </div>
        
        <div x-show="query.length >= 2 && !loading && results.total === 0 && !results.error" class="p-4 text-gray-500 text-center">
            No results found for "<span x-text="query"></span>"
        </div>

        <!-- Error message -->
        <div x-show="results.error" class="p-4 text-red-500 text-center">
            <div class="flex items-center justify-center mb-2">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                </svg>
                <span x-text="results.error"></span>
            </div>
            <template x-if="results.error === 'Please log in to search'">
                <div>
                    <a href="/login" class="text-blue-600 hover:text-blue-800 underline text-sm">
                        Click here to log in
                    </a>
                    <div class="text-xs text-gray-500 mt-1">
                        Test credentials: test@example.com / password
                    </div>
                </div>
            </template>
        </div>

        <!-- Companies Section -->
        <template x-if="results.companies && results.companies.length > 0">
            <div>
                <div class="px-4 py-2 bg-gray-50 border-b font-semibold text-sm text-gray-700">
                    Companies
                </div>
                <template x-for="company in results.companies" :key="company.id">
                    <a x-bind:href="'/companies/' + company.id" class="block px-4 py-3 hover:bg-gray-50 border-b border-gray-100">
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                            <div>
                                <div class="font-medium text-gray-900" x-text="company.name"></div>
                                <div class="text-sm text-gray-500" x-text="company.email"></div>
                            </div>
                        </div>
                    </a>
                </template>
            </div>
        </template>

        <!-- Deals Section -->
        <template x-if="results.deals && results.deals.length > 0">
            <div>
                <div class="px-4 py-2 bg-gray-50 border-b font-semibold text-sm text-gray-700">
                    Deals
                </div>
                <template x-for="deal in results.deals" :key="deal.id">
                    <a x-bind:href="'/deals/' + deal.id" class="block px-4 py-3 hover:bg-gray-50 border-b border-gray-100">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-medium text-gray-900" x-text="deal.title"></div>
                                    <div class="text-sm text-gray-500" x-text="deal.company ? deal.company.name : ''"></div>
                                </div>
                            </div>
                            <div class="text-sm font-medium text-gray-900">
                                $<span x-text="deal.value ? deal.value.toLocaleString() : '0'"></span>
                            </div>
                        </div>
                    </a>
                </template>
            </div>
        </template>

        <!-- Interactions Section -->
        <template x-if="results.interactions && results.interactions.length > 0">
            <div>
                <div class="px-4 py-2 bg-gray-50 border-b font-semibold text-sm text-gray-700">
                    Interactions
                </div>
                <template x-for="interaction in results.interactions" :key="interaction.id">
                    <a x-bind:href="'/interactions/' + interaction.id" class="block px-4 py-3 hover:bg-gray-50 border-b border-gray-100">
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center mr-3">
                                <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                            </div>
                            <div>
                                <div class="font-medium text-gray-900 capitalize" x-text="interaction.type"></div>
                                <div class="text-sm text-gray-500" x-text="interaction.company ? interaction.company.name : ''"></div>
                            </div>
                        </div>
                    </a>
                </template>
            </div>
        </template>

        <!-- View All Results -->
        <template x-if="results.total > 0">
            <div class="px-4 py-3 bg-gray-50 border-t">
                <a x-bind:href="'/search/global?q=' + encodeURIComponent(query)" class="text-blue-600 hover:text-blue-800 font-medium text-sm">
                    View all <span x-text="results.total"></span> results →
                </a>
            </div>
        </template>
    </div>
</div>

<script>
function globalSearch() {
    return {
        query: '',
        results: {
            companies: [],
            deals: [],
            interactions: [],
            total: 0
        },
        showResults: false,
        loading: false,
        searchTimeout: null,

        init() {
            console.log('Global search component initialized');
        },

        handleInput() {
            this.showResults = true;
            
            // Clear existing timeout
            if (this.searchTimeout) {
                clearTimeout(this.searchTimeout);
            }

            // If query is too short, just return
            if (this.query.length < 2) {
                this.results = { companies: [], deals: [], interactions: [], total: 0 };
                this.loading = false;
                return;
            }

            // Set loading and debounce the search
            this.loading = true;
            this.searchTimeout = setTimeout(() => {
                this.performSearch();
            }, 300);
        },

        async performSearch() {
            try {
                console.log('Performing search for:', this.query);
                
                const response = await fetch(`/search/global?q=${encodeURIComponent(this.query)}`, {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                    }
                });
                
                console.log('Response status:', response.status);
                console.log('Response headers:', response.headers);
                
                if (response.status === 401 || response.status === 302) {
                    console.log('Authentication required - user not logged in');
                    this.results = { 
                        companies: [], 
                        deals: [], 
                        interactions: [], 
                        total: 0,
                        error: 'Please log in to search'
                    };
                    return;
                }
                
                if (response.ok) {
                    const data = await response.json();
                    console.log('Search results received:', data);
                    this.results = data;
                } else {
                    console.error('Search failed with status:', response.status);
                    const errorText = await response.text();
                    console.error('Error response:', errorText);
                    this.results = { 
                        companies: [], 
                        deals: [], 
                        interactions: [], 
                        total: 0,
                        error: `Search failed (${response.status})`
                    };
                }
            } catch (error) {
                console.error('Search error:', error);
                this.results = { 
                    companies: [], 
                    deals: [], 
                    interactions: [], 
                    total: 0,
                    error: 'Network error'
                };
            } finally {
                this.loading = false;
            }
        },

        closeResults() {
            this.showResults = false;
        }
    }
}
</script>