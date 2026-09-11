<div class="inline-flex items-center">
    <button
        type="button"
        wire:click="toggle"
        role="switch"
        aria-checked="{{ $checked ? 'true' : 'false' }}"
        @disabled($disabled)
        class="relative inline-flex h-6 w-11 shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 motion-reduce:transition-none dark:focus-visible:ring-offset-gray-800 {{ $checked ? 'bg-blue-600' : 'bg-gray-200 dark:bg-gray-600' }}"
    >
        <span class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out motion-reduce:transition-none {{ $checked ? 'translate-x-5' : 'translate-x-0' }}"></span>
    </button>
    @if($label)
        <span class="ml-3 text-sm font-medium text-gray-700 dark:text-gray-300">{{ $label }}</span>
    @endif
    @if($name)
        <input type="hidden" name="{{ $name }}" value="{{ $checked ? '1' : '0' }}" />
    @endif
</div>
