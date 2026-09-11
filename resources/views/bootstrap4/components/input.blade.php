<div class="form-group">
    @if($label)
        <label @if($id) for="{{ $id }}" @endif>
            {{ $label }}
            @if($required) <span class="text-danger" aria-hidden="true">*</span> @endif
        </label>
    @endif
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
    @if($icon)
        <div class="input-group">
            @if($iconPosition === 'left')
                <div class="input-group-prepend"><span class="input-group-text"><x-ui::icon :name="$icon" size="sm" aria-hidden="true" /></span></div>
            @endif
            <input {{ $attributes->merge($inputAttributes) }} />
            @if($iconPosition === 'right')
                <div class="input-group-append"><span class="input-group-text"><x-ui::icon :name="$icon" size="sm" aria-hidden="true" /></span></div>
            @endif
            @if($hasError()) <div class="invalid-feedback">{{ $errorMessage() }}</div> @endif
        </div>
    @else
        <input {{ $attributes->merge($inputAttributes) }} />
        @if($hasError()) <div class="invalid-feedback">{{ $errorMessage() }}</div> @endif
    @endif
    @if($hint && !$hasError())
        <small class="form-text text-muted" @if($id) id="{{ $id }}-hint" @endif>{{ $hint }}</small>
    @endif
</div>
