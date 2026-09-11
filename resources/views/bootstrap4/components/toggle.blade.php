<div class="custom-control custom-switch">
    <input type="hidden" name="{{ $name }}" value="0" />
    <input
        type="checkbox"
        class="custom-control-input"
        name="{{ $name }}"
        id="{{ $id }}"
        value="1"
        role="switch"
        @checked($checked)
        @disabled($disabled)
        @if($description) aria-describedby="{{ $id }}-description" @endif
        {{ $attributes }}
    >
    <label class="custom-control-label" for="{{ $id }}">{{ $label }}</label>
    @if($description)
        <small class="form-text text-muted" id="{{ $id }}-description">{{ $description }}</small>
    @endif
</div>
