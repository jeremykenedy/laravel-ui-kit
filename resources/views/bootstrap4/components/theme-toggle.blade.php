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
        init() {
            try {
                this.current = localStorage.getItem(this.storageKey) || this.current;
            } catch (e) {}
            this.apply();
            window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
                if (this.current === 'system') this.apply();
            });
        },
        set(mode) {
            this.current = mode;
            try {
                localStorage.setItem(this.storageKey, mode);
            } catch (e) {}
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
        }
    }"
    x-on:keydown.escape="open = false"
    {{ $attributes->merge(['class' => 'dropdown d-inline-block']) }}
>
    <button
        x-on:click="open = !open"
        type="button"
        class="btn btn-link text-secondary p-1"
        :aria-expanded="open ? 'true' : 'false'"
        aria-haspopup="menu"
        aria-controls="{{ $id }}-menu"
        aria-label="{{ __('ui-kit::ui-kit.dropdown.toggle') }}"
    >
        <svg x-show="current === 'light'" x-cloak width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true" focusable="false"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
        <svg x-show="current === 'dark'" x-cloak width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true" focusable="false"><path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" /></svg>
        <svg x-show="current === 'system'" x-cloak width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true" focusable="false"><path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
    </button>

    <div
        id="{{ $id }}-menu"
        x-show="open"
        x-cloak
        x-on:click.outside="open = false"
        class="dropdown-menu {{ $align === 'right' ? 'dropdown-menu-right' : '' }} show"
        role="menu"
    >
        @foreach($labels as $mode => $modeLabel)
            <button
                x-on:click="set(@js($mode))"
                type="button"
                class="dropdown-item"
                role="menuitemradio"
                :aria-checked="current === @js($mode) ? 'true' : 'false'"
                :class="current === @js($mode) ? 'active' : ''"
            >{{ $modeLabel }}</button>
        @endforeach
    </div>
</div>
