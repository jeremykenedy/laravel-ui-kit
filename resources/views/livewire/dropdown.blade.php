<div class="relative" x-data="{ open: @entangle('open') }">
    <div @click="open = !open">{{ $trigger ?? '' }}</div>
    <div x-show="open" @click.away="open = false" x-transition class="absolute z-50 mt-2 {{ $align === 'right' ? 'right-0' : 'left-0' }} w-48 rounded-md shadow-lg bg-white dark:bg-gray-800 ring-1 ring-black ring-opacity-5">
        <div class="py-1">{{ $slot }}</div>
    </div>
</div>
