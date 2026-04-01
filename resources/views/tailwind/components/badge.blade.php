<span {{ $attributes->merge(['class' => 'inline-flex items-center font-medium ' . $sizeClasses() . ' ' . $variantClasses() . ($rounded ? ' rounded-full' : ' rounded')]) }}>
    @if($dot)
        <span class="mr-1.5 h-1.5 w-1.5 rounded-full bg-current"></span>
    @endif
    @if($icon)
        <x-ui::icon :name="$icon" size="xs" class="mr-1" />
    @endif
    {{ $slot }}
</span>
