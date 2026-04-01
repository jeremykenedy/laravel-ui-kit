@php
    $sizes = ['sm' => 'sm:max-w-sm', 'md' => 'sm:max-w-lg', 'lg' => 'sm:max-w-2xl', 'xl' => 'sm:max-w-4xl'];
@endphp

@if($show)
<div class="fixed inset-0 z-50 overflow-y-auto" x-data x-transition>
    <div class="flex min-h-screen items-center justify-center p-4">
        <div class="fixed inset-0 bg-black/50" wire:click="close"></div>
        <div class="relative w-full {{ $sizes[$size] ?? $sizes['md'] }} rounded-xl bg-white dark:bg-gray-800 shadow-xl">
            <div class="flex items-center justify-between border-b border-gray-200 dark:border-gray-700 px-6 py-4">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ $title }}</h3>
                <button wire:click="close" class="text-gray-400 hover:text-gray-500">&times;</button>
            </div>
            <div class="px-6 py-4">{{ $slot }}</div>
        </div>
    </div>
</div>
@endif
