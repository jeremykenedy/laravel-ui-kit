@php
    $describedBy = collect([
        $hasError() && $id ? $id . '-error' : null,
        !$hasError() && $hint && $id ? $id . '-hint' : null,
    ])->filter()->implode(' ');
@endphp
<div>
    @if($label)
        <label @if($id) for="{{ $id }}" @endif class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">
            {{ $label }}
            @if($required)
                <span class="text-red-500" aria-hidden="true">*</span>
            @endif
        </label>
    @endif

    <div class="relative">
        @if($icon && $iconPosition === 'left')
            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                <x-ui::icon :name="$icon" size="sm" class="text-gray-400" aria-hidden="true" />
            </div>
        @endif

        <input
            {{ $attributes->merge([
                'type' => $type,
                'name' => $name,
                'id' => $id,
                'value' => $value ?? old($name),
                'placeholder' => $placeholder,
                'required' => $required,
                'disabled' => $disabled,
                'readonly' => $readonly,
                'autocomplete' => $autocomplete,
                'aria-invalid' => $hasError() ? 'true' : null,
                'aria-describedby' => $describedBy !== '' ? $describedBy : null,
                'class' => $inputClasses() . ($icon && $iconPosition === 'left' ? ' pl-10' : '') . ($icon && $iconPosition === 'right' ? ' pr-10' : ''),
            ]) }}
        />

        @if($icon && $iconPosition === 'right')
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                <x-ui::icon :name="$icon" size="sm" class="text-gray-400" aria-hidden="true" />
            </div>
        @endif
    </div>

    @if($hasError())
        <p @if($id) id="{{ $id }}-error" @endif class="mt-1 text-sm text-red-600 dark:text-red-400" role="alert">{{ $errorMessage() }}</p>
    @elseif($hint)
        <p @if($id) id="{{ $id }}-hint" @endif class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ $hint }}</p>
    @endif
</div>
