@php
    $describedBy = collect([
        $hasError() && $name ? $name . '-error' : null,
        !$hasError() && $hint && $name ? $name . '-hint' : null,
    ])->filter()->implode(' ');
@endphp
<div {{ $attributes->merge(['class' => $inline ? 'flex items-center gap-4' : 'mb-4']) }}>
    @if($label)
        <label @if($name) for="{{ $name }}" @endif class="block text-sm font-medium text-gray-700 dark:text-gray-300 {{ $inline ? '' : 'mb-1' }}">
            {{ $label }}
            @if($required)
                <span class="text-red-500" aria-hidden="true">*</span>
            @endif
        </label>
    @endif

    <div class="{{ $inline ? 'flex-1' : '' }}" @if($describedBy) aria-describedby="{{ $describedBy }}" @endif>
        {{ $slot }}
    </div>

    @if($hasError())
        <p @if($name) id="{{ $name }}-error" @endif class="mt-1 text-sm text-red-600 dark:text-red-400" role="alert">{{ $errorMessage() }}</p>
    @elseif($hint)
        <p @if($name) id="{{ $name }}-hint" @endif class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ $hint }}</p>
    @endif
</div>
