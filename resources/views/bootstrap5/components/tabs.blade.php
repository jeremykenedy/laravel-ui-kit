<div {{ $attributes }}>
    <ul class="nav {{ $variant === 'pills' ? 'nav-pills' : 'nav-tabs' }} {{ $vertical ? 'flex-column' : '' }}" id="{{ $id }}" role="tablist">
        @foreach($tabs as $key => $label)
            <li class="nav-item" role="presentation">
                <button class="nav-link {{ ($activeTab ?? array_key_first($tabs)) === $key ? 'active' : '' }}" id="{{ $id }}-{{ $key }}-tab" data-bs-toggle="tab" data-bs-target="#{{ $id }}-{{ $key }}" type="button" role="tab" aria-controls="{{ $id }}-{{ $key }}" aria-selected="{{ ($activeTab ?? array_key_first($tabs)) === $key ? 'true' : 'false' }}">
                    {{ $label }}
                </button>
            </li>
        @endforeach
    </ul>
    <div class="tab-content mt-3" id="{{ $id }}Content">
        {{ $slot }}
    </div>
</div>
