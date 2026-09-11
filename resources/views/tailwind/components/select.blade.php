@php $describedBy = $hasError() && $id ? $id . '-error' : null; @endphp
<div>
    @if($label)
        <label for="{{ $id }}" class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">
            {{ $label }}
            @if($required) <span class="text-red-500" aria-hidden="true">*</span> @endif
        </label>
    @endif

    <select
        name="{{ $name }}{{ $multiple ? '[]' : '' }}"
        id="{{ $id }}"
        @required($required)
        @disabled($disabled)
        @if($multiple) multiple @endif
        @if($hasError()) aria-invalid="true" @endif
        @if($describedBy) aria-describedby="{{ $describedBy }}" @endif
        {{ $attributes->merge(['class' => 'block w-full rounded-lg border px-4 py-2.5 transition-colors duration-150 focus:outline-none focus:ring-2 focus:ring-offset-0 motion-reduce:transition-none disabled:cursor-not-allowed disabled:opacity-60 sm:text-sm dark:bg-gray-800 ' . ($hasError() ? 'border-red-300 text-red-900 focus:border-red-500 focus:ring-red-500 dark:border-red-600' : 'border-gray-300 text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:text-gray-100')]) }}
    >
        @if($placeholder)
            <option value="" disabled @if(!$selected) selected @endif>{{ $placeholder }}</option>
        @endif
        @foreach($options as $optionValue => $optionLabel)
            <option value="{{ $optionValue }}" @selected(old($name, $selected) == $optionValue)>{{ $optionLabel }}</option>
        @endforeach
        {{ $slot }}
    </select>

    @if($hasError())
        <p @if($id) id="{{ $id }}-error" @endif class="mt-1 text-sm text-red-600 dark:text-red-400" role="alert">{{ $errorMessage() }}</p>
    @endif
</div>
