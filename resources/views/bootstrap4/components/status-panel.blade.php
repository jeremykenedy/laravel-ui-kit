@php
    $iconColor = match($variant) {
        'success' => 'text-success',
        'danger', 'error' => 'text-danger',
        'warning' => 'text-warning',
        'info' => 'text-info',
        default => 'text-secondary',
    };
@endphp
<div {{ $attributes->merge(['class' => 'card border p-5 ' . ($centered ? 'text-center' : '')]) }} role="status" aria-live="polite">
    @if($icon)
        <div class="mb-3 {{ $iconColor }}">
            <x-ui::icon :name="$icon" size="xl" aria-hidden="true" />
        </div>
    @endif
    @if($title) <h5 class="mb-2">{{ $title }}</h5> @endif
    @if($message) <p class="text-muted mb-3">{{ $message }}</p> @endif
    {{ $slot }}
</div>
