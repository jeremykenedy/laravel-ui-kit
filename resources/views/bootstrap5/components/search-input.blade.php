<div class="position-relative" x-data="{ query: '{{ $value ?? '' }}' }">
    <div class="input-group">
        <span class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/></svg></span>
        <input type="search" name="{{ $name }}" id="{{ $id }}" placeholder="{{ $placeholder }}" class="form-control" x-model="query" @if($autofocus) autofocus @endif {{ $attributes }} />
        @if($clearable)
            <button class="btn btn-outline-secondary" type="button" x-show="query.length > 0" x-on:click="query = ''" x-cloak>&times;</button>
        @endif
    </div>
</div>
