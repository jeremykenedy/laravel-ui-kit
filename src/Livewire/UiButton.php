<?php

declare(strict_types=1);

namespace Jeremykenedy\LaravelUiKit\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class UiButton extends Component
{
    public string $variant = 'primary';

    public string $size = 'md';

    public string $type = 'button';

    public bool $loading = false;

    public bool $disabled = false;

    public ?string $href = null;

    public string $content = '';

    public function render(): View
    {
        return view('ui-kit::livewire.button');
    }
}
