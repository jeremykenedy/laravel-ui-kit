<div class="mb-4">
    @if($label)<label @if($for) for="{{ $for }}" @endif class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">{{ $label }}@if($required)<span class="text-red-500"> *</span>@endif</label>@endif
    {{ $slot }}
    @if($error)<p class="mt-1 text-sm text-red-600">{{ $error }}</p>@elseif($hint)<p class="mt-1 text-sm text-gray-500">{{ $hint }}</p>@endif
</div>
