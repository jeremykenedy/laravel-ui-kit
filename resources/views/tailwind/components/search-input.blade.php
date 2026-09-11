<div x-data="{ query: @js($value ?? '') }" {{ $attributes->merge(['class' => 'relative']) }}>
    <label for="{{ $id }}" class="sr-only">{{ $placeholder ?? __('ui-kit::ui-kit.search.placeholder') }}</label>
    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true" focusable="false">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
    </div>
    <input
        type="search"
        name="{{ $name }}"
        id="{{ $id }}"
        placeholder="{{ $placeholder }}"
        x-model="query"
        @if($autofocus) autofocus @endif
        @if($debounce) x-on:input.debounce.{{ $debounce }}ms="$dispatch('search', { query: query })" @endif
        class="block w-full rounded-lg border border-gray-300 bg-white py-2 pl-10 pr-10 text-sm text-gray-900 placeholder-gray-400 transition-colors duration-150 focus:border-blue-500 focus:ring-2 focus:ring-blue-500 motion-reduce:transition-none dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100"
    />
    @if($clearable)
        <button
            type="button"
            x-show="query.length > 0"
            x-on:click="query = ''; $dispatch('search', { query: '' })"
            x-cloak
            class="absolute inset-y-0 right-0 flex cursor-pointer items-center rounded pr-3 text-gray-400 transition-colors hover:text-gray-600 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 motion-reduce:transition-none dark:hover:text-gray-300"
            aria-label="{{ __('ui-kit::ui-kit.search.clear') }}"
        >
            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true" focusable="false">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </button>
    @endif
</div>
