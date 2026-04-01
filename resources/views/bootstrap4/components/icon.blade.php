@php $iconSet = $iconSet(); @endphp
@if($iconSet === 'fontawesome')
    <i {{ $attributes->merge(['class' => $resolvedClass() . ' ' . ($class ?? '')]) }}></i>
@else
    <svg {{ $attributes->merge(['class' => $sizeClasses() . ' ' . ($class ?? '')]) }} fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><use href="#icon-{{ $name }}" /></svg>
@endif
