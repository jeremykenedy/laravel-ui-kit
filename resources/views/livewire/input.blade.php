<div>
    @if($label)<label for="{{ $name }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">{{ $label }}@if($required)<span class="text-red-500"> *</span>@endif</label>@endif
    <input type="{{ $type }}" id="{{ $name }}" wire:model="{{ $name }}" placeholder="{{ $placeholder }}" @if($required) required @endif @if($disabled) disabled @endif @if($autocomplete) autocomplete="{{ $autocomplete }}" @endif
        class="block w-full rounded-lg border p-2.5 text-sm transition-colors focus:outline-none focus:ring-2 dark:bg-gray-800 {{ $error ? 'border-red-300 focus:border-red-500 focus:ring-red-500' : 'border-gray-300 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600' }}" />
    @if($error)<p class="mt-1 text-sm text-red-600">{{ $error }}</p>@elseif($hint)<p class="mt-1 text-sm text-gray-500">{{ $hint }}</p>@endif
</div>
