@if($usesIconFont())
    <i {{ $attributes->merge(['class' => trim($resolvedClass() . ' ' . ($class ?? '')), 'aria-hidden' => $attributes->has('aria-label') ? 'false' : 'true']) }}></i>
@else
    <svg
        {{ $attributes->merge(['class' => trim('align-text-bottom ' . ($class ?? ''))]) }}
        width="{{ $sizePixels() }}"
        height="{{ $sizePixels() }}"
        fill="none"
        viewBox="0 0 24 24"
        stroke="currentColor"
        stroke-width="1.5"
        role="img"
        aria-hidden="{{ $attributes->has('aria-label') ? 'false' : 'true' }}"
        focusable="false"
    >{!! $path() !!}</svg>
@endif
