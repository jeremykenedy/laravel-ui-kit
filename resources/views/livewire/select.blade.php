<div>
    @if($label)<label for="{{ $name }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">{{ $label }}@if($required)<span class="text-red-500"> *</span>@endif</label>@endif
    <select id="{{ $name }}" wire:model="{{ $name }}" @if($required) required @endif @if($disabled) disabled @endif class="block w-full rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-800 p-2.5 text-sm focus:border-blue-500 focus:ring-blue-500">
        @if($placeholder)<option value="">{{ $placeholder }}</option>@endif
        @foreach($options as $k=>$v)<option value="{{ $k }}">{{ $v }}</option>@endforeach
    </select>
    @if($error)<p class="mt-1 text-sm text-red-600">{{ $error }}</p>@endif
</div>
