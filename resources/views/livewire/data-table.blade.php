<div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
        <thead class="bg-gray-50 dark:bg-gray-800">
            <tr>
                @foreach($headers as $header)
                    <th
                        scope="col"
                        class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400"
                        aria-sort="{{ $sortField === $header ? ($sortDirection === 'asc' ? 'ascending' : 'descending') : 'none' }}"
                    >
                        <button
                            type="button"
                            wire:click="sortBy(@js($header))"
                            class="cursor-pointer uppercase tracking-wider transition-colors hover:text-gray-700 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 motion-reduce:transition-none dark:hover:text-gray-200"
                        >
                            {{ $header }}
                            @if($sortField === $header)
                                <span aria-hidden="true">{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span>
                            @endif
                        </button>
                    </th>
                @endforeach
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 bg-white dark:divide-gray-700 dark:bg-gray-900">
            @forelse($rows as $row)
                <tr>
                    @foreach($headers as $header)
                        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900 dark:text-gray-100">{{ data_get($row, $header) }}</td>
                    @endforeach
                </tr>
            @empty
                <tr>
                    <td colspan="{{ max(count($headers), 1) }}" class="px-6 py-8 text-center text-sm text-gray-500 dark:text-gray-400">
                        {{ __('ui-kit::ui-kit.table.empty') }}
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
