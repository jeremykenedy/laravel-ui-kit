<div class="form-group">
    @if($label) <label for="{{ $id }}">{{ $label }} @if($required) <span class="text-danger">*</span> @endif</label> @endif
    <div class="input-group">
        <input type="password" name="{{ $name }}" id="{{ $id }}" placeholder="{{ $placeholder }}" autocomplete="{{ $autocomplete }}" class="form-control {{ $hasError() ? 'is-invalid' : '' }}" @if($required) required @endif {{ $attributes }} />
        @if($showHide)
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button" onclick="var i=document.getElementById('{{ $id }}');i.type=i.type==='password'?'text':'password';this.textContent=i.type==='password'?'Show':'Hide'" tabindex="-1">Show</button>
            </div>
        @endif
        @if($hasError()) <div class="invalid-feedback">{{ $errorMessage() }}</div> @endif
    </div>
</div>
