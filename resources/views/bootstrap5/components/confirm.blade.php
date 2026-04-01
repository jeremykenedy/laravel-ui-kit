<div class="modal fade" id="{{ $id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>{{ $message }}</p>
            </div>
            <div class="modal-footer">
                <x-ui::button variant="secondary" type="button" data-bs-dismiss="modal">{{ $cancelText }}</x-ui::button>
                <x-ui::button :variant="$variant" type="button" id="{{ $id }}Confirm">{{ $confirmText }}</x-ui::button>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('{{ $id }}');
    if (modal) {
        modal.addEventListener('show.bs.modal', function(e) {
            const trigger = e.relatedTarget;
            if (trigger) {
                const title = trigger.getAttribute('data-confirm-title');
                const message = trigger.getAttribute('data-confirm-message');
                const formId = trigger.getAttribute('data-confirm-form');
                if (title) modal.querySelector('.modal-title').textContent = title;
                if (message) modal.querySelector('.modal-body p').textContent = message;
                const confirmBtn = modal.querySelector('#{{ $id }}Confirm');
                if (confirmBtn && formId) {
                    confirmBtn.onclick = function() { document.getElementById(formId).submit(); };
                }
            }
        });
    }
});
</script>
