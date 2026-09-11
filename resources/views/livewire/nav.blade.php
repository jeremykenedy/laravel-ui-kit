<nav class="border-b border-gray-200 bg-white dark:border-gray-700 dark:bg-gray-800">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 justify-between">
            <div class="flex items-center">
                <a href="{{ $brandUrl }}" class="rounded text-xl font-semibold text-gray-900 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 dark:text-gray-100">{{ $brand }}</a>
            </div>
            <div class="hidden sm:flex sm:items-center sm:gap-4">
                @foreach($links as $link)
                    <a href="{{ $link['url'] ?? '#' }}" class="rounded text-sm font-medium text-gray-600 transition-colors hover:text-gray-900 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 motion-reduce:transition-none dark:text-gray-400 dark:hover:text-gray-100">{{ $link['label'] ?? '' }}</a>
                @endforeach
            </div>
            <div class="flex items-center sm:hidden">
                <button
                    type="button"
                    wire:click="toggleMobile"
                    class="cursor-pointer rounded-md p-2 text-gray-400 transition-colors hover:text-gray-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 motion-reduce:transition-none"
                    aria-expanded="{{ $mobileOpen ? 'true' : 'false' }}"
                    aria-controls="ui-nav-mobile-{{ $this->getId() }}"
                    aria-label="{{ __('ui-kit::ui-kit.nav.toggle') }}"
                >
                    <x-ui::icon :name="$mobileOpen ? 'x' : 'menu'" size="lg" aria-hidden="true" />
                </button>
            </div>
        </div>
    </div>
    <div id="ui-nav-mobile-{{ $this->getId() }}" class="border-t border-gray-200 px-4 py-2 dark:border-gray-700 sm:hidden" @unless($mobileOpen) hidden @endunless>
        @foreach($links as $link)
            <a href="{{ $link['url'] ?? '#' }}" class="block rounded py-2 text-sm font-medium text-gray-600 transition-colors hover:text-gray-900 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 motion-reduce:transition-none dark:text-gray-400 dark:hover:text-gray-100">{{ $link['label'] ?? '' }}</a>
        @endforeach
    </div>
</nav>
