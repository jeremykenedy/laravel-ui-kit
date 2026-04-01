<div class="form-check form-switch">
    <input type="hidden" name="{{ $name }}" value="0" />
    <input class="form-check-input" type="checkbox" name="{{ $name }}" id="{{ $id }}" value="1" @checked($checked) @disabled($disabled) role="switch" {{ $attributes }}>
    @if($label)
        <label class="form-check-label" for="{{ $id }}">{{ $label }}</label>
    @endif
    @if($description)
        <div class="form-text">{{ $description }}</div>
    @endif
</div>
