<div {{ $attributes->merge(['id' => $id]) }}
    x-data="{
        search: '',
        sortKey: '',
        sortDir: 'asc',
        visibleRows: 0,
        setSort(key) {
            if (this.sortKey === key) {
                this.sortDir = this.sortDir === 'asc' ? 'desc' : 'asc';
            } else {
                this.sortKey = key;
                this.sortDir = 'asc';
            }
            this.$dispatch('sort-changed', { key: this.sortKey, direction: this.sortDir });
        },
        filter() {
            const rows = Array.from(this.$el.querySelectorAll('tbody tr[data-searchable]'));
            const q = this.search.trim().toLowerCase();
            let shown = 0;
            rows.forEach(row => {
                const match = !q || row.textContent.toLowerCase().includes(q);
                row.hidden = !match;
                if (match) shown++;
            });
            this.visibleRows = shown;
        }
    }"
    x-init="filter(); $watch('search', () => filter())"
>
    @if($searchable)
        <div class="mb-4">
            <label for="{{ $id }}-search" class="sr-only">{{ $searchPlaceholder ?? __('ui-kit::ui-kit.search.placeholder') }}</label>
            <div class="relative">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true" focusable="false"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
                <input
                    id="{{ $id }}-search"
                    x-model="search"
                    type="search"
                    placeholder="{{ $searchPlaceholder ?? __('ui-kit::ui-kit.search.placeholder') }}"
                    class="block w-full rounded-lg border border-gray-300 bg-white py-2 pl-10 pr-4 text-sm text-gray-900 placeholder-gray-400 transition-colors focus:border-blue-500 focus:ring-2 focus:ring-blue-500 motion-reduce:transition-none dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100"
                />
            </div>
        </div>
    @endif

    <div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            @if(count($headers) > 0)
                <thead class="bg-gray-50 dark:bg-gray-800">
                    <tr>
                        @foreach($headers as $key => $header)
                            @php
                                $label = is_array($header) ? ($header['label'] ?? $header) : $header;
                                $colKey = is_string($key) ? $key : $loop->index;
                            @endphp
                            <th scope="col"
                                @if($sortable)
                                    :aria-sort="sortKey === @js((string) $colKey) ? (sortDir === 'asc' ? 'ascending' : 'descending') : 'none'"
                                @endif
                                class="{{ $compact ? 'px-3 py-2' : 'px-4 py-3' }} text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                @if($sortable)
                                    <button
                                        type="button"
                                        x-on:click="setSort(@js((string) $colKey))"
                                        class="inline-flex cursor-pointer select-none items-center gap-1 rounded uppercase tracking-wider transition-colors hover:text-gray-700 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 motion-reduce:transition-none dark:hover:text-gray-200"
                                    >
                                        {{ $label }}
                                        <svg x-show="sortKey === @js((string) $colKey)" x-cloak class="h-3 w-3 transition-transform motion-reduce:transition-none" :class="sortDir === 'desc' ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true" focusable="false"><path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7"/></svg>
                                    </button>
                                @else
                                    <span class="inline-flex items-center gap-1">{{ $label }}</span>
                                @endif
                            </th>
                        @endforeach
                    </tr>
                </thead>
            @endif
            <tbody class="divide-y divide-gray-200 bg-white dark:divide-gray-700 dark:bg-gray-900 {{ $striped ? '[&>tr:nth-child(odd)]:bg-gray-50/50 dark:[&>tr:nth-child(odd)]:bg-gray-800/30' : '' }} {{ $hoverable ? '[&>tr]:hover:bg-gray-50 dark:[&>tr]:hover:bg-gray-800/50' : '' }}">
                {{ $slot }}

                @if(isset($rows) && method_exists($rows, 'isEmpty') && $rows->isEmpty())
                    <tr>
                        <td colspan="{{ max(count($headers), 1) }}" class="px-4 py-8 text-center text-sm text-gray-500 dark:text-gray-400">
                            {{ $emptyMessage ?? __('ui-kit::ui-kit.table.empty') }}
                        </td>
                    </tr>
                @endif

                @if($searchable)
                    <tr x-show="visibleRows === 0 && search.trim().length > 0" x-cloak>
                        <td colspan="{{ max(count($headers), 1) }}" class="px-4 py-8 text-center text-sm text-gray-500 dark:text-gray-400">
                            {{ __('ui-kit::ui-kit.search.no_results') }}
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    @if(isset($rows) && method_exists($rows, 'hasPages') && $rows->hasPages())
        <div class="mt-4">
            {{ $rows->links() }}
        </div>
    @endif
</div>
