<nav {{ $attributes->merge(['class' => $type === 'vertical' ? 'flex flex-col space-y-1' : 'flex flex-wrap items-center gap-x-4 gap-y-2']) }}>
    {{ $slot }}
</nav>
