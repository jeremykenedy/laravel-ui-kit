<div {{ $attributes->merge(['class' => 'card' . ($hoverable ? ' shadow-sm' : '') . ($bordered ? '' : ' border-0')]) }}>
    @if($title || isset($header))
        <div class="card-header">
            @if(isset($header))
                {{ $header }}
            @else
                <h5 class="card-title mb-0">{{ $title }}</h5>
                @if($subtitle)
                    <p class="card-text text-muted small mt-1 mb-0">{{ $subtitle }}</p>
                @endif
            @endif
        </div>
    @endif
    <div class="card-body">
        {{ $slot }}
    </div>
    @if($footer || isset($footerSlot))
        <div class="card-footer">
            {{ $footerSlot ?? $footer }}
        </div>
    @endif
</div>
