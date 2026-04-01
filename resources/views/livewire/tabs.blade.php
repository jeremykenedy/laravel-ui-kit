<div>
    <div class="border-b border-gray-200 dark:border-gray-700"><nav class="-mb-px flex space-x-8">
        @foreach($tabs as $tab)<button wire:click="selectTab('{{ $tab }}')" type="button" class="whitespace-nowrap border-b-2 py-4 px-1 text-sm font-medium {{ $activeTab===$tab ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }}">{{ $tab }}</button>@endforeach
    </nav></div>
    <div class="mt-4">{{ $slot }}</div>
</div>
