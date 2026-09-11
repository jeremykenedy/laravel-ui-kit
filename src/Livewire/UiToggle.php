<?php

declare(strict_types=1);

namespace Jeremykenedy\LaravelUiKit\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class UiToggle extends Component
{
    public bool $checked = false;

    public ?string $label = null;

    public ?string $name = null;

    public bool $disabled = false;

    public function toggle(): void
    {
        if (!$this->disabled) {
            $this->checked = !$this->checked;
            $this->dispatch('toggled', checked: $this->checked, name: $this->name);
        }
    }

    public function render(): View
    {
        return view('ui-kit::livewire.toggle');
    }
}
