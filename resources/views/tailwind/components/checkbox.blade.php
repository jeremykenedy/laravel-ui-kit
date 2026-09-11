@php
    $describedBy = collect([
        $description ? $id . '-description' : null,
        ($error || ($name && session('errors')?->has($name))) ? $id . '-error' : null,
    ])->filter()->implode(' ');
@endphp
<div>
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
                @if($describedBy) aria-describedby="{{ $describedBy }}" @endif
                @if($error || ($name && session('errors')?->has($name))) aria-invalid="true" @endif
                {{ $attributes->merge(['class' => 'h-4 w-4 cursor-pointer rounded border-gray-300 text-blue-600 focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2 disabled:cursor-not-allowed dark:border-gray-600 dark:bg-gray-800 dark:ring-offset-gray-800']) }}
            />
        </div>
        @if($label || $description)
            <div class="ml-3 text-sm">
                @if($label)
                    <label for="{{ $id }}" class="font-medium text-gray-700 dark:text-gray-300 {{ $disabled ? 'opacity-50' : 'cursor-pointer' }}">
                        {{ $label }}
                        @if($required)
                            <span class="text-red-500" aria-hidden="true">*</span>
                        @endif
                    </label>
                @endif
                @if($description)
                    <p id="{{ $id }}-description" class="text-gray-500 dark:text-gray-400">{{ $description }}</p>
                @endif
            </div>
        @endif
    </div>
    @if($error || ($name && session('errors')?->has($name)))
        <p id="{{ $id }}-error" class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $error ?? session('errors')->first($name) }}</p>
    @endif
</div>
