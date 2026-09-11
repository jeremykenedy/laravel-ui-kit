@php
    $tag = $href ? 'a' : 'button';
    $btnClass = 'btn' . ($outline ? ' btn-outline-' : ' btn-') . (($variant === 'error') ? 'danger' : $variant);
    $sizeMap = ['xs' => 'btn-sm', 'sm' => 'btn-sm', 'lg' => 'btn-lg', 'xl' => 'btn-lg'];
    $btnSize = $sizeMap[$size] ?? '';
@endphp
<{{ $tag }}
    {{ $attributes->merge([
        'type' => $tag === 'button' ? $type : null,
        'href' => ($disabled || $loading) ? null : $href,
        'disabled' => $tag === 'button' ? ($disabled || $loading) : null,
        'form' => $form,
        'class' => trim($btnClass . ' ' . $btnSize . ($block ? ' btn-block' : '') . ($disabled || $loading ? ' disabled' : '')),
        'title' => $tooltip,
        'aria-label' => $iconOnly ? $tooltip : null,
        'aria-busy' => $loading ? 'true' : null,
        'aria-disabled' => ($disabled || $loading) ? 'true' : null,
        'tabindex' => ($tag === 'a' && ($disabled || $loading)) ? '-1' : null,
    ]) }}
    @if($confirm && !$disabled && !$loading)
        data-toggle="modal"
        data-target="#{{ $confirmTargetId() }}"
        data-confirm-title="{{ $confirmTitle ?? config('ui-kit.confirm.default_title') }}"
        data-confirm-message="{{ $confirm }}"
        @if($confirmAction) data-confirm-form="{{ $confirmAction }}" @endif
    @endif
>
    @if($loading)
        <span class="spinner-border spinner-border-sm mr-1" role="status" aria-hidden="true"></span>
    @elseif($icon && $iconPosition === 'left')
        <x-ui::icon :name="$icon" size="sm" @class(['mr-1' => !$iconOnly]) aria-hidden="true" />
    @endif
    @unless($iconOnly)
        {{ $slot }}
    @endunless
    @if($icon && $iconPosition === 'right' && !$loading && !$iconOnly)
        <x-ui::icon :name="$icon" size="sm" class="ml-1" aria-hidden="true" />
    @endif
</{{ $tag }}>
