@php $dropdownId = $id ?? 'ui-dropdown-' . substr(md5($label ?? uniqid('', true)), 0, 8); @endphp
<div {{ $attributes->merge(['class' => 'dropdown']) }}>
    @if(isset($trigger))
        <div data-toggle="dropdown" aria-expanded="false" aria-haspopup="true" aria-controls="{{ $dropdownId }}" role="button" tabindex="0">{{ $trigger }}</div>
    @else
        <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false" aria-haspopup="true" aria-controls="{{ $dropdownId }}">
            {{ $label ?? __('ui-kit::ui-kit.dropdown.toggle') }}
        </button>
    @endif
    <div class="dropdown-menu {{ $align === 'right' ? 'dropdown-menu-right' : '' }}" id="{{ $dropdownId }}">
        {{ $slot }}
    </div>
</div>
