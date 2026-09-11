<div
    x-data="{
        open: false,
        title: @js($title),
        message: @js($message),
        formId: @js($formId),
        show(detail) {
            this.title = detail.title || @js($title);
            this.message = detail.message || @js($message);
            this.formId = detail.formId || @js($formId);
            this.open = true;
            document.body.style.overflow = 'hidden';
            this.$nextTick(() => this.$refs.confirmButton?.focus());
        },
        hide() {
            this.open = false;
            document.body.style.overflow = '';
        },
        accept() {
            const form = this.formId ? document.getElementById(this.formId) : null;

            if (form && form.tagName === 'FORM') {
                form.submit();
            } else {
                this.$dispatch('confirmed', { formId: this.formId });
            }

            this.hide();
        }
    }"
    x-on:open-confirm.window="show($event.detail || {})"
    x-on:keydown.escape.window="hide()"
    x-show="open"
    x-cloak
    x-transition:enter="ease-out duration-300 motion-reduce:transition-none"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="ease-in duration-200 motion-reduce:transition-none"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-50 overflow-y-auto"
    role="dialog"
    aria-modal="true"
    aria-labelledby="{{ $id }}-title"
    aria-describedby="{{ $id }}-message"
    id="{{ $id }}"
>
    <div class="flex min-h-screen items-center justify-center p-4">
        <div class="fixed inset-0 bg-black/50" x-on:click="hide()" aria-hidden="true"></div>

        <div
            class="relative w-full max-w-md transform rounded-xl bg-white p-6 text-left shadow-xl transition-transform duration-300 motion-reduce:transition-none dark:bg-gray-800"
            :class="open ? 'scale-100' : 'scale-95'"
        >
            <h3 id="{{ $id }}-title" class="text-lg font-medium text-gray-900 dark:text-gray-100" x-text="title"></h3>
            <p id="{{ $id }}-message" class="mt-2 text-sm text-gray-500 dark:text-gray-400" x-text="message"></p>
            <div class="mt-5 flex justify-end gap-3">
                <x-ui::button variant="secondary" size="sm" x-on:click="hide()">
                    {{ $cancelText }}
                </x-ui::button>
                <x-ui::button :variant="$variant" size="sm" x-ref="confirmButton" x-on:click="accept()">
                    {{ $confirmText }}
                </x-ui::button>
            </div>
        </div>
    </div>
</div>
