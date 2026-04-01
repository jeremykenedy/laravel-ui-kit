<div x-data="{
    show: false,
    strength: 0,
    strengthLabel: '',
    checkStrength(val) {
        if (val.length < {{ $minLength() }}) { this.strength = 0; this.strengthLabel = '{{ $strengthMessages()['short'] }}'; return; }
        let score = 0;
        if (/[a-z]/.test(val) && /[A-Z]/.test(val)) score++;
        if (/\d/.test(val)) score++;
        if (/[^a-zA-Z0-9]/.test(val)) score++;
        if (val.length >= 12) score++;
        this.strength = score;
        const labels = ['{{ $strengthMessages()['weak'] }}', '{{ $strengthMessages()['weak'] }}', '{{ $strengthMessages()['medium'] }}', '{{ $strengthMessages()['strong'] }}', '{{ $strengthMessages()['strong'] }}'];
        this.strengthLabel = labels[score] || '';
    }
}">
    @if($label)
        <label for="{{ $id }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            {{ $label }}
            @if($required) <span class="text-red-500">*</span> @endif
        </label>
    @endif

    <div class="relative">
        <input
            :type="show ? 'text' : 'password'"
            name="{{ $name }}"
            id="{{ $id }}"
            placeholder="{{ $placeholder }}"
            autocomplete="{{ $autocomplete }}"
            @if($required) required @endif
            @if($strengthMeter) x-on:input="checkStrength($event.target.value)" @endif
            {{ $attributes->merge(['class' => 'block w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 px-4 py-2.5 text-gray-900 dark:text-gray-100 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500 sm:text-sm pr-10 transition-colors duration-150']) }}
        />
        @if($showHide)
            <button type="button" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300" x-on:click="show = !show" tabindex="-1">
                <svg x-show="!show" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                <svg x-show="show" x-cloak class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" /></svg>
            </button>
        @endif
    </div>

    @if($strengthMeter)
        <div class="mt-2" x-show="strengthLabel" x-cloak>
            <div class="flex gap-1 mb-1">
                <template x-for="i in 4" :key="i">
                    <div class="h-1 flex-1 rounded-full transition-colors duration-300"
                         :class="i <= strength ? (strength <= 1 ? 'bg-red-500' : (strength <= 2 ? 'bg-amber-500' : 'bg-green-500')) : 'bg-gray-200 dark:bg-gray-700'"></div>
                </template>
            </div>
            <p class="text-xs" :class="strength <= 1 ? 'text-red-600 dark:text-red-400' : (strength <= 2 ? 'text-amber-600 dark:text-amber-400' : 'text-green-600 dark:text-green-400')" x-text="strengthLabel"></p>
        </div>
    @endif

    @if($hasError())
        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $errorMessage() }}</p>
    @endif
</div>
