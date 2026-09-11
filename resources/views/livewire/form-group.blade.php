<div>
    <x-ui::form-group :name="$for" :label="$label" :hint="$hint" :error="$error" :required="$required">
        {{ $content }}
    </x-ui::form-group>
</div>
