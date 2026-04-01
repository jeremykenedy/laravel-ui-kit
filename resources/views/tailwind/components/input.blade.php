<div>
    @if($label)
        <label @if($id) for="{{ $id }}" @endif class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            {{ $label }}
            @if($required)
                <span class="text-red-500">*</span>
            @endif
        </label>
    @endif

    <div class="relative">
        @if($icon && $iconPosition === 'left')
            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                <x-ui::icon :name="$icon" size="sm" class="text-gray-400" />
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
                'class' => $inputClasses() . ($icon && $iconPosition === 'left' ? ' pl-10' : '') . ($icon && $iconPosition === 'right' ? ' pr-10' : ''),
            ]) }}
        />

        @if($icon && $iconPosition === 'right')
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                <x-ui::icon :name="$icon" size="sm" class="text-gray-400" />
            </div>
        @endif
    </div>

    @if($hasError())
        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $errorMessage() }}</p>
    @elseif($hint)
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ $hint }}</p>
    @endif
</div>
