@php $tag = $href ? 'a' : 'div'; @endphp
<{{ $tag }}
    {{ $attributes->merge([
        'href' => $href,
        'class' => 'block rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-6 ' . ($href ? 'hover:border-gray-300 dark:hover:border-gray-600 transition-colors' : ''),
    ]) }}
>
    <div class="flex items-center justify-between">
        <div>
            <p class="text-3xl font-bold {{ $variantColor() }}">{{ $value }}</p>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ $label }}</p>
            @if($change)
                <p class="text-xs mt-2 {{ $changeUp ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                    <svg class="inline h-3 w-3 {{ $changeUp ? '' : 'rotate-180' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7"/></svg>
                    {{ $change }}
                </p>
            @endif
        </div>
        @if($icon)
            <div class="shrink-0">
                <x-ui::icon :name="$icon" size="xl" class="text-gray-300 dark:text-gray-600" />
            </div>
        @endif
    </div>
</{{ $tag }}>
