@php
    $inputAttributes = [
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
        'aria-describedby' => ($hint && !$hasError() && $id) ? $id . '-hint' : null,
        'class' => 'form-control' . ($hasError() ? ' is-invalid' : ''),
    ];
@endphp
<div class="mb-3">
    @if($label)
        <label @if($id) for="{{ $id }}" @endif class="form-label">
            {{ $label }}
            @if($required) <span class="text-danger" aria-hidden="true">*</span> @endif
        </label>
    @endif
    @if($icon)
        <div class="input-group">
            @if($iconPosition === 'left')
                <span class="input-group-text"><x-ui::icon :name="$icon" size="sm" aria-hidden="true" /></span>
            @endif
            <input {{ $attributes->merge($inputAttributes) }} />
            @if($iconPosition === 'right')
                <span class="input-group-text"><x-ui::icon :name="$icon" size="sm" aria-hidden="true" /></span>
            @endif
            @if($hasError())
                <div class="invalid-feedback">{{ $errorMessage() }}</div>
            @endif
        </div>
    @else
        <input {{ $attributes->merge($inputAttributes) }} />
        @if($hasError())
            <div class="invalid-feedback">{{ $errorMessage() }}</div>
        @endif
    @endif
    @if($hint && !$hasError())
        <div class="form-text" @if($id) id="{{ $id }}-hint" @endif>{{ $hint }}</div>
    @endif
</div>
