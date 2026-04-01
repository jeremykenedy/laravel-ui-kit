<div {{ $attributes->merge(['class' => 'card border p-5 ' . ($centered ? 'text-center' : '')]) }}>
    @if($icon)
        <div class="mb-3 {{ $variantClasses() }}">
            <x-ui::icon :name="$icon" size="xl" class="mx-auto" />
        </div>
    @endif
    @if($title)
        <h5 class="mb-2">{{ $title }}</h5>
    @endif
    @if($message)
        <p class="text-muted mb-3">{{ $message }}</p>
    @endif
    {{ $slot }}
</div>
