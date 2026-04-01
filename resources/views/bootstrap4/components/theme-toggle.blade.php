<div x-data="{
    open: false,
    current: localStorage.getItem('theme') || '{{ $userDarkMode ?? "system" }}',
    init() { this.apply(); window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => { if (this.current === 'system') this.apply(); }); },
    set(mode) {
        this.current = mode; localStorage.setItem('theme', mode); this.apply(); this.open = false;
        @auth
        fetch('{{ route("profile.dark-mode") }}', { method: 'PUT', headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]')?.content || '{{ csrf_token() }}', 'Accept': 'application/json' }, body: JSON.stringify({ dark_mode: mode }) }).catch(() => {});
        @endauth
    },
    apply() { document.documentElement.classList.toggle('dark', this.current === 'dark' || (this.current === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches)); }
}" class="dropdown d-inline-block">
    <button @click="open = !open" type="button" class="btn btn-link text-secondary p-1" title="Toggle theme">
        <svg x-show="current === 'light'" x-cloak width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
        <svg x-show="current === 'dark'" x-cloak width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" /></svg>
        <svg x-show="current === 'system'" x-cloak width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
    </button>
    <div x-show="open" x-cloak @click.away="open = false" class="dropdown-menu show" style="position:absolute; right:0;">
        <button @click="set('light')" type="button" class="dropdown-item" :class="current === 'light' ? 'active' : ''">Light</button>
        <button @click="set('dark')" type="button" class="dropdown-item" :class="current === 'dark' ? 'active' : ''">Dark</button>
        <button @click="set('system')" type="button" class="dropdown-item" :class="current === 'system' ? 'active' : ''">System</button>
    </div>
</div>
