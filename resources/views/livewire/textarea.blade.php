<div>
    @if($label)<label for="{{ $name }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">{{ $label }}@if($required)<span class="text-red-500"> *</span>@endif</label>@endif
    <textarea id="{{ $name }}" wire:model="{{ $name }}" rows="{{ $rows }}" placeholder="{{ $placeholder }}" @if($maxlength) maxlength="{{ $maxlength }}" @endif @if($required) required @endif class="block w-full rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-800 p-2.5 text-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
    @if($showCount && $maxlength)<p class="mt-1 text-xs text-gray-400">{{ strlen($value) }}/{{ $maxlength }}</p>@endif
    @if($error)<p class="mt-1 text-sm text-red-600">{{ $error }}</p>@endif
</div>
