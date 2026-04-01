@if($visible)
@php $cls = match($variant) { 'success' => 'bg-green-50 text-green-800 border-green-200 dark:bg-green-900/20 dark:text-green-300 dark:border-green-800', 'danger', 'error' => 'bg-red-50 text-red-800 border-red-200 dark:bg-red-900/20 dark:text-red-300 dark:border-red-800', 'warning' => 'bg-amber-50 text-amber-800 border-amber-200 dark:bg-amber-900/20 dark:text-amber-300 dark:border-amber-800', default => 'bg-blue-50 text-blue-800 border-blue-200 dark:bg-blue-900/20 dark:text-blue-300 dark:border-blue-800' }; @endphp
<div class="rounded-lg border p-4 {{ $cls }}" role="alert">
    <div class="flex items-start">
        <div class="flex-1">
            @if($title)<h3 class="text-sm font-medium">{{ $title }}</h3>@endif
            <div class="{{ $title ? 'mt-1 text-sm opacity-90' : 'text-sm' }}">{{ $slot }}</div>
        </div>
        @if($dismissible)<button wire:click="dismiss" class="ml-3 opacity-60 hover:opacity-100">&times;</button>@endif
    </div>
</div>
@endif
