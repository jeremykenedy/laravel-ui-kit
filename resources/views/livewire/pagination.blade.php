@if($lastPage > 1)
<nav class="flex items-center justify-between">
    <p class="text-sm text-gray-700 dark:text-gray-400">Showing {{ ($currentPage-1)*$perPage+1 }} to {{ min($currentPage*$perPage, $total) }} of {{ $total }}</p>
    <div class="flex gap-1">
        <button wire:click="goToPage({{ $currentPage-1 }})" @if($currentPage<=1) disabled @endif class="px-3 py-1 text-sm rounded border {{ $currentPage<=1 ? 'opacity-50 cursor-not-allowed' : 'hover:bg-gray-50' }}">Prev</button>
        @for($i=max(1,$currentPage-2);$i<=min($lastPage,$currentPage+2);$i++)
            <button wire:click="goToPage({{ $i }})" class="px-3 py-1 text-sm rounded border {{ $i===$currentPage ? 'bg-blue-600 text-white border-blue-600' : 'hover:bg-gray-50' }}">{{ $i }}</button>
        @endfor
        <button wire:click="goToPage({{ $currentPage+1 }})" @if($currentPage>=$lastPage) disabled @endif class="px-3 py-1 text-sm rounded border {{ $currentPage>=$lastPage ? 'opacity-50 cursor-not-allowed' : 'hover:bg-gray-50' }}">Next</button>
    </div>
</nav>
@endif
