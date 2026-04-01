<div {{ $attributes->merge(['class' => 'rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 p-8 ' . ($centered ? 'text-center' : '')]) }}>
    @if($icon)
        <div class="mx-auto mb-4 {{ $variantClasses() }}">
            <x-ui::icon :name="$icon" size="xl" class="mx-auto" />
        </div>
    @endif

    @if($title)
        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">{{ $title }}</h3>
    @endif

    @if($message)
        <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">{{ $message }}</p>
    @endif

    {{ $slot }}
</div>
