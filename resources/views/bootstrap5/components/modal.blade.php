<div class="modal fade" id="{{ $id }}" tabindex="-1" aria-labelledby="{{ $id }}Label" aria-hidden="true" @if($static) data-bs-backdrop="static" @endif>
    <div class="modal-dialog {{ match($size) { 'sm' => 'modal-sm', 'lg' => 'modal-lg', 'xl' => 'modal-xl', 'full' => 'modal-fullscreen', default => '' } }}">
        <div class="modal-content">
            @if($title || $closeable)
                <div class="modal-header">
                    @if($title)
                        <h5 class="modal-title" id="{{ $id }}Label">{{ $title }}</h5>
                    @endif
                    @if($closeable)
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    @endif
                </div>
            @endif
            <div class="modal-body">
                {{ $slot }}
            </div>
            @if(isset($footer))
                <div class="modal-footer">
                    {{ $footer }}
                </div>
            @endif
        </div>
    </div>
</div>
