@php $tag = $href ? 'a' : 'div'; @endphp
<{{ $tag }} {{ $attributes->merge(['href' => $href, 'class' => 'card h-100 ' . ($href ? 'text-decoration-none' : '')]) }}>
    <div class="card-body text-center">
        <h2 class="display-4 font-weight-bold {{ $variantColor() }}">{{ $value }}</h2>
        <p class="text-muted small mt-1">{{ $label }}</p>
    </div>
</{{ $tag }}>
