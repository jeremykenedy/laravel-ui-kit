<div class="form-check form-switch">
    <input type="hidden" name="{{ $name }}" value="0" />
    <input
        class="form-check-input"
        type="checkbox"
        name="{{ $name }}"
        id="{{ $id }}"
        value="1"
        role="switch"
        @checked($checked)
        @disabled($disabled)
        @if($description) aria-describedby="{{ $id }}-description" @endif
        {{ $attributes }}
    >
    @if($label)
        <label class="form-check-label" for="{{ $id }}">{{ $label }}</label>
    @endif
    @if($description)
        <div class="form-text" id="{{ $id }}-description">{{ $description }}</div>
    @endif
</div>
