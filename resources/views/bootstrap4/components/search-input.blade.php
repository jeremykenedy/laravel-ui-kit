<div class="input-group">
    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-search"></i></span></div>
    <input type="search" name="{{ $name }}" id="{{ $id }}" placeholder="{{ $placeholder }}" class="form-control" value="{{ $value ?? '' }}" @if($autofocus) autofocus @endif {{ $attributes }} />
    @if($clearable)
        <div class="input-group-append"><button class="btn btn-outline-secondary" type="button" onclick="document.getElementById('{{ $id }}').value=''">&times;</button></div>
    @endif
</div>
