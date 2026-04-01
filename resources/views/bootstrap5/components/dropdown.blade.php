<div class="dropdown" {{ $attributes }}>
    @if(isset($trigger))
        <div data-bs-toggle="dropdown" aria-expanded="false">{{ $trigger }}</div>
    @else
        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">{{ $label ?? 'Options' }}</button>
    @endif
    <ul class="dropdown-menu {{ $align === 'right' ? 'dropdown-menu-end' : '' }}">
        {{ $slot }}
    </ul>
</div>
