@php $currentValue = $value ?? old($name, ''); @endphp
<div class="mb-3" x-data="{ count: {{ mb_strlen((string) $currentValue) }} }">
    @if($label)
        <label for="{{ $id }}" class="form-label">
            {{ $label }}
            @if($required) <span class="text-danger" aria-hidden="true">*</span> @endif
        </label>
    @endif
    <textarea
        name="{{ $name }}"
        id="{{ $id }}"
        rows="{{ $rows }}"
        placeholder="{{ $placeholder }}"
        class="form-control {{ $hasError() ? 'is-invalid' : '' }}"
        @required($required)
        @disabled($disabled)
        @if($maxlength) maxlength="{{ $maxlength }}" @endif
        @if($hasError()) aria-invalid="true" aria-describedby="{{ $id }}-error" @endif
        @if($showCount && $maxlength) x-on:input="count = $event.target.value.length" @endif
        {{ $attributes }}
    >{{ $currentValue }}</textarea>
    @if($hasError())
        <div class="invalid-feedback" id="{{ $id }}-error">{{ $errorMessage() }}</div>
    @endif
    @if($showCount && $maxlength)
        <div class="form-text text-end" aria-live="polite"><span x-text="count"></span>/{{ $maxlength }}</div>
    @endif
</div>
