<div class="{{ $href ? 'cursor-pointer' : '' }}" @if($href) wire:click="$dispatch('navigate', { url: '{{ $href }}' })" @endif>
    <x-ui::card>
        <div class="text-center">
            <span class="text-3xl font-bold">{{ $value }}</span>
            <p class="text-sm text-muted mt-1">{{ $label }}</p>
        </div>
    </x-ui::card>
</div>
