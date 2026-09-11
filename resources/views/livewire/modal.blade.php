@php $sizes = ['sm' => 'sm:max-w-sm', 'md' => 'sm:max-w-lg', 'lg' => 'sm:max-w-2xl', 'xl' => 'sm:max-w-4xl']; @endphp
<div class="fixed inset-0 z-50 overflow-y-auto" role="dialog" aria-modal="true" aria-labelledby="ui-modal-title-{{ $this->getId() }}" @unless($show) hidden @endunless>
    <div class="flex min-h-screen items-center justify-center p-4">
        <div class="fixed inset-0 bg-black/50" wire:click="close" aria-hidden="true"></div>
        <div class="relative w-full {{ $sizes[$size] ?? $sizes['md'] }} rounded-xl bg-white shadow-xl dark:bg-gray-800">
            <div class="flex items-center justify-between border-b border-gray-200 px-6 py-4 dark:border-gray-700">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100" id="ui-modal-title-{{ $this->getId() }}">{{ $title }}</h3>
                <button
                    type="button"
                    wire:click="close"
                    class="cursor-pointer rounded text-gray-400 transition-colors hover:text-gray-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 motion-reduce:transition-none dark:hover:text-gray-300"
                    aria-label="{{ __('ui-kit::ui-kit.modal.close') }}"
                >
                    <x-ui::icon name="x" size="md" aria-hidden="true" />
                </button>
            </div>
            <div class="px-6 py-4">{{ $content }}</div>
        </div>
    </div>
</div>
