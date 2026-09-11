@php $firstTab = $activeTab ?? (count($tabs) > 0 ? array_key_first($tabs) : ''); @endphp
<div
    x-data="{
        activeTab: @js((string) $firstTab),
        tabs: @js(array_map('strval', array_keys($tabs))),
        select(key) { this.activeTab = key; this.$dispatch('tab-changed', { tab: key }); },
        move(offset) {
            const index = this.tabs.indexOf(this.activeTab);
            const next = (index + offset + this.tabs.length) % this.tabs.length;
            this.select(this.tabs[next]);
            this.$nextTick(() => this.$refs['tab-' + this.tabs[next]]?.focus());
        }
    }"
    {{ $attributes }}
>
    <div class="{{ $vertical ? 'flex gap-6' : '' }}">
        <div class="{{ $vertical ? 'flex min-w-[200px] flex-col space-y-1 border-r border-gray-200 pr-4 dark:border-gray-700' : 'border-b border-gray-200 dark:border-gray-700' }}">
            <nav
                class="{{ $vertical ? 'flex flex-col space-y-1' : '-mb-px flex space-x-6 overflow-x-auto' }}"
                role="tablist"
                :aria-orientation="@js($vertical ? 'vertical' : 'horizontal')"
                x-on:keydown.right.prevent="@js(!$vertical) && move(1)"
                x-on:keydown.left.prevent="@js(!$vertical) && move(-1)"
                x-on:keydown.down.prevent="@js($vertical) && move(1)"
                x-on:keydown.up.prevent="@js($vertical) && move(-1)"
            >
                @foreach($tabs as $key => $label)
                    <button
                        type="button"
                        id="{{ $id }}-tab-{{ $key }}"
                        x-ref="tab-{{ $key }}"
                        x-on:click="select(@js((string) $key))"
                        :class="activeTab === @js((string) $key)
                            ? '{{ $vertical
                                ? 'bg-blue-50 text-blue-600 border-blue-600 dark:bg-blue-900/20 dark:text-blue-400'
                                : 'border-blue-600 text-blue-600 dark:text-blue-400' }}'
                            : '{{ $vertical
                                ? 'border-transparent text-gray-600 hover:bg-gray-50 dark:text-gray-400 dark:hover:bg-gray-800'
                                : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300' }}'"
                        class="{{ $vertical
                            ? 'cursor-pointer rounded-lg border-l-2 px-3 py-2 text-left text-sm font-medium transition-colors duration-150 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 motion-reduce:transition-none'
                            : 'cursor-pointer whitespace-nowrap border-b-2 py-3 text-sm font-medium transition-colors duration-150 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 motion-reduce:transition-none' }}"
                        role="tab"
                        :aria-selected="activeTab === @js((string) $key) ? 'true' : 'false'"
                        :tabindex="activeTab === @js((string) $key) ? '0' : '-1'"
                        aria-controls="{{ $id }}-panel-{{ $key }}"
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
