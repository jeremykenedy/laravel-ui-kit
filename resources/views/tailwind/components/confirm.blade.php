<div
    x-data="{
        open: false,
        title: '{{ $title }}',
        message: '{{ $message }}',
        variant: '{{ $variant }}',
        formId: null,
    }"
    x-on:open-confirm.window="
        open = true;
        title = $event.detail.title || '{{ $title }}';
        message = $event.detail.message || '{{ $message }}';
        variant = $event.detail.variant || '{{ $variant }}';
        formId = $event.detail.formId || null;
    "
    x-on:keydown.escape.window="open = false"
    x-show="open"
    x-cloak
    class="fixed inset-0 z-50 overflow-y-auto"
    role="dialog"
    aria-modal="true"
>
    <div class="flex min-h-screen items-center justify-center p-4">
        <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-black/50" x-on:click="open = false"></div>

        <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="relative w-full max-w-md transform rounded-xl bg-white dark:bg-gray-800 p-6 text-left shadow-xl">
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100" x-text="title"></h3>
            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400" x-text="message"></p>
            <div class="mt-5 flex justify-end gap-3">
                <x-ui::button variant="secondary" size="sm" x-on:click="open = false">
                    {{ $cancelText }}
                </x-ui::button>
                <x-ui::button :variant="$variant" size="sm" x-on:click="if(formId) { document.getElementById(formId).submit(); } else { $dispatch('confirmed'); } open = false;">
                    {{ $confirmText }}
                </x-ui::button>
            </div>
        </div>
    </div>
</div>
