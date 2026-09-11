<label class="inline-flex items-center {{ $disabled ? 'cursor-not-allowed opacity-50' : 'cursor-pointer' }}" x-data="{ enabled: {{ $checked ? 'true' : 'false' }} }">
    <input type="hidden" name="{{ $name }}" value="0" />
    <input
        type="checkbox"
        name="{{ $name }}"
        id="{{ $id }}"
        value="1"
        class="peer sr-only"
        x-model="enabled"
        role="switch"
        :aria-checked="enabled ? 'true' : 'false'"
        @disabled($disabled)
        @if($description) aria-describedby="{{ $id }}-description" @endif
    />
    <span
        class="{{ $trackSize() }} relative inline-flex shrink-0 rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out peer-focus-visible:ring-2 peer-focus-visible:ring-blue-500 peer-focus-visible:ring-offset-2 motion-reduce:transition-none dark:peer-focus-visible:ring-offset-gray-800"
        :class="enabled ? 'bg-{{ $onColor }}-600' : 'bg-gray-200 dark:bg-gray-600'"
        aria-hidden="true"
    >
        <span
            class="{{ $thumbSize() }} pointer-events-none inline-block transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out motion-reduce:transition-none"
            :class="enabled ? '{{ $thumbTranslate() }}' : 'translate-x-0'"
        ></span>
    </span>
    @if($label)
        <span class="ml-3 text-sm font-medium text-gray-700 dark:text-gray-300">{{ $label }}</span>
    @endif
    @if($description)
        <span id="{{ $id }}-description" class="ml-3 text-sm text-gray-500 dark:text-gray-400">{{ $description }}</span>
    @endif
</label>
