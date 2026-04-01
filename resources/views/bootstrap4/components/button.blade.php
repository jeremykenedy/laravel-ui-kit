@php
    $tag = $href ? 'a' : 'button';
    $btnClass = 'btn' . ($outline ? ' btn-outline-' : ' btn-') . $variant;
    $sizeMap = ['xs' => 'btn-sm', 'sm' => 'btn-sm', 'lg' => 'btn-lg', 'xl' => 'btn-lg'];
    $btnSize = $sizeMap[$size] ?? '';
@endphp
<{{ $tag }}
    {{ $attributes->merge([
        'type' => $tag === 'button' ? $type : null,
        'href' => $href,
        'disabled' => $disabled || $loading,
        'form' => $form,
        'class' => trim($btnClass . ' ' . $btnSize . ($block ? ' btn-block' : '') . ($disabled || $loading ? ' disabled' : '')),
    ]) }}
    @if($confirm)
        data-toggle="modal"
        data-target="#{{ $confirmAction ?? 'confirmModal' }}"
        data-title="{{ $confirmTitle ?? config('ui-kit.confirm.default_title') }}"
        data-message="{{ $confirm }}"
    @endif
>
    @if($loading)
        <span class="spinner-border spinner-border-sm mr-1" role="status" aria-hidden="true"></span>
    @elseif($icon && $iconPosition === 'left')
        <x-ui::icon :name="$icon" size="sm" class="mr-1" />
    @endif
    {{ $slot }}
    @if($icon && $iconPosition === 'right' && !$loading)
        <x-ui::icon :name="$icon" size="sm" class="ml-1" />
    @endif
</{{ $tag }}>
