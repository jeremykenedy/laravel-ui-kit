<label class="inline-flex items-center {{ $disabled ? 'opacity-50 cursor-not-allowed' : 'cursor-pointer' }}" x-data="{ enabled: {{ $checked ? 'true' : 'false' }} }">
    <input type="hidden" name="{{ $name }}" value="0" />
    <input
        type="checkbox"
        name="{{ $name }}"
        id="{{ $id }}"
        value="1"
        class="sr-only"
        x-model="enabled"
        @disabled($disabled)
    />
    <span
        class="{{ $trackSize() }} relative inline-flex flex-shrink-0 rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800"
        :class="enabled ? 'bg-{{ $onColor }}-600' : 'bg-gray-200 dark:bg-gray-600'"
        x-on:click="if(!{{ $disabled ? 'true' : 'false' }}) enabled = !enabled"
        role="switch"
        :aria-checked="enabled"
    >
        <span
            class="{{ $thumbSize() }} pointer-events-none inline-block transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"
            :class="enabled ? '{{ $thumbTranslate() }}' : 'translate-x-0'"
        ></span>
    </span>
    @if($label)
        <span class="ml-3 text-sm font-medium text-gray-700 dark:text-gray-300">{{ $label }}</span>
    @endif
    @if($description)
        <span class="ml-3 text-sm text-gray-500 dark:text-gray-400">{{ $description }}</span>
    @endif
</label>
