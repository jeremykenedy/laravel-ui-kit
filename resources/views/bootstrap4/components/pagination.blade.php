@if($paginator && $paginator->hasPages())
    <nav class="d-flex justify-content-between align-items-center mt-3">
        @if($showInfo) <div class="text-muted small">Showing {{ $paginator->firstItem() }} to {{ $paginator->lastItem() }} of {{ $paginator->total() }} results</div> @endif
        <ul class="pagination {{ $size === 'sm' ? 'pagination-sm' : ($size === 'lg' ? 'pagination-lg' : '') }} mb-0">
            <li class="page-item {{ $paginator->onFirstPage() ? 'disabled' : '' }}"><a class="page-link" href="{{ $paginator->previousPageUrl() }}">Previous</a></li>
            @foreach($paginator->getUrlRange(1, $paginator->lastPage()) as $page => $url)
                <li class="page-item {{ $page == $paginator->currentPage() ? 'active' : '' }}"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
            @endforeach
            <li class="page-item {{ !$paginator->hasMorePages() ? 'disabled' : '' }}"><a class="page-link" href="{{ $paginator->nextPageUrl() }}">Next</a></li>
        </ul>
    </nav>
@endif
