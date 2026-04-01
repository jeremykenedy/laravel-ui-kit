<?php

declare(strict_types=1);

namespace Jeremykenedy\LaravelUiKit\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Confirm extends Component
{
    public function __construct(
        public string $id = 'confirmModal',
        public ?string $title = null,
        public ?string $message = null,
        public ?string $confirmText = null,
        public ?string $cancelText = null,
        public string $variant = 'primary',
        public ?string $formId = null,
    ) {
        $defaults = config('ui-kit.confirm', []);
        $this->title = $this->title ?? ($defaults['default_title'] ?? 'Confirm Action');
        $this->message = $this->message ?? ($defaults['default_message'] ?? 'Are you sure you want to proceed?');
        $this->confirmText = $this->confirmText ?? ($defaults['confirm_text'] ?? 'Confirm');
        $this->cancelText = $this->cancelText ?? ($defaults['cancel_text'] ?? 'Cancel');
    }

    public function render(): View
    {
        return view('ui::components.confirm');
    }
}
