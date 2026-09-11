<div {{ $attributes->merge(['class' => 'position-relative']) }} x-data="{ query: @js($value ?? '') }">
    <label for="{{ $id }}" class="visually-hidden">{{ $placeholder ?? __('ui-kit::ui-kit.search.placeholder') }}</label>
    <div class="input-group">
        <span class="input-group-text"><x-ui::icon name="search" size="sm" aria-hidden="true" /></span>
        <input
            type="search"
            name="{{ $name }}"
            id="{{ $id }}"
            placeholder="{{ $placeholder }}"
            class="form-control"
            x-model="query"
            @if($autofocus) autofocus @endif
            @if($debounce) x-on:input.debounce.{{ $debounce }}ms="$dispatch('search', { query: query })" @endif
        />
        @if($clearable)
            <button
                class="btn btn-outline-secondary"
                type="button"
                x-show="query.length > 0"
                x-on:click="query = ''; $dispatch('search', { query: '' })"
                x-cloak
                aria-label="{{ __('ui-kit::ui-kit.search.clear') }}"
            >&times;</button>
        @endif
    </div>
</div>
