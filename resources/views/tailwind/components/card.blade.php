<div {{ $attributes->merge(['class' => 'rounded-lg bg-white dark:bg-gray-800 shadow-sm' . ($bordered ? ' border border-gray-200 dark:border-gray-700' : '') . ($hoverable ? ' hover:shadow-md transition-shadow duration-200' : '')]) }}>
    @if($title || isset($header))
        <div class="border-b border-gray-200 dark:border-gray-700 {{ $paddingClasses() }}">
            @if(isset($header))
                {{ $header }}
            @else
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ $title }}</h3>
                @if($subtitle)
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ $subtitle }}</p>
                @endif
            @endif
        </div>
    @endif

    <div class="{{ $paddingClasses() }}">
        {{ $slot }}
    </div>

    @if($footer || isset($footerSlot))
        <div class="border-t border-gray-200 dark:border-gray-700 {{ $paddingClasses() }} bg-gray-50 dark:bg-gray-800/50 rounded-b-lg">
            {{ $footerSlot ?? $footer }}
        </div>
    @endif
</div>
