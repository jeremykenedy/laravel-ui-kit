<div class="fixed inset-0 z-50 flex items-center justify-center p-4" role="dialog" aria-modal="true" aria-labelledby="ui-confirm-title-{{ $this->getId() }}" @unless($show) hidden @endunless>
    <div class="fixed inset-0 bg-black/50" wire:click="cancelled" aria-hidden="true"></div>
    <div class="relative w-full max-w-sm rounded-xl bg-white p-6 shadow-xl dark:bg-gray-800">
        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100" id="ui-confirm-title-{{ $this->getId() }}">{{ $title }}</h3>
        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">{{ $message }}</p>
        <div class="mt-4 flex justify-end gap-3">
            <x-ui::button variant="secondary" size="sm" wire:click="cancelled">{{ $cancelText }}</x-ui::button>
            <x-ui::button variant="danger" size="sm" wire:click="confirmed">{{ $confirmText }}</x-ui::button>
        </div>
    </div>
</div>
