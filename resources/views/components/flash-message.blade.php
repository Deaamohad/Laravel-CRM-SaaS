@props(['type' => 'success', 'message'])

@php
    $bgColor = $type === 'success' ? 'bg-green-50' : 'bg-red-50';
    $borderColor = $type === 'success' ? 'border-green-400' : 'border-red-400';
    $textColor = $type === 'success' ? 'text-green-700' : 'text-red-700';
    $iconColor = $type === 'success' ? 'text-green-400' : 'text-red-400';
    $icon = $type === 'success' 
        ? '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>'
        : '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L10 11.414l2.707-2.707a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>';
@endphp

<div class="mb-6 {{ $bgColor }} border-l-4 {{ $borderColor }} p-4 rounded-md shadow-sm">
    <div class="flex">
        <div class="flex-shrink-0">
            <svg class="h-5 w-5 {{ $iconColor }}" fill="currentColor" viewBox="0 0 20 20">
                {!! $icon !!}
            </svg>
        </div>
        <div class="ml-3">
            <p class="text-sm {{ $textColor }} font-medium">{{ $message }}</p>
        </div>
    </div>
</div>