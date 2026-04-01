<span {{ $attributes->merge(['class' => 'badge badge-' . $variant . ($rounded ? ' badge-pill' : '')]) }}>
    @if($dot) <span class="d-inline-block rounded-circle mr-1" style="width:6px;height:6px;background:currentColor"></span> @endif
    @if($icon) <x-ui::icon :name="$icon" size="xs" class="mr-1" /> @endif
    {{ $slot }}
</span>
