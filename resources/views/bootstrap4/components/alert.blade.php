@php $bsVariant = ($variant === 'error') ? 'danger' : $variant; @endphp
<div {{ $attributes->merge(['class' => 'alert alert-' . $bsVariant . ($dismissible ? ' alert-dismissible fade show' : '')]) }} role="alert" aria-live="polite">
    @if($icon)
        <x-ui::icon :name="$icon" size="md" class="mr-2" aria-hidden="true" />
    @endif
    @if($title)
        <strong>{{ $title }}</strong>
    @endif
    {{ $slot }}
    @if($dismissible)
        <button type="button" class="close" data-dismiss="alert" aria-label="{{ __('ui-kit::ui-kit.alert.dismiss') }}">
            <span aria-hidden="true">&times;</span>
        </button>
    @endif
</div>
