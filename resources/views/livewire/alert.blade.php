<div @unless($visible) hidden @endunless>
    <x-ui::alert :variant="$variant" :title="$title" :dismissible="false">
        {{ $content }}
        @if($dismissible)
            <x-ui::button
                variant="secondary"
                size="xs"
                outline
                icon="x"
                icon-only
                wire:click="dismiss"
                :tooltip="__('ui-kit::ui-kit.alert.dismiss')"
            />
        @endif
    </x-ui::alert>
</div>
