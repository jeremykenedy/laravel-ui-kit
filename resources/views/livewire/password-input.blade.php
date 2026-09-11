<div>
    @if($label)
        <label for="ui-password-{{ $this->getId() }}" class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">
            {{ $label }}
            @if($required) <span class="text-red-500" aria-hidden="true">*</span> @endif
        </label>
    @endif

    <div class="relative">
        <input
            type="{{ $showPassword ? 'text' : 'password' }}"
            id="ui-password-{{ $this->getId() }}"
            name="{{ $name }}"
            wire:model.live="value"
            autocomplete="{{ $autocomplete }}"
            @if($required) required @endif
            @if($error) aria-invalid="true" aria-describedby="ui-password-error-{{ $this->getId() }}" @endif
            class="block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 pr-10 text-sm text-gray-900 placeholder-gray-400 transition-colors focus:border-blue-500 focus:ring-2 focus:ring-blue-500 motion-reduce:transition-none dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100"
        />
        <button
            type="button"
            wire:click="toggleVisibility"
            aria-pressed="{{ $showPassword ? 'true' : 'false' }}"
            aria-label="{{ $showPassword ? __('ui-kit::ui-kit.password.hide') : __('ui-kit::ui-kit.password.show') }}"
            class="absolute inset-y-0 right-0 flex cursor-pointer items-center rounded pr-3 text-gray-400 transition-colors hover:text-gray-600 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 motion-reduce:transition-none dark:hover:text-gray-300"
        >
            <x-ui::icon :name="$showPassword ? 'eye-off' : 'eye'" size="sm" aria-hidden="true" />
        </button>
    </div>

    @if($error)
        <p id="ui-password-error-{{ $this->getId() }}" class="mt-1 text-sm text-red-600 dark:text-red-400" role="alert">{{ $error }}</p>
    @endif
</div>
