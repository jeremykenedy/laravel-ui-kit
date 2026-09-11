<div {{ $attributes->merge(['class' => $inline ? 'd-flex align-items-center gap-3' : 'mb-3']) }}>
    @if($label)
        <label @if($name) for="{{ $name }}" @endif class="form-label">
            {{ $label }}
            @if($required) <span class="text-danger" aria-hidden="true">*</span> @endif
        </label>
    @endif
    <div class="{{ $inline ? 'flex-grow-1' : '' }}" @if($name) aria-describedby="{{ $name }}-feedback" @endif>
        {{ $slot }}
    </div>
    @if($hasError())
        <div class="invalid-feedback d-block" @if($name) id="{{ $name }}-feedback" @endif role="alert">{{ $errorMessage() }}</div>
    @elseif($hint)
        <div class="form-text" @if($name) id="{{ $name }}-feedback" @endif>{{ $hint }}</div>
    @endif
</div>
