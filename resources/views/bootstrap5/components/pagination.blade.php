@if($paginator && $paginator->hasPages())
    <nav class="d-flex justify-content-between align-items-center" aria-label="{{ __('ui-kit::ui-kit.pagination.previous') }} / {{ __('ui-kit::ui-kit.pagination.next') }}">
        @if($showInfo)
            <div class="text-muted small">
                {{ __('ui-kit::ui-kit.pagination.showing') }} {{ $paginator->firstItem() }}
                {{ __('ui-kit::ui-kit.pagination.to') }} {{ $paginator->lastItem() }}
                {{ __('ui-kit::ui-kit.pagination.of') }} {{ $paginator->total() }} {{ __('ui-kit::ui-kit.pagination.results') }}
            </div>
        @endif
        <ul class="pagination {{ $size === 'sm' ? 'pagination-sm' : ($size === 'lg' ? 'pagination-lg' : '') }} mb-0">
            @if($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link">{{ __('ui-kit::ui-kit.pagination.previous') }}</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">{{ __('ui-kit::ui-kit.pagination.previous') }}</a>
                </li>
            @endif

            @unless($simple)
                @foreach($paginator->getUrlRange(1, $paginator->lastPage()) as $page => $url)
                    @if($page == $paginator->currentPage())
                        <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endunless

            @if($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">{{ __('ui-kit::ui-kit.pagination.next') }}</a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link">{{ __('ui-kit::ui-kit.pagination.next') }}</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
