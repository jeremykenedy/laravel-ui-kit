@props([])
@php $tag = $href ? 'a' : 'button'; @endphp
<{{ $tag }}
    {{ $attributes->merge([
        'type' => $tag === 'button' ? $type : null,
        'href' => $href,
        'disabled' => $disabled || $loading,
        'form' => $form,
        'class' => $baseClasses() . ' ' . $sizeClasses() . ' ' . $variantClasses(),
        'title' => $tooltip,
        'aria-label' => $iconOnly ? $tooltip : null,
    ]) }}
    @if($confirm)
        x-data
        x-on:click.prevent="$dispatch('open-confirm', {
            title: '{{ $confirmTitle ?? config('ui-kit.confirm.default_title') }}',
            message: '{{ $confirm }}',
            variant: '{{ $variant }}',
            formId: '{{ $confirmAction }}'
        })"
    @endif
>
    @if($loading)
        <svg class="animate-spin -ml-1 mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
    @elseif($icon && $iconPosition === 'left')
        <x-ui::icon :name="$icon" size="sm" @class(['-ml-0.5 mr-1.5' => !$iconOnly]) />
    @endif

    @unless($iconOnly)
        {{ $slot }}
    @endunless

    @if($icon && $iconPosition === 'right' && !$loading && !$iconOnly)
        <x-ui::icon :name="$icon" size="sm" class="ml-1.5 -mr-0.5" />
    @endif
</{{ $tag }}>
