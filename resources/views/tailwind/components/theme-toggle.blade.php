@php
    $labels = $modeLabels();
    $persistUrl = $persistUrl();
@endphp
<div
    x-data="{
        open: false,
        current: @js($default),
        storageKey: @js(config('ui-kit.dark_mode.storage_key', 'theme')),
        endpoint: @js($persistUrl),
        media: null,
        init() {
            try {
                this.current = localStorage.getItem(this.storageKey) || this.current;
            } catch (e) {
                // storage unavailable (private mode); fall back to the configured default
            }
            this.apply();
            this.media = window.matchMedia('(prefers-color-scheme: dark)');
            this.media.addEventListener('change', () => {
                if (this.current === 'system') this.apply();
            });
        },
        set(mode) {
            this.current = mode;
            try {
                localStorage.setItem(this.storageKey, mode);
            } catch (e) {
                // storage unavailable; the theme still applies for this page
            }
            this.apply();
            this.open = false;
            this.$dispatch('theme-changed', { mode: mode });
            this.persist(mode);
        },
        persist(mode) {
            if (!this.endpoint) return;
            const token = document.querySelector('meta[name=csrf-token]')?.content;
            fetch(this.endpoint, {
                method: @js($persistMethod()),
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    ...(token ? { 'X-CSRF-TOKEN': token } : {}),
                },
                body: JSON.stringify({ dark_mode: mode }),
            }).catch(() => {});
        },
        apply() {
            const isDark = this.current === 'dark'
                || (this.current === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches);
            document.documentElement.classList.toggle('dark', isDark);
            document.documentElement.style.colorScheme = isDark ? 'dark' : 'light';
        }
    }"
    x-on:keydown.escape="open = false"
    {{ $attributes->merge(['class' => 'relative']) }}
>
    <button
        type="button"
        x-on:click="open = !open"
        class="inline-flex cursor-pointer items-center rounded-md p-2 text-gray-500 transition-colors hover:bg-gray-100 hover:text-gray-900 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 motion-reduce:transition-none dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-gray-100"
        :aria-expanded="open ? 'true' : 'false'"
        aria-haspopup="menu"
        aria-controls="{{ $id }}-menu"
        aria-label="{{ __('ui-kit::ui-kit.dropdown.toggle') }}"
    >
        <svg x-show="current === 'light'" x-cloak class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true" focusable="false"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
        <svg x-show="current === 'dark'" x-cloak class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true" focusable="false"><path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" /></svg>
        <svg x-show="current === 'system'" x-cloak class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true" focusable="false"><path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
    </button>

    <div
        id="{{ $id }}-menu"
        x-show="open"
        x-cloak
        x-on:click.outside="open = false"
        x-transition:enter="transition ease-out duration-100 motion-reduce:transition-none"
        x-transition:enter-start="transform opacity-0 scale-95"
        x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75 motion-reduce:transition-none"
        x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95"
        class="absolute {{ $align === 'left' ? 'left-0' : 'right-0' }} z-50 mt-1 w-36 rounded-lg bg-white shadow-lg ring-1 ring-gray-200 dark:bg-gray-800 dark:ring-gray-700"
        role="menu"
        aria-orientation="vertical"
    >
        <div class="py-1">
            @foreach($labels as $mode => $modeLabel)
                <button
                    type="button"
                    x-on:click="set(@js($mode))"
                    role="menuitemradio"
                    :aria-checked="current === @js($mode) ? 'true' : 'false'"
                    class="flex w-full cursor-pointer items-center gap-2 px-4 py-2 text-sm transition-colors hover:bg-gray-50 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-inset focus-visible:ring-blue-500 motion-reduce:transition-none dark:hover:bg-gray-700"
                    :class="current === @js($mode) ? 'font-medium text-gray-900 dark:text-gray-100' : 'text-gray-500 dark:text-gray-400'"
                >
                    @if($mode === 'light')
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true" focusable="false"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                    @elseif($mode === 'dark')
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true" focusable="false"><path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" /></svg>
                    @else
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true" focusable="false"><path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                    @endif
                    {{ $modeLabel }}
                </button>
            @endforeach
        </div>
    </div>
</div>
