<span {{ $attributes->merge(['class' => 'badge bg-' . $variant . ($rounded ? ' rounded-pill' : '') . ($size === 'lg' ? ' fs-6' : '')]) }}>
    @if($dot)
        <span class="d-inline-block rounded-circle me-1" style="width:6px;height:6px;background:currentColor"></span>
    @endif
    @if($icon)
        <x-ui::icon :name="$icon" size="xs" class="me-1" />
    @endif
    {{ $slot }}
</span>
