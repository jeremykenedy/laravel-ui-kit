@php $dropdownId = $id ?? 'ui-dropdown-' . substr(md5($label ?? uniqid('', true)), 0, 8); @endphp
<div {{ $attributes->merge(['class' => 'dropdown']) }}>
    @if(isset($trigger))
        <button type="button" class="btn btn-link p-0 border-0 text-reset text-decoration-none" data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true" aria-controls="{{ $dropdownId }}">{{ $trigger }}</button>
    @else
        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true" aria-controls="{{ $dropdownId }}">
            {{ $label ?? __('ui-kit::ui-kit.dropdown.toggle') }}
        </button>
    @endif
    <ul class="dropdown-menu {{ $align === 'right' ? 'dropdown-menu-end' : '' }}" id="{{ $dropdownId }}">
        {{ $slot }}
    </ul>
</div>
