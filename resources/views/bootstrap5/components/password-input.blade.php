<div class="mb-3" x-data="{ show: false, strength: 0, strengthLabel: '' }">
    @if($label)
        <label for="{{ $id }}" class="form-label">{{ $label }} @if($required) <span class="text-danger">*</span> @endif</label>
    @endif
    <div class="input-group">
        <input :type="show ? 'text' : 'password'" name="{{ $name }}" id="{{ $id }}" placeholder="{{ $placeholder }}" autocomplete="{{ $autocomplete }}" class="form-control {{ $hasError() ? 'is-invalid' : '' }}" @if($required) required @endif {{ $attributes }} />
        @if($showHide)
            <button class="btn btn-outline-secondary" type="button" x-on:click="show = !show" tabindex="-1">
                <span x-show="!show">Show</span>
                <span x-show="show" x-cloak>Hide</span>
            </button>
        @endif
        @if($hasError())
            <div class="invalid-feedback">{{ $errorMessage() }}</div>
        @endif
    </div>
    @if($strengthMeter)
        <div class="progress mt-2" style="height:4px" x-show="strengthLabel" x-cloak>
            <div class="progress-bar" :class="strength <= 1 ? 'bg-danger' : (strength <= 2 ? 'bg-warning' : 'bg-success')" :style="'width:' + (strength * 25) + '%'"></div>
        </div>
        <small class="form-text" :class="strength <= 1 ? 'text-danger' : (strength <= 2 ? 'text-warning' : 'text-success')" x-text="strengthLabel" x-show="strengthLabel" x-cloak></small>
    @endif
</div>
