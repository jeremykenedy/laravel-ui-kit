@php
    $variants = ['primary' => 'bg-blue-600 text-white hover:bg-blue-700', 'secondary' => 'bg-gray-600 text-white hover:bg-gray-700', 'danger' => 'bg-red-600 text-white hover:bg-red-700', 'success' => 'bg-green-600 text-white hover:bg-green-700', 'warning' => 'bg-amber-500 text-white hover:bg-amber-600'];
    $sizes = ['xs' => 'px-2 py-1 text-xs', 'sm' => 'px-3 py-1.5 text-sm', 'md' => 'px-4 py-2 text-sm', 'lg' => 'px-6 py-3 text-base'];
    $cls = 'inline-flex items-center justify-center font-medium rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 ' . ($variants[$variant] ?? $variants['primary']) . ' ' . ($sizes[$size] ?? $sizes['md']);
@endphp

@if($href)
    <a href="{{ $href }}" class="{{ $cls }}">{{ $slot }}</a>
@else
    <button type="{{ $type }}" class="{{ $cls }}" @if($disabled || $loading) disabled @endif wire:loading.attr="disabled">
        @if($loading)<svg class="animate-spin -ml-1 mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>@endif
        {{ $slot }}
    </button>
@endif
