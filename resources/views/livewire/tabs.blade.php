<div>
    <div class="border-b border-gray-200 dark:border-gray-700">
        <nav class="-mb-px flex space-x-8" role="tablist">
            @foreach($tabs as $tab)
                <button
                    type="button"
                    wire:click="selectTab(@js($tab))"
                    role="tab"
                    aria-selected="{{ $activeTab === $tab ? 'true' : 'false' }}"
                    tabindex="{{ $activeTab === $tab ? '0' : '-1' }}"
                    class="cursor-pointer whitespace-nowrap border-b-2 px-1 py-4 text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 motion-reduce:transition-none {{ $activeTab === $tab ? 'border-blue-500 text-blue-600 dark:text-blue-400' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300' }}"
                >{{ $tab }}</button>
            @endforeach
        </nav>
    </div>
    <div class="mt-4" role="tabpanel">
        {{ $panels[$activeTab] ?? '' }}
    </div>
</div>
