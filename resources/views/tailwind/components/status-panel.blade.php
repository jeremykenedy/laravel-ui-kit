<div
    {{ $attributes->merge(['class' => 'rounded-lg border border-gray-200 bg-white p-8 dark:border-gray-700 dark:bg-gray-800 ' . ($centered ? 'text-center' : '')]) }}
    role="status"
    aria-live="polite"
>
    @if($icon)
        <div class="mx-auto mb-4 {{ $variantClasses() }}">
            <x-ui::icon :name="$icon" size="xl" class="mx-auto" aria-hidden="true" />
        </div>
    @endif

    @if($title)
        <h3 class="mb-2 text-lg font-medium text-gray-900 dark:text-gray-100">{{ $title }}</h3>
    @endif

    @if($message)
        <p class="mb-4 text-sm text-gray-500 dark:text-gray-400">{{ $message }}</p>
    @endif

    {{ $slot }}
</div>
