@if($paginator && $paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('ui-kit::ui-kit.pagination.previous') }} / {{ __('ui-kit::ui-kit.pagination.next') }}" class="flex items-center justify-between">
        @if($showInfo)
            <div class="hidden sm:block">
                <p class="text-sm text-gray-700 dark:text-gray-400">
                    {{ __('ui-kit::ui-kit.pagination.showing') }} <span class="font-medium">{{ $paginator->firstItem() }}</span>
                    {{ __('ui-kit::ui-kit.pagination.to') }} <span class="font-medium">{{ $paginator->lastItem() }}</span>
                    {{ __('ui-kit::ui-kit.pagination.of') }} <span class="font-medium">{{ $paginator->total() }}</span> {{ __('ui-kit::ui-kit.pagination.results') }}
                </p>
            </div>
        @endif

        <div class="flex flex-1 justify-between gap-1 sm:justify-end">
            @if($simple)
                @if($paginator->onFirstPage())
                    <span class="relative inline-flex cursor-not-allowed items-center rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-400 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-500" aria-disabled="true">{{ __('ui-kit::ui-kit.pagination.previous') }}</span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="relative inline-flex items-center rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-50 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 motion-reduce:transition-none dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">{{ __('ui-kit::ui-kit.pagination.previous') }}</a>
                @endif

                @if($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="relative inline-flex items-center rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-50 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 motion-reduce:transition-none dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">{{ __('ui-kit::ui-kit.pagination.next') }}</a>
                @else
                    <span class="relative inline-flex cursor-not-allowed items-center rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-400 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-500" aria-disabled="true">{{ __('ui-kit::ui-kit.pagination.next') }}</span>
                @endif
            @else
                <div class="isolate inline-flex -space-x-px rounded-lg shadow-sm">
                    @foreach($paginator->getUrlRange(1, $paginator->lastPage()) as $page => $url)
                        @if($page == $paginator->currentPage())
                            <span class="relative z-10 inline-flex items-center bg-blue-600 px-4 py-2 text-sm font-semibold text-white focus:z-20" aria-current="page">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="relative inline-flex items-center border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-50 focus-visible:z-20 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 motion-reduce:transition-none dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">{{ $page }}</a>
                        @endif
                    @endforeach
                </div>
            @endif
        </div>
    </nav>
@endif
