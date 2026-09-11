@props(['items' => []])

<nav aria-label="{{ __('ui-kit::ui-kit.breadcrumbs.home') }}" {{ $attributes->merge(['class' => 'mb-4']) }}>
    <ol class="flex flex-wrap items-center gap-1.5 text-sm text-gray-500 dark:text-gray-400">
        @if($showHome)
            <li>
                <a
                    href="{{ $resolvedHomeUrl() }}"
                    class="inline-flex rounded transition-colors hover:text-gray-700 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 dark:hover:text-gray-200 motion-reduce:transition-none"
                    aria-label="{{ $resolvedHomeLabel() }}"
                >
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true" focusable="false"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" /></svg>
                </a>
            </li>
        @endif
        @foreach($items as $item)
            <li class="flex items-center gap-1.5">
                @if($showHome || !$loop->first)
                    <svg class="h-3.5 w-3.5 text-gray-300 dark:text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true" focusable="false"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" /></svg>
                @endif
                @if(isset($item['url']) && !$loop->last)
                    <a href="{{ $item['url'] }}" class="rounded transition-colors hover:text-gray-700 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 dark:hover:text-gray-200 motion-reduce:transition-none">{{ $item['label'] }}</a>
                @else
                    <span class="font-medium text-gray-900 dark:text-gray-100" @if($loop->last) aria-current="page" @endif>{{ $item['label'] }}</span>
                @endif
            </li>
        @endforeach
    </ol>
</nav>
