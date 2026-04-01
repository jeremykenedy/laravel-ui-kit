<?php

declare(strict_types=1);

namespace Jeremykenedy\LaravelUiKit\Livewire;

use Livewire\Component;

class UiStatusPanel extends Component
{
    public string $message = '';
    public string $variant = 'info';
    public ?string $icon = null;

    public function render() { return view('ui-kit::livewire.status-panel'); }
}
