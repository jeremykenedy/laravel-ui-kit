<?php

declare(strict_types=1);

namespace Jeremykenedy\LaravelUiKit\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class UiStatusPanel extends Component
{
    public string $message = '';

    public string $variant = 'info';

    public ?string $icon = null;

    public string $content = '';

    public function render(): View
    {
        return view('ui-kit::livewire.status-panel');
    }
}
