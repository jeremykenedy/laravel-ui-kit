<div x-data="{ activeTab: '{{ $activeTab ?? (count($tabs) > 0 ? array_key_first($tabs) : '') }}' }" {{ $attributes }}>
    <div class="{{ $vertical ? 'flex gap-6' : '' }}">
        <div class="{{ $vertical ? 'flex flex-col space-y-1 min-w-[200px] border-r border-gray-200 dark:border-gray-700 pr-4' : 'border-b border-gray-200 dark:border-gray-700' }}" role="tablist">
            <nav class="{{ $vertical ? 'flex flex-col space-y-1' : 'flex space-x-6 -mb-px' }}">
                @foreach($tabs as $key => $label)
                    <button
                        type="button"
                        x-on:click="activeTab = '{{ $key }}'"
                        :class="activeTab === '{{ $key }}'
                            ? '{{ $vertical
                                ? 'bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 border-blue-600'
                                : 'border-blue-600 text-blue-600 dark:text-blue-400' }}'
                            : '{{ $vertical
                                ? 'text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-800 border-transparent'
                                : 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300' }}'"
                        class="{{ $vertical
                            ? 'px-3 py-2 text-sm font-medium rounded-lg border-l-2 text-left transition-colors duration-150'
                            : 'py-3 text-sm font-medium border-b-2 transition-colors duration-150 whitespace-nowrap' }}"
                        role="tab"
                        :aria-selected="activeTab === '{{ $key }}'"
                    >
                        {{ $label }}
                    </button>
                @endforeach
            </nav>
        </div>

        <div class="{{ $vertical ? 'flex-1' : 'mt-4' }}">
            {{ $slot }}
        </div>
    </div>
</div>
