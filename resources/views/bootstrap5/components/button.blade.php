@php
    $tag = $href ? 'a' : 'button';
    $btnClass = 'btn' . ($outline ? ' btn-outline-' : ' btn-') . (($variant === 'error') ? 'danger' : $variant);
    $sizeMap = ['xs' => 'btn-sm', 'sm' => 'btn-sm', 'lg' => 'btn-lg', 'xl' => 'btn-lg'];
    $btnSize = $sizeMap[$size] ?? '';
@endphp
<{{ $tag }}
    {{ $attributes->merge([
        'type' => $tag === 'button' ? $type : null,
        'href' => $href,
        'disabled' => $tag === 'button' ? ($disabled || $loading) : null,
        'form' => $form,
        'class' => trim($btnClass . ' ' . $btnSize . ($block ? ' w-100' : '') . ($disabled || $loading ? ' disabled' : '')),
        'title' => $tooltip,
        'aria-label' => $iconOnly ? $tooltip : null,
        'aria-busy' => $loading ? 'true' : null,
        'aria-disabled' => ($disabled || $loading) ? 'true' : null,
        'tabindex' => ($tag === 'a' && ($disabled || $loading)) ? '-1' : null,
    ]) }}
    @if($confirm)
        data-bs-toggle="modal"
        data-bs-target="#{{ $confirmTargetId() }}"
        data-confirm-title="{{ $confirmTitle ?? config('ui-kit.confirm.default_title') }}"
        data-confirm-message="{{ $confirm }}"
        data-confirm-variant="{{ $variant }}"
        @if($confirmAction) data-confirm-form="{{ $confirmAction }}" @endif
    @endif
>
    @if($loading)
        <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>
    @elseif($icon && $iconPosition === 'left')
        <x-ui::icon :name="$icon" size="sm" @class(['me-1' => !$iconOnly]) aria-hidden="true" />
    @endif
    @unless($iconOnly)
        {{ $slot }}
    @endunless
    @if($icon && $iconPosition === 'right' && !$loading && !$iconOnly)
        <x-ui::icon :name="$icon" size="sm" class="ms-1" aria-hidden="true" />
    @endif
</{{ $tag }}>
