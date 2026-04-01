<?php

declare(strict_types=1);

namespace Jeremykenedy\LaravelUiKit\Livewire;

use Livewire\Component;

class UiCard extends Component
{
    public ?string $title = null;

    public ?string $subtitle = null;

    public bool $bordered = true;

    public function render()
    {
        return view('ui-kit::livewire.card');
    }
}
