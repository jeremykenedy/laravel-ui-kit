@if($show)
<div class="fixed inset-0 z-50 flex items-center justify-center p-4">
    <div class="fixed inset-0 bg-black/50" wire:click="cancelled"></div>
    <div class="relative bg-white dark:bg-gray-800 rounded-xl shadow-xl max-w-sm w-full p-6">
        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ $title }}</h3>
        <p class="mt-2 text-sm text-gray-500">{{ $message }}</p>
        <div class="mt-4 flex justify-end gap-3">
            <button wire:click="cancelled" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200">{{ $cancelText }}</button>
            <button wire:click="confirmed" class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700">{{ $confirmText }}</button>
        </div>
    </div>
</div>
@endif
