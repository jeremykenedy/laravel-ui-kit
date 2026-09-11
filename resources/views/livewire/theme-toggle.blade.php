<div class="relative">
    <button
        type="button"
        wire:click="$toggle('menuOpen')"
        class="inline-flex cursor-pointer items-center rounded-md p-2 text-gray-500 transition-colors hover:bg-gray-100 hover:text-gray-900 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 motion-reduce:transition-none dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-gray-100"
        aria-expanded="{{ $menuOpen ? 'true' : 'false' }}"
        aria-haspopup="menu"
        aria-controls="ui-theme-menu-{{ $this->getId() }}"
        aria-label="{{ __('ui-kit::ui-kit.dropdown.toggle') }}"
    >
        <x-ui::icon :name="match($current) { 'light' => 'sun', 'dark' => 'moon', default => 'monitor' }" size="md" aria-hidden="true" />
    </button>

    <div
        id="ui-theme-menu-{{ $this->getId() }}"
        class="absolute right-0 z-50 mt-1 w-36 rounded-lg bg-white shadow-lg ring-1 ring-gray-200 dark:bg-gray-800 dark:ring-gray-700"
        role="menu"
        @unless($menuOpen) hidden @endunless
    >
        <div class="py-1">
            @foreach(['light', 'dark', 'system'] as $mode)
                <button
                    type="button"
                    wire:click="setTheme('{{ $mode }}')"
                    role="menuitemradio"
                    aria-checked="{{ $current === $mode ? 'true' : 'false' }}"
                    class="flex w-full cursor-pointer items-center gap-2 px-4 py-2 text-sm transition-colors hover:bg-gray-50 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-inset focus-visible:ring-blue-500 motion-reduce:transition-none dark:hover:bg-gray-700 {{ $current === $mode ? 'font-medium text-gray-900 dark:text-gray-100' : 'text-gray-500 dark:text-gray-400' }}"
                >{{ __('ui-kit::ui-kit.dark_mode.' . $mode) }}</button>
            @endforeach
        </div>
    </div>
</div>

@script
<script>
    const storageKey = @js(config('ui-kit.dark_mode.storage_key', 'theme'));

    const applyTheme = (mode) => {
        const isDark = mode === 'dark'
            || (mode === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches);

        document.documentElement.classList.toggle('dark', isDark);
        document.documentElement.style.colorScheme = isDark ? 'dark' : 'light';
    };

    try {
        const stored = localStorage.getItem(storageKey);

        if (stored && stored !== $wire.current) {
            $wire.set('current', stored);
        }
    } catch (error) {
        // storage unavailable, fall back to the server side value
    }

    applyTheme($wire.current);

    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
        if ($wire.current === 'system') {
            applyTheme('system');
        }
    });

    $wire.on('theme-changed', (event) => {
        const mode = Array.isArray(event) ? event[0].mode : event.mode;

        try {
            localStorage.setItem(storageKey, mode);
        } catch (error) {
            // storage unavailable, the theme still applies for this page
        }

        applyTheme(mode);
    });
</script>
@endscript
