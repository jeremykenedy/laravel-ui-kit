@props(['items' => []])

<nav aria-label="breadcrumb" {{ $attributes->merge(['class' => 'mb-3']) }}>
    <ol class="breadcrumb mb-0">
        @if($showHome)
            <li class="breadcrumb-item">
                <a href="{{ $resolvedHomeUrl() }}" aria-label="{{ $resolvedHomeLabel() }}">
                    <x-ui::icon name="home" size="sm" aria-hidden="true" />
                </a>
            </li>
        @endif
        @foreach($items as $item)
            @if(isset($item['url']) && !$loop->last)
                <li class="breadcrumb-item"><a href="{{ $item['url'] }}">{{ $item['label'] }}</a></li>
            @else
                <li class="breadcrumb-item active" aria-current="page">{{ $item['label'] }}</li>
            @endif
        @endforeach
    </ol>
</nav>
