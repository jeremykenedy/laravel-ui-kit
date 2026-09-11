<?php

declare(strict_types=1);

namespace Jeremykenedy\LaravelUiKit\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class UiAvatar extends Component
{
    public ?string $src = null;

    public string $alt = '';

    public string $size = 'md';

    public ?string $status = null;

    public function render(): View
    {
        return view('ui-kit::livewire.avatar');
    }
}
