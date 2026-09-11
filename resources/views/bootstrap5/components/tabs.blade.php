@php $firstTab = $activeTab ?? (count($tabs) > 0 ? array_key_first($tabs) : null); @endphp
<div {{ $attributes }}>
    <ul class="nav {{ $variant === 'pills' ? 'nav-pills' : 'nav-tabs' }} {{ $vertical ? 'flex-column' : '' }}" id="{{ $id }}" role="tablist" aria-orientation="{{ $vertical ? 'vertical' : 'horizontal' }}">
        @foreach($tabs as $key => $label)
            <li class="nav-item" role="presentation">
                <button
                    class="nav-link {{ $firstTab === $key ? 'active' : '' }}"
                    id="{{ $id }}-{{ $key }}-tab"
                    data-bs-toggle="tab"
                    data-bs-target="#{{ $id }}-{{ $key }}"
                    type="button"
                    role="tab"
                    aria-controls="{{ $id }}-{{ $key }}"
                    aria-selected="{{ $firstTab === $key ? 'true' : 'false' }}"
                    tabindex="{{ $firstTab === $key ? '0' : '-1' }}"
                >
                    {{ $label }}
                </button>
            </li>
        @endforeach
    </ul>
    <div class="tab-content mt-3" id="{{ $id }}Content">
        {{ $slot }}
    </div>
</div>
