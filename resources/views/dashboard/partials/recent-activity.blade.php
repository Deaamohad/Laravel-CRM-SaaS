@forelse($recent_interactions as $interaction)
<div class="flex items-start space-x-3">
    <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-purple-500 rounded-full flex items-center justify-center flex-shrink-0">
        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M18 13V5a2 2 0 00-2-2H4a2 2 0 00-2 2v8a2 2 0 002 2h3l3 3 3-3h3a2 2 0 002-2zM5 7a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1zm1 3a1 1 0 100 2h3a1 1 0 100-2H6z" clip-rule="evenodd"/>
        </svg>
    </div>
    <div class="flex-1 min-w-0">
        <p class="text-sm text-gray-900">{{ $interaction->type }} interaction</p>
        <p class="text-xs text-gray-500">{{ $interaction->created_at->diffForHumans() }}</p>
    </div>
</div>
@empty
<div class="text-center py-4">
    <p class="text-gray-500 text-sm">No recent interactions</p>
</div>
@endforelse