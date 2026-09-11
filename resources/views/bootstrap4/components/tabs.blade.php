@php $firstTab = $activeTab ?? (count($tabs) > 0 ? array_key_first($tabs) : null); @endphp
<div {{ $attributes }}>
    <ul class="nav {{ $variant === 'pills' ? 'nav-pills' : 'nav-tabs' }} {{ $vertical ? 'flex-column' : '' }}" id="{{ $id }}" role="tablist">
        @foreach($tabs as $key => $label)
            <li class="nav-item" role="presentation">
                <a
                    class="nav-link {{ $firstTab === $key ? 'active' : '' }}"
                    id="{{ $id }}-{{ $key }}-tab"
                    data-toggle="tab"
                    href="#{{ $id }}-{{ $key }}"
                    role="tab"
                    aria-controls="{{ $id }}-{{ $key }}"
                    aria-selected="{{ $firstTab === $key ? 'true' : 'false' }}"
                >{{ $label }}</a>
            </li>
        @endforeach
    </ul>
    <div class="tab-content mt-3" id="{{ $id }}Content">
        {{ $slot }}
    </div>
</div>
