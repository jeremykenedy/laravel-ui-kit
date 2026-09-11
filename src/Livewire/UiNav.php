<?php

declare(strict_types=1);

namespace Jeremykenedy\LaravelUiKit\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class UiNav extends Component
{
    public string $brand = '';

    public ?string $brandUrl = '/';

    public array $links = [];

    public bool $mobileOpen = false;

    public function toggleMobile(): void
    {
        $this->mobileOpen = !$this->mobileOpen;
    }

    public function render(): View
    {
        return view('ui-kit::livewire.nav');
    }
}
