<div class="form-group" x-data="{
    show: false,
    strength: 0,
    strengthLabel: '',
    checkStrength(val) {
        if (val.length < {{ $minLength() }}) { this.strength = 0; this.strengthLabel = @js($strengthMessages()['short']); return; }
        let score = 0;
        if (/[a-z]/.test(val) && /[A-Z]/.test(val)) score++;
        if (/\d/.test(val)) score++;
        if (/[^a-zA-Z0-9]/.test(val)) score++;
        if (val.length >= 12) score++;
        this.strength = score;
        const labels = [@js($strengthMessages()['weak']), @js($strengthMessages()['weak']), @js($strengthMessages()['medium']), @js($strengthMessages()['strong']), @js($strengthMessages()['strong'])];
        this.strengthLabel = labels[score] || '';
    }
}">
    @if($label)
        <label for="{{ $id }}">
            {{ $label }}
            @if($required) <span class="text-danger" aria-hidden="true">*</span> @endif
        </label>
    @endif
    <div class="input-group">
        <input
            :type="show ? 'text' : 'password'"
            name="{{ $name }}"
            id="{{ $id }}"
            placeholder="{{ $placeholder }}"
            autocomplete="{{ $autocomplete }}"
            class="form-control {{ $hasError() ? 'is-invalid' : '' }}"
            @if($required) required @endif
            @if($hasError()) aria-invalid="true" @endif
            @if($strengthMeter) aria-describedby="{{ $id }}-strength" x-on:input="checkStrength($event.target.value)" @endif
            {{ $attributes }}
        />
        @if($showHide)
            <div class="input-group-append">
                <button
                    class="btn btn-outline-secondary"
                    type="button"
                    x-on:click="show = !show"
                    :aria-pressed="show ? 'true' : 'false'"
                    :aria-label="show ? @js(__('ui-kit::ui-kit.password.hide')) : @js(__('ui-kit::ui-kit.password.show'))"
                >
                    <span x-show="!show">{{ __('ui-kit::ui-kit.password.show') }}</span>
                    <span x-show="show" x-cloak>{{ __('ui-kit::ui-kit.password.hide') }}</span>
                </button>
            </div>
        @endif
        @if($hasError())
            <div class="invalid-feedback">{{ $errorMessage() }}</div>
        @endif
    </div>
    @if($strengthMeter)
        <div id="{{ $id }}-strength" role="status" aria-live="polite">
            <span class="sr-only">{{ __('ui-kit::ui-kit.password.strength.label') }}</span>
            <div class="progress mt-2" style="height:4px" x-show="strengthLabel" x-cloak aria-hidden="true">
                <div class="progress-bar" :class="strength <= 1 ? 'bg-danger' : (strength <= 2 ? 'bg-warning' : 'bg-success')" :style="'width:' + (strength * 25) + '%'"></div>
            </div>
            <small class="form-text" :class="strength <= 1 ? 'text-danger' : (strength <= 2 ? 'text-warning' : 'text-success')" x-text="strengthLabel" x-show="strengthLabel" x-cloak></small>
        </div>
    @endif
</div>
