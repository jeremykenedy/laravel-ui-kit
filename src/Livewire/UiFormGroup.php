<?php

declare(strict_types=1);

namespace Jeremykenedy\LaravelUiKit\Livewire;

use Livewire\Component;

class UiFormGroup extends Component
{
    public ?string $label = null;

    public ?string $for = null;

    public ?string $hint = null;

    public ?string $error = null;

    public bool $required = false;

    public function render()
    {
        return view('ui-kit::livewire.form-group');
    }
}
