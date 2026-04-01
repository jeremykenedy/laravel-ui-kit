<?php

declare(strict_types=1);

namespace Jeremykenedy\LaravelUiKit\Livewire;

use Livewire\Component;

class UiDropdown extends Component
{
    public bool $open = false;

    public string $align = 'right';

    public function toggle(): void
    {
        $this->open = ! $this->open;
    }

    public function close(): void
    {
        $this->open = false;
    }

    public function render()
    {
        return view('ui-kit::livewire.dropdown');
    }
}
