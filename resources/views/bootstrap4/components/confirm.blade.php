<div class="modal fade" id="{{ $id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $title }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body"><p>{{ $message }}</p></div>
            <div class="modal-footer">
                <x-ui::button variant="secondary" type="button" data-dismiss="modal">{{ $cancelText }}</x-ui::button>
                <x-ui::button :variant="$variant" type="button" id="{{ $id }}Confirm">{{ $confirmText }}</x-ui::button>
            </div>
        </div>
    </div>
</div>
<script>
$(function(){
    var m=$('#{{ $id }}');
    m.on('show.bs.modal',function(e){
        var t=$(e.relatedTarget);
        if(t.length){
            var title=t.data('title'),msg=t.data('message'),form=t.closest('form');
            if(title)m.find('.modal-title').text(title);
            if(msg)m.find('.modal-body p').text(msg);
            m.find('#{{ $id }}Confirm').off('click').on('click',function(){form.submit();});
        }
    });
});
</script>
