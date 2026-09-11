<?php

declare(strict_types=1);

namespace Jeremykenedy\LaravelUiKit\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class UiIcon extends Component
{
    public string $name = 'info';

    public string $size = 'md';

    public function render(): View
    {
        return view('ui-kit::livewire.icon');
    }
}
