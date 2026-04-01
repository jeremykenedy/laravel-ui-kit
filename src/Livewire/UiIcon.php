<?php

declare(strict_types=1);

namespace Jeremykenedy\LaravelUiKit\Livewire;

use Livewire\Component;

class UiIcon extends Component
{
    public string $name;

    public string $size = 'md';

    public function render()
    {
        return view('ui-kit::livewire.icon');
    }
}
