<?php

declare(strict_types=1);

namespace Jeremykenedy\LaravelUiKit\Livewire;

use Livewire\Component;

class UiStatCard extends Component
{
    public string $value = '0';

    public string $label = '';

    public string $variant = 'default';

    public ?string $icon = null;

    public ?string $href = null;

    public function render()
    {
        return view('ui-kit::livewire.stat-card');
    }
}
