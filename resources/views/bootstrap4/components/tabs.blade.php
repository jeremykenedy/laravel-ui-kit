<div {{ $attributes }}>
    <ul class="nav {{ $variant === 'pills' ? 'nav-pills' : 'nav-tabs' }} {{ $vertical ? 'flex-column' : '' }}" id="{{ $id }}" role="tablist">
        @foreach($tabs as $key => $label)
            <li class="nav-item">
                <a class="nav-link {{ ($activeTab ?? array_key_first($tabs)) === $key ? 'active' : '' }}" id="{{ $id }}-{{ $key }}-tab" data-toggle="tab" href="#{{ $id }}-{{ $key }}" role="tab">{{ $label }}</a>
            </li>
        @endforeach
    </ul>
    <div class="tab-content mt-3" id="{{ $id }}Content">
        {{ $slot }}
    </div>
</div>
