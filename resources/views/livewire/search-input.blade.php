<div class="relative">
    <label for="ui-search-{{ $this->getId() }}" class="sr-only">{{ $placeholder ?? __('ui-kit::ui-kit.search.placeholder') }}</label>
    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
        <x-ui::icon name="search" size="sm" class="text-gray-400" aria-hidden="true" />
    </div>
    <input
        type="search"
        id="ui-search-{{ $this->getId() }}"
        wire:model.live.debounce.300ms="query"
        placeholder="{{ $placeholder }}"
        class="block w-full rounded-lg border border-gray-300 bg-white py-2 pl-10 pr-10 text-sm text-gray-900 placeholder-gray-400 transition-colors focus:border-blue-500 focus:ring-2 focus:ring-blue-500 motion-reduce:transition-none dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100"
    />
    @if($query !== '')
        <button
            type="button"
            wire:click="clear"
            class="absolute inset-y-0 right-0 flex cursor-pointer items-center rounded pr-3 text-gray-400 transition-colors hover:text-gray-600 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 motion-reduce:transition-none dark:hover:text-gray-300"
            aria-label="{{ __('ui-kit::ui-kit.search.clear') }}"
        >
            <x-ui::icon name="x" size="sm" aria-hidden="true" />
        </button>
    @endif
</div>
