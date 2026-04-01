<div class="form-group">
    @if($label) <label for="{{ $id }}">{{ $label }} @if($required) <span class="text-danger">*</span> @endif</label> @endif
    <textarea name="{{ $name }}" id="{{ $id }}" rows="{{ $rows }}" placeholder="{{ $placeholder }}" class="form-control {{ $hasError() ? 'is-invalid' : '' }}" @required($required) @disabled($disabled) @if($maxlength) maxlength="{{ $maxlength }}" @endif {{ $attributes }}>{{ $value ?? old($name, '') }}</textarea>
    @if($hasError()) <div class="invalid-feedback">{{ $errorMessage() }}</div> @endif
</div>
