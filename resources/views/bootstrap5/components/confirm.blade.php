<div class="modal fade" id="{{ $id }}" tabindex="-1" aria-labelledby="{{ $id }}Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="{{ $id }}Label">{{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('ui-kit::ui-kit.modal.close') }}"></button>
            </div>
            <div class="modal-body">
                <p class="mb-0" data-confirm-message>{{ $message }}</p>
            </div>
            <div class="modal-footer">
                <x-ui::button variant="secondary" type="button" data-bs-dismiss="modal">{{ $cancelText }}</x-ui::button>
                <x-ui::button :variant="$variant" type="button" id="{{ $id }}Confirm">{{ $confirmText }}</x-ui::button>
            </div>
        </div>
    </div>
</div>
@once
<script>
document.addEventListener('show.bs.modal', function (event) {
    var modal = event.target;
    if (!modal.classList.contains('modal') || !modal.querySelector('[data-confirm-message]')) {
        return;
    }

    var trigger = event.relatedTarget;
    if (!trigger) {
        return;
    }

    var title = trigger.getAttribute('data-confirm-title');
    var message = trigger.getAttribute('data-confirm-message');
    var formId = trigger.getAttribute('data-confirm-form');
    var titleEl = modal.querySelector('.modal-title');
    var messageEl = modal.querySelector('[data-confirm-message]');
    var confirmBtn = modal.querySelector('#' + modal.id + 'Confirm');

    if (title && titleEl) { titleEl.textContent = title; }
    if (message && messageEl) { messageEl.textContent = message; }

    if (confirmBtn) {
        confirmBtn.onclick = function () {
            var form = formId ? document.getElementById(formId) : null;
            if (form && form.tagName === 'FORM') {
                form.submit();
            } else {
                modal.dispatchEvent(new CustomEvent('confirmed', { bubbles: true, detail: { formId: formId } }));
            }
        };
    }
});
</script>
@endonce
