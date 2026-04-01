<div {{ $attributes->merge(['class' => $inline ? 'flex items-center gap-4' : 'mb-4']) }}>
    @if($label)
        <label @if($name) for="{{ $name }}" @endif class="block text-sm font-medium text-gray-700 dark:text-gray-300 {{ $inline ? '' : 'mb-1' }}">
            {{ $label }}
            @if($required)
                <span class="text-red-500">*</span>
            @endif
        </label>
    @endif

    <div class="{{ $inline ? 'flex-1' : '' }}">
        {{ $slot }}
    </div>

    @if($hasError())
        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $errorMessage() }}</p>
    @elseif($hint)
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ $hint }}</p>
    @endif
</div>
