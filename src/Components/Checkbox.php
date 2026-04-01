<?php

declare(strict_types=1);

namespace Jeremykenedy\LaravelUiKit\Components;

use Illuminate\View\Component;

class Checkbox extends Component
{
    public function __construct(
        public ?string $name = null,
        public ?string $id = null,
        public ?string $label = null,
        public ?string $description = null,
        public bool $checked = false,
        public bool $disabled = false,
        public bool $required = false,
        public ?string $value = '1',
        public ?string $error = null,
    ) {
        $this->id = $this->id ?? $this->name;
    }

    public function render(): \Illuminate\Contracts\View\View
    {
        return view('ui::components.checkbox');
    }
}
