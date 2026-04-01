<?php

declare(strict_types=1);

namespace Jeremykenedy\LaravelUiKit\Livewire;

use Livewire\Component;

class UiButton extends Component
{
    public string $variant = 'primary';
    public string $size = 'md';
    public string $type = 'button';
    public bool $loading = false;
    public bool $disabled = false;
    public ?string $href = null;

    public function render()
    {
        return view('ui-kit::livewire.button');
    }
}
