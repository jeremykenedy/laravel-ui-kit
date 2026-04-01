<?php

declare(strict_types=1);

namespace Jeremykenedy\LaravelUiKit\Livewire;

use Livewire\Component;

class UiBadge extends Component
{
    public string $variant = 'primary';
    public string $size = 'md';
    public bool $rounded = false;
    public bool $dot = false;

    public function render() { return view('ui-kit::livewire.badge'); }
}
