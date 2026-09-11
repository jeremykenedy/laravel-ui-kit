<div class="modal fade" id="{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="{{ $id }}Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="{{ $id }}Label">{{ $title }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('ui-kit::ui-kit.modal.close') }}">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"><p class="mb-0" data-confirm-message>{{ $message }}</p></div>
            <div class="modal-footer">
                <x-ui::button variant="secondary" type="button" data-dismiss="modal">{{ $cancelText }}</x-ui::button>
                <x-ui::button :variant="$variant" type="button" id="{{ $id }}Confirm">{{ $confirmText }}</x-ui::button>
            </div>
        </div>
    </div>
</div>
<script>
$(function () {
    var modal = $('#{{ $id }}');

    modal.on('show.bs.modal', function (event) {
        var trigger = $(event.relatedTarget);
        if (!trigger.length) {
            return;
        }

        var title = trigger.data('confirm-title');
        var message = trigger.data('confirm-message');
        var formId = trigger.data('confirm-form');
        var form = formId ? $('#' + formId) : trigger.closest('form');

        if (title) {
            modal.find('.modal-title').text(title);
        }

        if (message) {
            modal.find('[data-confirm-message]').text(message);
        }

        modal.find('#{{ $id }}Confirm').off('click').on('click', function () {
            if (form.length && form.is('form')) {
                form.submit();
            } else {
                modal.trigger('confirmed', [{ formId: formId }]);
            }
        });
    });
});
</script>
