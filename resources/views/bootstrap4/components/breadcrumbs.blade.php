@props(['items' => []])

<nav aria-label="breadcrumb" {{ $attributes->merge(['class' => 'mb-3']) }}>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ url('/home') }}"><i class="fa fa-home"></i></a>
        </li>
        @foreach($items as $item)
            @if(isset($item['url']) && !$loop->last)
                <li class="breadcrumb-item"><a href="{{ $item['url'] }}">{{ $item['label'] }}</a></li>
            @else
                <li class="breadcrumb-item active" aria-current="page">{{ $item['label'] }}</li>
            @endif
        @endforeach
    </ol>
</nav>
