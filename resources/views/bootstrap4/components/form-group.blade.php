<div class="form-group {{ $inline ? 'form-row align-items-center' : '' }}">
    @if($label)
        <label @if($name) for="{{ $name }}" @endif class="{{ $inline ? 'col-auto' : '' }}">
            {{ $label }}
            @if($required) <span class="text-danger" aria-hidden="true">*</span> @endif
        </label>
    @endif
    <div class="{{ $inline ? 'col' : '' }}" @if($name) aria-describedby="{{ $name }}-feedback" @endif>
        {{ $slot }}
    </div>
    @if($hasError())
        <div class="invalid-feedback d-block" @if($name) id="{{ $name }}-feedback" @endif role="alert">{{ $errorMessage() }}</div>
    @elseif($hint)
        <small class="form-text text-muted" @if($name) id="{{ $name }}-feedback" @endif>{{ $hint }}</small>
    @endif
</div>
