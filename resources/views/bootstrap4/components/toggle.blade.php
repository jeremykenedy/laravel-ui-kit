<div class="custom-control custom-switch">
    <input type="hidden" name="{{ $name }}" value="0" />
    <input type="checkbox" class="custom-control-input" name="{{ $name }}" id="{{ $id }}" value="1" @checked($checked) @disabled($disabled) {{ $attributes }}>
    <label class="custom-control-label" for="{{ $id }}">{{ $label }}</label>
    @if($description) <small class="form-text text-muted">{{ $description }}</small> @endif
</div>
