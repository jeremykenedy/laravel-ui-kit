<div x-data="{ count: {{ strlen($value ?? old($name, '')) }} }">
    @if($label)
        <label for="{{ $id }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            {{ $label }}
            @if($required) <span class="text-red-500">*</span> @endif
        </label>
    @endif

    <textarea
        name="{{ $name }}"
        id="{{ $id }}"
        rows="{{ $rows }}"
        placeholder="{{ $placeholder }}"
        @required($required)
        @disabled($disabled)
        @if($maxlength) maxlength="{{ $maxlength }}" @endif
        @if($showCount && $maxlength) x-on:input="count = $event.target.value.length" @endif
        {{ $attributes->merge(['class' => 'block w-full rounded-lg border px-4 py-2.5 transition-colors duration-150 focus:outline-none focus:ring-2 focus:ring-offset-0 sm:text-sm dark:bg-gray-800 ' . ($hasError() ? 'border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:ring-red-500 dark:border-red-600' : 'border-gray-300 text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:text-gray-100')]) }}
    >{{ $value ?? old($name, '') }}</textarea>

    <div class="flex justify-between mt-1">
        @if($hasError())
            <p class="text-sm text-red-600 dark:text-red-400">{{ $errorMessage() }}</p>
        @else
            <span></span>
        @endif
        @if($showCount && $maxlength)
            <p class="text-xs text-gray-400" :class="count > {{ $maxlength }} ? 'text-red-500' : ''">
                <span x-text="count"></span>/{{ $maxlength }}
            </p>
        @endif
    </div>
</div>
