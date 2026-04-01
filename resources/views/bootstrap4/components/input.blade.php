<div class="form-group">
    @if($label) <label @if($id) for="{{ $id }}" @endif>{{ $label }} @if($required) <span class="text-danger">*</span> @endif</label> @endif
    @if($icon)
        <div class="input-group">
            @if($iconPosition === 'left') <div class="input-group-prepend"><span class="input-group-text"><x-ui::icon :name="$icon" size="sm" /></span></div> @endif
            <input {{ $attributes->merge(['type' => $type, 'name' => $name, 'id' => $id, 'value' => $value ?? old($name), 'placeholder' => $placeholder, 'required' => $required, 'disabled' => $disabled, 'readonly' => $readonly, 'autocomplete' => $autocomplete, 'class' => 'form-control' . ($hasError() ? ' is-invalid' : '')]) }} />
            @if($iconPosition === 'right') <div class="input-group-append"><span class="input-group-text"><x-ui::icon :name="$icon" size="sm" /></span></div> @endif
            @if($hasError()) <div class="invalid-feedback">{{ $errorMessage() }}</div> @endif
        </div>
    @else
        <input {{ $attributes->merge(['type' => $type, 'name' => $name, 'id' => $id, 'value' => $value ?? old($name), 'placeholder' => $placeholder, 'required' => $required, 'disabled' => $disabled, 'readonly' => $readonly, 'autocomplete' => $autocomplete, 'class' => 'form-control' . ($hasError() ? ' is-invalid' : '')]) }} />
        @if($hasError()) <div class="invalid-feedback">{{ $errorMessage() }}</div> @endif
    @endif
    @if($hint && !$hasError()) <small class="form-text text-muted">{{ $hint }}</small> @endif
</div>
