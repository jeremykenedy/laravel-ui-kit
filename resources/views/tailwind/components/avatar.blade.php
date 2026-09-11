<div {{ $attributes->merge(['class' => 'relative inline-flex']) }}>
    @if($src)
        <img
            src="{{ $src }}"
            alt="{{ $alt ?? '' }}"
            class="{{ $sizeClasses() }} {{ $rounded ? 'rounded-full' : 'rounded-lg' }} object-cover"
            loading="lazy"
            decoding="async"
        />
    @else
        <span
            class="{{ $sizeClasses() }} {{ $rounded ? 'rounded-full' : 'rounded-lg' }} inline-flex select-none items-center justify-center bg-gray-200 font-medium text-gray-600 dark:bg-gray-600 dark:text-gray-300"
            @if($alt) role="img" aria-label="{{ $alt }}" @else aria-hidden="true" @endif
        >
            {{ $computedInitials() }}
        </span>
    @endif

    @if($status)
        <span
            class="absolute bottom-0 right-0 block h-2.5 w-2.5 rounded-full ring-2 ring-white dark:ring-gray-800 {{ $statusClasses() }}"
            role="status"
            aria-label="{{ $status }}"
        ></span>
    @endif
</div>
