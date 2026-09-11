@php $hasError = $error || ($name && session('errors')?->has($name)); @endphp
<div class="form-check">
    <input
        type="checkbox"
        name="{{ $name }}"
        id="{{ $id }}"
        value="{{ $value }}"
        class="form-check-input {{ $hasError ? 'is-invalid' : '' }}"
        @checked($checked || old($name))
        @disabled($disabled)
        @required($required)
        @if($hasError) aria-invalid="true" @endif
        @php
            $describedBy = collect([
                $description ? $id . '-description' : null,
                $hasError ? $id . '-error' : null,
            ])->filter()->implode(' ');
        @endphp
        @if($describedBy) aria-describedby="{{ $describedBy }}" @endif
        {{ $attributes }}
    >
    @if($label)
        <label class="form-check-label" for="{{ $id }}">
            {{ $label }}
            @if($required) <span class="text-danger" aria-hidden="true">*</span> @endif
        </label>
    @endif
    @if($description)
        <div class="form-text" id="{{ $id }}-description">{{ $description }}</div>
    @endif
    @if($hasError)
        <div class="invalid-feedback" id="{{ $id }}-error">{{ $error ?? session('errors')->first($name) }}</div>
    @endif
</div>
