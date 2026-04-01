<div
    x-data="{ show: true }"
    x-show="show"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    {{ $attributes->merge(['class' => 'rounded-lg border p-4 ' . $variantClasses()]) }}
    role="alert"
>
    <div class="flex items-start">
        @if($icon)
            <div class="flex-shrink-0 mr-3">
                <x-ui::icon :name="$icon" size="md" />
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
                class="ml-3 -mr-1.5 -mt-1.5 inline-flex rounded-lg p-1.5 focus:outline-none focus:ring-2 focus:ring-offset-2 opacity-60 hover:opacity-100 transition-opacity"
                x-on:click="show = false"
                aria-label="Dismiss"
            >
                <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
        @endif
    </div>
</div>
