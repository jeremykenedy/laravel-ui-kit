<div {{ $attributes->merge(['id' => $id]) }}
    x-data="{
        search: '',
        sortKey: '',
        sortDir: 'asc',
        setSort(key) {
            if (this.sortKey === key) {
                this.sortDir = this.sortDir === 'asc' ? 'desc' : 'asc';
            } else {
                this.sortKey = key;
                this.sortDir = 'asc';
            }
        },
        matchesSearch(row) {
            if (!this.search.trim()) return true;
            const q = this.search.toLowerCase();
            return row.textContent.toLowerCase().includes(q);
        }
    }"
    x-init="
        if ($el.querySelector('tbody')) {
            const rows = Array.from($el.querySelectorAll('tbody tr[data-searchable]'));
            $watch('search', () => {
                const q = search.toLowerCase();
                rows.forEach(r => {
                    r.style.display = (!q || r.textContent.toLowerCase().includes(q)) ? '' : 'none';
                });
            });
        }
    "
>
    @if($searchable)
        <div class="mb-4">
            <div class="relative">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
                <input x-model="search" type="text" placeholder="{{ $searchPlaceholder ?? 'Search...' }}"
                    class="block w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 py-2 pl-10 pr-4 text-sm text-gray-900 dark:text-gray-100 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500 transition-colors" />
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
                                @if($sortable) @click="setSort('{{ $colKey }}')" @endif
                                class="{{ $compact ? 'px-3 py-2' : 'px-4 py-3' }} text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400 {{ $sortable ? 'cursor-pointer select-none hover:text-gray-700 dark:hover:text-gray-200' : '' }}">
                                <span class="inline-flex items-center gap-1">
                                    {{ $label }}
                                    @if($sortable)
                                        <svg x-show="sortKey === '{{ $colKey }}'" x-cloak class="h-3 w-3 transition-transform" :class="sortDir === 'desc' ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7"/></svg>
                                    @endif
                                </span>
                            </th>
                        @endforeach
                    </tr>
                </thead>
            @endif
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700 bg-white dark:bg-gray-900 {{ $striped ? '[&>tr:nth-child(odd)]:bg-gray-50/50 dark:[&>tr:nth-child(odd)]:bg-gray-800/30' : '' }} {{ $hoverable ? '[&>tr]:hover:bg-gray-50 dark:[&>tr]:hover:bg-gray-800/50' : '' }}">
                {{ $slot }}

                @if(isset($rows) && method_exists($rows, 'isEmpty') && $rows->isEmpty())
                    <tr>
                        <td colspan="{{ count($headers) }}" class="px-4 py-8 text-center text-sm text-gray-500 dark:text-gray-400">
                            {{ $emptyMessage }}
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
