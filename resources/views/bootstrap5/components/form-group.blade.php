<div class="{{ $inline ? 'd-flex align-items-center gap-3' : 'mb-3' }}">
    @if($label)
        <label @if($name) for="{{ $name }}" @endif class="form-label">
            {{ $label }}
            @if($required) <span class="text-danger">*</span> @endif
        </label>
    @endif
    <div class="{{ $inline ? 'flex-grow-1' : '' }}">
        {{ $slot }}
    </div>
    @if($hasError())
        <div class="invalid-feedback d-block">{{ $errorMessage() }}</div>
    @elseif($hint)
        <div class="form-text">{{ $hint }}</div>
    @endif
</div>
