<div class="form-group {{ $inline ? 'form-row align-items-center' : '' }}">
    @if($label)
        <label @if($name) for="{{ $name }}" @endif class="{{ $inline ? 'col-auto' : '' }}">{{ $label }} @if($required) <span class="text-danger">*</span> @endif</label>
    @endif
    <div class="{{ $inline ? 'col' : '' }}">{{ $slot }}</div>
    @if($hasError()) <div class="invalid-feedback d-block">{{ $errorMessage() }}</div>
    @elseif($hint) <small class="form-text text-muted">{{ $hint }}</small> @endif
</div>
