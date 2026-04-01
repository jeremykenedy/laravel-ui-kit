<?php

declare(strict_types=1);

namespace Jeremykenedy\LaravelUiKit\Livewire;

use Livewire\Component;

class UiNav extends Component
{
    public string $brand = '';

    public ?string $brandUrl = '/';

    public bool $mobileOpen = false;

    public function toggleMobile(): void
    {
        $this->mobileOpen = !$this->mobileOpen;
    }

    public function render()
    {
        return view('ui-kit::livewire.nav');
    }
}
