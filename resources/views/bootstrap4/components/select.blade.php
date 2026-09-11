<div class="form-group">
    @if($label)
        <label for="{{ $id }}">
            {{ $label }}
            @if($required) <span class="text-danger" aria-hidden="true">*</span> @endif
        </label>
    @endif
    <select
        name="{{ $name }}{{ $multiple ? '[]' : '' }}"
        id="{{ $id }}"
        class="form-control {{ $hasError() ? 'is-invalid' : '' }}"
        @required($required)
        @disabled($disabled)
        @if($multiple) multiple @endif
        @if($hasError()) aria-invalid="true" aria-describedby="{{ $id }}-feedback" @endif
        {{ $attributes }}
    >
        @if($placeholder)
            <option value="" disabled @if(!$selected) selected @endif>{{ $placeholder }}</option>
        @endif
        @foreach($options as $optionValue => $optionLabel)
            <option value="{{ $optionValue }}" @selected(old($name, $selected) == $optionValue)>{{ $optionLabel }}</option>
        @endforeach
        {{ $slot }}
    </select>
    @if($hasError())
        <div class="invalid-feedback" id="{{ $id }}-feedback">{{ $errorMessage() }}</div>
    @endif
</div>
