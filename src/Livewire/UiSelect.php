<?php

declare(strict_types=1);

namespace Jeremykenedy\LaravelUiKit\Livewire;

use Livewire\Component;

class UiSelect extends Component
{
    public ?string $name = null;
    public ?string $label = null;
    public array $options = [];
    public string $value = '';
    public ?string $placeholder = null;
    public bool $required = false;
    public bool $disabled = false;
    public ?string $error = null;

    public function render() { return view('ui-kit::livewire.select'); }
}
