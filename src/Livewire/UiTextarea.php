<?php

declare(strict_types=1);

namespace Jeremykenedy\LaravelUiKit\Livewire;

use Livewire\Component;

class UiTextarea extends Component
{
    public ?string $name = null;
    public ?string $label = null;
    public string $value = '';
    public ?string $placeholder = null;
    public int $rows = 4;
    public ?int $maxlength = null;
    public bool $showCount = false;
    public bool $required = false;
    public ?string $error = null;

    public function render() { return view('ui-kit::livewire.textarea'); }
}
