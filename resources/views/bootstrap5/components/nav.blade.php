<nav {{ $attributes }}>
    <ul class="nav {{ $pills ? 'nav-pills' : ($bordered ? 'nav-tabs' : '') }} {{ $type === 'vertical' ? 'flex-column' : '' }}">
        {{ $slot }}
    </ul>
</nav>
