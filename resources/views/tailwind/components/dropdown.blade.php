<div x-data="{ open: false }" {{ $attributes->merge(['class' => 'relative inline-block text-left']) }}>
    <div x-on:click="open = !open">
        @if(isset($trigger))
            {{ $trigger }}
        @else
            <x-ui::button variant="secondary" icon="chevron-down" icon-position="right">
                {{ $label ?? 'Options' }}
            </x-ui::button>
        @endif
    </div>

    <div
        x-show="open"
        x-on:click.outside="open = false"
        x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="transform opacity-0 scale-95"
        x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95"
        x-cloak
        class="{{ $alignClasses() }} {{ $widthClasses() }} absolute z-50 mt-2 rounded-lg bg-white dark:bg-gray-800 shadow-lg ring-1 ring-black/5 dark:ring-white/10 focus:outline-none"
        role="menu"
    >
        <div class="py-1 {{ $divided ? 'divide-y divide-gray-100 dark:divide-gray-700' : '' }}">
            {{ $slot }}
        </div>
    </div>
</div>
