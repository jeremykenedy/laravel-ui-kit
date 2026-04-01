@if($paginator && $paginator->hasPages())
    <nav role="navigation" aria-label="Pagination" class="flex items-center justify-between">
        @if($showInfo)
            <div class="hidden sm:block">
                <p class="text-sm text-gray-700 dark:text-gray-400">
                    Showing <span class="font-medium">{{ $paginator->firstItem() }}</span>
                    to <span class="font-medium">{{ $paginator->lastItem() }}</span>
                    of <span class="font-medium">{{ $paginator->total() }}</span> results
                </p>
            </div>
        @endif

        <div class="flex flex-1 justify-between sm:justify-end gap-1">
            @if($simple)
                @if($paginator->onFirstPage())
                    <span class="relative inline-flex items-center rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 px-4 py-2 text-sm font-medium text-gray-400 dark:text-gray-500 cursor-not-allowed">Previous</span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" class="relative inline-flex items-center rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">Previous</a>
                @endif

                @if($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" class="relative inline-flex items-center rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">Next</a>
                @else
                    <span class="relative inline-flex items-center rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 px-4 py-2 text-sm font-medium text-gray-400 dark:text-gray-500 cursor-not-allowed">Next</span>
                @endif
            @else
                <div class="isolate inline-flex -space-x-px rounded-lg shadow-sm">
                    @foreach($paginator->getUrlRange(1, $paginator->lastPage()) as $page => $url)
                        @if($page == $paginator->currentPage())
                            <span class="relative z-10 inline-flex items-center bg-blue-600 px-4 py-2 text-sm font-semibold text-white focus:z-20">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="relative inline-flex items-center border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">{{ $page }}</a>
                        @endif
                    @endforeach
                </div>
            @endif
        </div>
    </nav>
@endif
