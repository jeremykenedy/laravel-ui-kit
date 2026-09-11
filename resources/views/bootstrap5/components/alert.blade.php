@php $bsVariant = ($variant === 'error') ? 'danger' : $variant; @endphp
<div {{ $attributes->merge(['class' => 'alert alert-' . $bsVariant . ($dismissible ? ' alert-dismissible fade show' : '')]) }} role="alert" aria-live="polite">
    @if($icon)
        <x-ui::icon :name="$icon" size="md" class="me-2" aria-hidden="true" />
    @endif
    @if($title)
        <strong>{{ $title }}</strong>
    @endif
    {{ $slot }}
    @if($dismissible)
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="{{ __('ui-kit::ui-kit.alert.dismiss') }}"></button>
    @endif
</div>
