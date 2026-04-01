<?php

declare(strict_types=1);

namespace Jeremykenedy\LaravelUiKit\Livewire;

use Livewire\Component;

class UiInput extends Component
{
    public string $type = 'text';

    public ?string $name = null;

    public ?string $label = null;

    public ?string $placeholder = null;

    public ?string $hint = null;

    public ?string $error = null;

    public string $value = '';

    public bool $required = false;

    public bool $disabled = false;

    public ?string $autocomplete = null;

    public function render()
    {
        return view('ui-kit::livewire.input');
    }
}
