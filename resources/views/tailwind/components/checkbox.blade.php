<div class="flex items-start">
    <div class="flex h-5 items-center">
        <input
            type="checkbox"
            name="{{ $name }}"
            id="{{ $id }}"
            value="{{ $value }}"
            @checked($checked || old($name))
            @disabled($disabled)
            @required($required)
            {{ $attributes->merge(['class' => 'h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-800 dark:ring-offset-gray-800']) }}
        />
    </div>
    @if($label || $description)
        <div class="ml-3 text-sm">
            @if($label)
                <label for="{{ $id }}" class="font-medium text-gray-700 dark:text-gray-300 {{ $disabled ? 'opacity-50' : 'cursor-pointer' }}">{{ $label }}</label>
            @endif
            @if($description)
                <p class="text-gray-500 dark:text-gray-400">{{ $description }}</p>
            @endif
        </div>
    @endif
</div>
@if($error || ($name && session('errors')?->has($name)))
    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $error ?? session('errors')->first($name) }}</p>
@endif
