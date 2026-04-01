<nav {{ $attributes->merge(['class' => $type === 'vertical' ? 'flex flex-col space-y-1' : 'flex space-x-4']) }}>
    {{ $slot }}
</nav>
