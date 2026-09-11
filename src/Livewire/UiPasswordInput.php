<?php

declare(strict_types=1);

namespace Jeremykenedy\LaravelUiKit\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class UiPasswordInput extends Component
{
    public ?string $name = 'password';

    public ?string $label = null;

    public bool $required = false;

    public string $value = '';

    public bool $showPassword = false;

    public bool $strengthMeter = true;

    public ?string $error = null;

    public ?string $autocomplete = 'new-password';

    public function toggleVisibility(): void
    {
        $this->showPassword = !$this->showPassword;
    }

    public function render(): View
    {
        return view('ui-kit::livewire.password-input');
    }
}
