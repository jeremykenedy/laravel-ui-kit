<div class="dropdown {{ $attributes->get('class', '') }}">
    @if(isset($trigger))
        <div data-toggle="dropdown" aria-expanded="false">{{ $trigger }}</div>
    @else
        <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">{{ $label ?? 'Options' }}</button>
    @endif
    <div class="dropdown-menu {{ $align === 'right' ? 'dropdown-menu-right' : '' }}">
        {{ $slot }}
    </div>
</div>
