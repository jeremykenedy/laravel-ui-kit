<div class="relative inline-block text-left">
    <button
        type="button"
        wire:click="toggle"
        class="inline-flex cursor-pointer items-center rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-50 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 motion-reduce:transition-none dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700"
        aria-expanded="{{ $open ? 'true' : 'false' }}"
        aria-haspopup="menu"
        aria-controls="ui-dropdown-{{ $this->getId() }}"
    >
        {{ $label ?? __('ui-kit::ui-kit.dropdown.toggle') }}
        <x-ui::icon name="chevron-down" size="sm" class="ml-1.5 -mr-0.5" aria-hidden="true" />
    </button>

    <div
        id="ui-dropdown-{{ $this->getId() }}"
        class="absolute z-50 mt-2 w-48 rounded-lg bg-white shadow-lg ring-1 ring-black/5 dark:bg-gray-800 dark:ring-white/10 {{ $align === 'right' ? 'right-0 origin-top-right' : 'left-0 origin-top-left' }}"
        role="menu"
        @unless($open) hidden @endunless
    >
        <div class="py-1">
            @foreach($items as $item)
                <a
                    href="{{ $item['url'] ?? '#' }}"
                    class="block px-4 py-2 text-sm text-gray-700 transition-colors hover:bg-gray-50 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-inset focus-visible:ring-blue-500 motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-gray-700"
                    role="menuitem"
                >{{ $item['label'] ?? '' }}</a>
            @endforeach
        </div>
    </div>
</div>
