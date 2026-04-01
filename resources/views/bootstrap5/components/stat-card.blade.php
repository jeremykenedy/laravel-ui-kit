@php $tag = $href ? 'a' : 'div'; @endphp
<{{ $tag }} {{ $attributes->merge(['href' => $href, 'class' => 'card h-100 ' . ($href ? 'text-decoration-none' : '')]) }}>
    <div class="card-body text-center">
        <h2 class="display-6 fw-bold {{ $variantColor() }}">{{ $value }}</h2>
        <p class="text-muted small mt-1">{{ $label }}</p>
        @if($change)
            <p class="small mt-2 {{ $changeUp ? 'text-success' : 'text-danger' }}">
                {{ $changeUp ? '↑' : '↓' }} {{ $change }}
            </p>
        @endif
    </div>
</{{ $tag }}>
