<div
    x-data="{
        open: false,
        show() { this.open = true; document.body.style.overflow = 'hidden'; this.$nextTick(() => this.$refs.panel?.focus()); },
        hide() { this.open = false; document.body.style.overflow = ''; }
    }"
    x-on:open-modal-{{ $id }}.window="show()"
    x-on:close-modal-{{ $id }}.window="hide()"
    @if($closeable && !$static)
        x-on:keydown.escape.window="hide()"
    @endif
    x-show="open"
    x-cloak
    x-transition:enter="ease-out duration-300 motion-reduce:transition-none"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="ease-in duration-200 motion-reduce:transition-none"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-50 overflow-y-auto"
    @if($title) aria-labelledby="modal-title-{{ $id }}" @endif
    role="dialog"
    aria-modal="true"
    id="{{ $id }}"
>
    <div class="flex min-h-screen items-center justify-center p-4 text-center sm:p-0">
        <div class="fixed inset-0 bg-black/50" aria-hidden="true" @if(!$static) x-on:click="hide()" @endif></div>

        <div
            x-ref="panel"
            tabindex="-1"
            class="relative w-full {{ $sizeClasses() }} transform rounded-xl bg-white text-left shadow-xl transition-transform duration-300 focus:outline-none motion-reduce:transition-none dark:bg-gray-800 sm:my-8"
            :class="open ? 'scale-100' : 'scale-95'"
        >
            @if($title || $closeable)
                <div class="flex items-center justify-between border-b border-gray-200 px-6 py-4 dark:border-gray-700">
                    @if($title)
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100" id="modal-title-{{ $id }}">
                            {{ $title }}
                        </h3>
                    @endif
                    @if($closeable)
                        <button
                            type="button"
                            class="ml-auto cursor-pointer rounded text-gray-400 transition-colors hover:text-gray-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 motion-reduce:transition-none dark:hover:text-gray-300"
                            x-on:click="hide()"
                            aria-label="{{ __('ui-kit::ui-kit.modal.close') }}"
                        >
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true" focusable="false">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    @endif
                </div>
            @endif

            <div class="px-6 py-4">
                {{ $slot }}
            </div>

            @if(isset($footer))
                <div class="flex justify-end gap-3 border-t border-gray-200 px-6 py-4 dark:border-gray-700">
                    {{ $footer }}
                </div>
            @endif
        </div>
    </div>
</div>
