@php $bsVariant = ($variant === 'error') ? 'danger' : $variant; @endphp
<div {{ $attributes->merge(['class' => 'alert alert-' . $bsVariant . ($dismissible ? ' alert-dismissible fade show' : '')]) }} role="alert">
    @if($icon) <x-ui::icon :name="$icon" size="md" class="mr-2" /> @endif
    @if($title) <strong>{{ $title }}</strong> @endif
    {{ $slot }}
    @if($dismissible)
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    @endif
</div>
