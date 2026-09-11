@php $firstItem = $total === 0 ? 0 : (($currentPage - 1) * $perPage) + 1; @endphp
<nav class="flex items-center justify-between" aria-label="{{ __('ui-kit::ui-kit.pagination.previous') }} / {{ __('ui-kit::ui-kit.pagination.next') }}" @if($lastPage <= 1) hidden @endif>
    <p class="text-sm text-gray-700 dark:text-gray-400">
        {{ __('ui-kit::ui-kit.pagination.showing') }} {{ $firstItem }}
        {{ __('ui-kit::ui-kit.pagination.to') }} {{ min($currentPage * $perPage, $total) }}
        {{ __('ui-kit::ui-kit.pagination.of') }} {{ $total }} {{ __('ui-kit::ui-kit.pagination.results') }}
    </p>
    <div class="flex gap-1">
        <button
            type="button"
            wire:click="goToPage({{ $currentPage - 1 }})"
            @disabled($currentPage <= 1)
            class="cursor-pointer rounded border border-gray-300 px-3 py-1 text-sm text-gray-700 transition-colors hover:bg-gray-50 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 disabled:cursor-not-allowed disabled:opacity-50 motion-reduce:transition-none dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-700"
        >{{ __('ui-kit::ui-kit.pagination.previous') }}</button>

        @for($page = max(1, $currentPage - 2); $page <= min($lastPage, $currentPage + 2); $page++)
            <button
                type="button"
                wire:click="goToPage({{ $page }})"
                @if($page === $currentPage) aria-current="page" @endif
                class="cursor-pointer rounded border px-3 py-1 text-sm transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 motion-reduce:transition-none {{ $page === $currentPage ? 'border-blue-600 bg-blue-600 text-white' : 'border-gray-300 text-gray-700 hover:bg-gray-50 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-700' }}"
            >{{ $page }}</button>
        @endfor

        <button
            type="button"
            wire:click="goToPage({{ $currentPage + 1 }})"
            @disabled($currentPage >= $lastPage)
            class="cursor-pointer rounded border border-gray-300 px-3 py-1 text-sm text-gray-700 transition-colors hover:bg-gray-50 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 disabled:cursor-not-allowed disabled:opacity-50 motion-reduce:transition-none dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-700"
        >{{ __('ui-kit::ui-kit.pagination.next') }}</button>
    </div>
</nav>
