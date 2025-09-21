<div class="bg-white rounded-lg shadow-sm p-4 mb-6" x-data="{ showFilters: false }">
    <div class="flex items-center justify-between">
        <div class="flex items-center space-x-4">
            <!-- Search Input -->
            <div class="relative">
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}"
                    placeholder="Search {{ $type }}..." 
                    class="w-64 pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    onchange="this.form.submit()"
                >
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>

            <!-- Quick Filters -->
            @if($type === 'deals')
            <select 
                name="stage" 
                class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                onchange="this.form.submit()"
            >
                <option value="">All Stages</option>
                <option value="lead" {{ request('stage') === 'lead' ? 'selected' : '' }}>Lead</option>
                <option value="qualified" {{ request('stage') === 'qualified' ? 'selected' : '' }}>Qualified</option>
                <option value="proposal" {{ request('stage') === 'proposal' ? 'selected' : '' }}>Proposal</option>
                <option value="negotiation" {{ request('stage') === 'negotiation' ? 'selected' : '' }}>Negotiation</option>
                <option value="closed_won" {{ request('stage') === 'closed_won' ? 'selected' : '' }}>Closed Won</option>
                <option value="closed_lost" {{ request('stage') === 'closed_lost' ? 'selected' : '' }}>Closed Lost</option>
            </select>
            @endif

            @if($type === 'companies')
            <select 
                name="industry" 
                class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                onchange="this.form.submit()"
            >
                <option value="">All Industries</option>
                <option value="technology" {{ request('industry') === 'technology' ? 'selected' : '' }}>Technology</option>
                <option value="healthcare" {{ request('industry') === 'healthcare' ? 'selected' : '' }}>Healthcare</option>
                <option value="finance" {{ request('industry') === 'finance' ? 'selected' : '' }}>Finance</option>
                <option value="education" {{ request('industry') === 'education' ? 'selected' : '' }}>Education</option>
                <option value="retail" {{ request('industry') === 'retail' ? 'selected' : '' }}>Retail</option>
                <option value="manufacturing" {{ request('industry') === 'manufacturing' ? 'selected' : '' }}>Manufacturing</option>
                <option value="other" {{ request('industry') === 'other' ? 'selected' : '' }}>Other</option>
            </select>
            @endif

            @if($type === 'interactions')
            <select 
                name="type" 
                class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                onchange="this.form.submit()"
            >
                <option value="">All Types</option>
                <option value="call" {{ request('type') === 'call' ? 'selected' : '' }}>Call</option>
                <option value="email" {{ request('type') === 'email' ? 'selected' : '' }}>Email</option>
                <option value="meeting" {{ request('type') === 'meeting' ? 'selected' : '' }}>Meeting</option>
                <option value="note" {{ request('type') === 'note' ? 'selected' : '' }}>Note</option>
            </select>
            @endif
        </div>

        <!-- Advanced Filters Toggle -->
        <button 
            @click="showFilters = !showFilters"
            type="button"
            class="inline-flex items-center px-3 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500"
        >
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4"></path>
            </svg>
            Advanced Filters
            <svg class="w-4 h-4 ml-1 transition-transform duration-200" :class="showFilters ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </button>
    </div>

    <!-- Advanced Filters Panel -->
    <div 
        x-show="showFilters"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 transform scale-95"
        x-transition:enter-end="opacity-100 transform scale-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 transform scale-100"
        x-transition:leave-end="opacity-0 transform scale-95"
        class="mt-4 pt-4 border-t border-gray-200"
        style="display: none;"
    >
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Date Range -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Date Range</label>
                <div class="space-y-2">
                    <input 
                        type="date" 
                        name="from_date" 
                        value="{{ request('from_date') }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="From"
                    >
                    <input 
                        type="date" 
                        name="to_date" 
                        value="{{ request('to_date') }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="To"
                    >
                </div>
            </div>

            @if($type === 'deals')
            <!-- Value Range -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Value Range</label>
                <div class="space-y-2">
                    <input 
                        type="number" 
                        name="min_value" 
                        value="{{ request('min_value') }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Minimum value"
                    >
                    <input 
                        type="number" 
                        name="max_value" 
                        value="{{ request('max_value') }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Maximum value"
                    >
                </div>
            </div>

            <!-- Sort By -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Sort By</label>
                <select 
                    name="sort" 
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                    <option value="created_at_desc" {{ request('sort') === 'created_at_desc' ? 'selected' : '' }}>Newest First</option>
                    <option value="created_at_asc" {{ request('sort') === 'created_at_asc' ? 'selected' : '' }}>Oldest First</option>
                    <option value="value_desc" {{ request('sort') === 'value_desc' ? 'selected' : '' }}>Highest Value</option>
                    <option value="value_asc" {{ request('sort') === 'value_asc' ? 'selected' : '' }}>Lowest Value</option>
                    <option value="title_asc" {{ request('sort') === 'title_asc' ? 'selected' : '' }}>Title A-Z</option>
                    <option value="title_desc" {{ request('sort') === 'title_desc' ? 'selected' : '' }}>Title Z-A</option>
                </select>
            </div>
            @else
            <!-- Sort By -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Sort By</label>
                <select 
                    name="sort" 
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                    <option value="created_at_desc" {{ request('sort') === 'created_at_desc' ? 'selected' : '' }}>Newest First</option>
                    <option value="created_at_asc" {{ request('sort') === 'created_at_asc' ? 'selected' : '' }}>Oldest First</option>
                    @if($type === 'companies')
                    <option value="name_asc" {{ request('sort') === 'name_asc' ? 'selected' : '' }}>Name A-Z</option>
                    <option value="name_desc" {{ request('sort') === 'name_desc' ? 'selected' : '' }}>Name Z-A</option>
                    @endif
                    @if($type === 'interactions')
                    <option value="type_asc" {{ request('sort') === 'type_asc' ? 'selected' : '' }}>Type A-Z</option>
                    <option value="interaction_date_desc" {{ request('sort') === 'interaction_date_desc' ? 'selected' : '' }}>Recent Interactions</option>
                    @endif
                </select>
            </div>
            @endif
        </div>

        <div class="flex justify-end space-x-3 mt-4">
            <a 
                href="{{ request()->url() }}"
                class="px-4 py-2 text-gray-600 bg-gray-100 rounded-md hover:bg-gray-200 transition-colors"
            >
                Clear All
            </a>
            <button 
                type="submit"
                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors"
            >
                Apply Filters
            </button>
        </div>
    </div>
</div>