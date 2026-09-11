@php $tag = $href ? 'a' : 'div'; @endphp
<{{ $tag }}
    {{ $attributes->merge([
        'href' => $href,
        'class' => 'block rounded-lg border border-gray-200 bg-white p-6 dark:border-gray-700 dark:bg-gray-800' . ($href ? ' transition-colors hover:border-gray-300 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 motion-reduce:transition-none dark:hover:border-gray-600' : ''),
    ]) }}
>
    <div class="flex items-center justify-between">
        <div>
            <p class="text-3xl font-bold {{ $variantColor() }}">{{ $value }}</p>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ $label }}</p>
            @if($change)
                <p class="mt-2 text-xs {{ $changeUp ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                    <svg class="inline h-3 w-3 {{ $changeUp ? '' : 'rotate-180' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true" focusable="false"><path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7"/></svg>
                    {{ $change }}
                </p>
            @endif
        </div>
        @if($icon)
            <div class="shrink-0">
                <x-ui::icon :name="$icon" size="xl" class="text-gray-300 dark:text-gray-600" aria-hidden="true" />
            </div>
        @endif
    </div>
</{{ $tag }}>
