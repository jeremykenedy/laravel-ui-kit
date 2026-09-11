<?php

declare(strict_types=1);

namespace Jeremykenedy\LaravelUiKit\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class UiBadge extends Component
{
    public string $variant = 'primary';

    public string $size = 'md';

    public bool $rounded = false;

    public bool $dot = false;

    public string $content = '';

    public function render(): View
    {
        return view('ui-kit::livewire.badge');
    }
}
