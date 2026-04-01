<div class="flex items-start">
    <div class="flex items-center h-5">
        <input type="checkbox" id="{{ $name }}" wire:model="{{ $name }}" @if($disabled) disabled @endif class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-800" {{ $checked ? 'checked' : '' }} />
    </div>
    @if($label)<div class="ml-3 text-sm"><label for="{{ $name }}" class="font-medium text-gray-700 dark:text-gray-300">{{ $label }}</label>@if($description)<p class="text-gray-500">{{ $description }}</p>@endif</div>@endif
</div>
