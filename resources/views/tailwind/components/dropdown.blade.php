@php $dropdownId = $id ?? 'ui-dropdown-' . substr(md5($label ?? uniqid('', true)), 0, 8); @endphp
<div
    x-data="{ open: false, toggle() { this.open = !this.open; }, close() { this.open = false; } }"
    x-on:keydown.escape="close()"
    {{ $attributes->merge(['class' => 'relative inline-block text-left']) }}
>
    <div
        x-on:click="toggle()"
        x-on:keydown.enter.prevent="toggle()"
        x-on:keydown.space.prevent="toggle()"
        :aria-expanded="open ? 'true' : 'false'"
        aria-haspopup="menu"
        aria-controls="{{ $dropdownId }}"
    >
        @if(isset($trigger))
            {{ $trigger }}
        @else
            <x-ui::button variant="secondary" icon="chevron-down" icon-position="right">
                {{ $label ?? __('ui-kit::ui-kit.dropdown.toggle') }}
            </x-ui::button>
        @endif
    </div>

    <div
        id="{{ $dropdownId }}"
        x-show="open"
        x-on:click.outside="close()"
        x-transition:enter="transition ease-out duration-100 motion-reduce:transition-none"
        x-transition:enter-start="transform opacity-0 scale-95"
        x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75 motion-reduce:transition-none"
        x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95"
        x-cloak
        class="{{ $alignClasses() }} {{ $widthClasses() }} absolute z-50 mt-2 rounded-lg bg-white shadow-lg ring-1 ring-black/5 focus:outline-none dark:bg-gray-800 dark:ring-white/10"
        role="menu"
        aria-orientation="vertical"
        tabindex="-1"
    >
        <div class="py-1 {{ $divided ? 'divide-y divide-gray-100 dark:divide-gray-700' : '' }}">
            {{ $slot }}
        </div>
    </div>
</div>
