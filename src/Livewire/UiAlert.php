<?php

declare(strict_types=1);

namespace Jeremykenedy\LaravelUiKit\Livewire;

use Livewire\Component;

class UiAlert extends Component
{
    public string $variant = 'info';

    public bool $dismissible = true;

    public ?string $title = null;

    public bool $visible = true;

    public function dismiss(): void
    {
        $this->visible = false;
    }

    public function render()
    {
        return view('ui-kit::livewire.alert');
    }
}
