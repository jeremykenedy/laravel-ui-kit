<?php

declare(strict_types=1);

namespace Jeremykenedy\LaravelUiKit\Livewire;

use Livewire\Component;

class UiCheckbox extends Component
{
    public ?string $name = null;
    public ?string $label = null;
    public ?string $description = null;
    public bool $checked = false;
    public bool $disabled = false;

    public function render()
    {
        return view('ui-kit::livewire.checkbox');
    }
}
