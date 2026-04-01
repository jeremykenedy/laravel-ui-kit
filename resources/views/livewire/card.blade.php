<div class="rounded-lg bg-white dark:bg-gray-800 shadow-sm {{ $bordered ? 'border border-gray-200 dark:border-gray-700' : '' }}">
    @if($title)<div class="border-b border-gray-200 dark:border-gray-700 p-4 sm:p-6"><h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ $title }}</h3>@if($subtitle)<p class="mt-1 text-sm text-gray-500">{{ $subtitle }}</p>@endif</div>@endif
    <div class="p-4 sm:p-6">{{ $slot }}</div>
</div>
