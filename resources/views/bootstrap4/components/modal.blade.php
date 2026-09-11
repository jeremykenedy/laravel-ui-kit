<div class="modal fade" id="{{ $id }}" tabindex="-1" role="dialog" @if($title) aria-labelledby="{{ $id }}Label" @endif aria-hidden="true" @if($static) data-backdrop="static" data-keyboard="false" @endif>
    <div class="modal-dialog {{ match($size) { 'sm' => 'modal-sm', 'lg' => 'modal-lg', 'xl' => 'modal-xl', default => '' } }}" role="document">
        <div class="modal-content">
            @if($title || $closeable)
                <div class="modal-header">
                    @if($title) <h5 class="modal-title" id="{{ $id }}Label">{{ $title }}</h5> @endif
                    @if($closeable)
                        <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('ui-kit::ui-kit.modal.close') }}">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    @endif
                </div>
            @endif
            <div class="modal-body">{{ $slot }}</div>
            @if(isset($footer)) <div class="modal-footer">{{ $footer }}</div> @endif
        </div>
    </div>
</div>
