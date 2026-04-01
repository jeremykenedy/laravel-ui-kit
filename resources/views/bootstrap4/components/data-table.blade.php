<div {{ $attributes->merge(['id' => $id]) }}>
    @if($searchable) <div class="mb-3"><x-ui::search-input :placeholder="$searchPlaceholder" /></div> @endif
    <div class="table-responsive">
        <table class="table {{ $striped ? 'table-striped' : '' }} {{ $hoverable ? 'table-hover' : '' }} {{ $bordered ? 'table-bordered' : '' }} {{ $compact ? 'table-sm' : '' }}">
            @if(count($headers) > 0)
                <thead><tr>@foreach($headers as $header)<th>{{ is_array($header) ? ($header['label'] ?? $header) : $header }}</th>@endforeach</tr></thead>
            @endif
            <tbody>
                {{ $slot }}
                @if(isset($rows) && method_exists($rows, 'isEmpty') && $rows->isEmpty())
                    <tr><td colspan="{{ count($headers) }}" class="text-center text-muted py-4">{{ $emptyMessage }}</td></tr>
                @endif
            </tbody>
        </table>
    </div>
    @if(isset($rows) && method_exists($rows, 'hasPages') && $rows->hasPages()) <x-ui::pagination :paginator="$rows" /> @endif
</div>
