<div
    x-data="{ show: true }"
    x-show="show"
    x-cloak
    x-transition:leave="transition ease-in duration-200 motion-reduce:transition-none"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    {{ $attributes->merge(['class' => 'rounded-lg border p-4 ' . $variantClasses()]) }}
    role="alert"
    aria-live="polite"
>
    <div class="flex items-start">
        @if($icon)
            <div class="shrink-0 mr-3">
                <x-ui::icon :name="$icon" size="md" aria-hidden="true" />
            </div>
        @endif
        <div class="flex-1">
            @if($title)
                <h3 class="text-sm font-medium">{{ $title }}</h3>
            @endif
            <div class="@if($title) mt-1 @endif text-sm opacity-90">
                {{ $slot }}
            </div>
        </div>
        @if($dismissible)
            <button
                type="button"
                class="ml-3 -mr-1.5 -mt-1.5 inline-flex cursor-pointer rounded-lg p-1.5 opacity-60 transition-opacity hover:opacity-100 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-current focus-visible:ring-offset-2 focus-visible:ring-offset-transparent motion-reduce:transition-none"
                x-on:click="show = false"
                aria-label="{{ __('ui-kit::ui-kit.alert.dismiss') }}"
            >
                <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true" focusable="false">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
        @endif
    </div>
</div>
