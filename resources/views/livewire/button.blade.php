<x-ui::button
    :variant="$variant"
    :size="$size"
    :type="$type"
    :href="$href"
    :disabled="$disabled"
    :loading="$loading"
    wire:loading.attr="disabled"
>{{ $content }}</x-ui::button>
