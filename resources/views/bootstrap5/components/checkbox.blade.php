<div class="form-check">
    <input type="checkbox" name="{{ $name }}" id="{{ $id }}" value="{{ $value }}" class="form-check-input {{ ($error || ($name && session('errors')?->has($name))) ? 'is-invalid' : '' }}" @checked($checked || old($name)) @disabled($disabled) @required($required) {{ $attributes }}>
    @if($label)
        <label class="form-check-label" for="{{ $id }}">{{ $label }}</label>
    @endif
    @if($description)
        <div class="form-text">{{ $description }}</div>
    @endif
    @if($error || ($name && session('errors')?->has($name)))
        <div class="invalid-feedback">{{ $error ?? session('errors')->first($name) }}</div>
    @endif
</div>
