<div class="mb-3">
    @if($label)
        <label @if($id) for="{{ $id }}" @endif class="form-label">
            {{ $label }}
            @if($required) <span class="text-danger">*</span> @endif
        </label>
    @endif
    @if($icon)
        <div class="input-group">
            @if($iconPosition === 'left')
                <span class="input-group-text"><x-ui::icon :name="$icon" size="sm" /></span>
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
                    'class' => 'form-control' . ($hasError() ? ' is-invalid' : ''),
                ]) }}
            />
            @if($iconPosition === 'right')
                <span class="input-group-text"><x-ui::icon :name="$icon" size="sm" /></span>
            @endif
            @if($hasError())
                <div class="invalid-feedback">{{ $errorMessage() }}</div>
            @endif
        </div>
    @else
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
                'class' => 'form-control' . ($hasError() ? ' is-invalid' : ''),
            ]) }}
        />
        @if($hasError())
            <div class="invalid-feedback">{{ $errorMessage() }}</div>
        @endif
    @endif
    @if($hint && !$hasError())
        <div class="form-text">{{ $hint }}</div>
    @endif
</div>
