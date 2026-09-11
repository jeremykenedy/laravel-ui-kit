@php
    $tag = $href ? 'a' : 'div';
    $valueColor = match($variant) {
        'primary' => 'text-primary',
        'success' => 'text-success',
        'warning' => 'text-warning',
        'danger', 'error' => 'text-danger',
        'info' => 'text-info',
        default => '',
    };
@endphp
<{{ $tag }} {{ $attributes->merge(['href' => $href, 'class' => 'card h-100 ' . ($href ? 'text-decoration-none' : '')]) }}>
    <div class="card-body">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h2 class="display-4 font-weight-bold mb-0 {{ $valueColor }}">{{ $value }}</h2>
                <p class="text-muted small mt-1 mb-0">{{ $label }}</p>
                @if($change)
                    <p class="small mt-2 mb-0 {{ $changeUp ? 'text-success' : 'text-danger' }}">
                        <span aria-hidden="true">{{ $changeUp ? '↑' : '↓' }}</span> {{ $change }}
                    </p>
                @endif
            </div>
            @if($icon)
                <div class="text-muted">
                    <x-ui::icon :name="$icon" size="xl" aria-hidden="true" />
                </div>
            @endif
        </div>
    </div>
</{{ $tag }}>
