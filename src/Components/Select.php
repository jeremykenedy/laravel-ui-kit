<?php

declare(strict_types=1);

namespace Jeremykenedy\LaravelUiKit\Components;

use Illuminate\View\Component;

class Select extends Component
{
    public function __construct(
        public ?string $name = null,
        public ?string $id = null,
        public ?string $label = null,
        public array $options = [],
        public ?string $selected = null,
        public ?string $placeholder = null,
        public bool $required = false,
        public bool $disabled = false,
        public bool $multiple = false,
        public ?string $icon = null,
        public ?string $error = null,
    ) {
        $this->id = $this->id ?? $this->name;
    }

    public function render(): \Illuminate\Contracts\View\View
    {
        return view('ui::components.select');
    }

    public function hasError(): bool
    {
        return $this->error !== null || ($this->name && session('errors')?->has($this->name));
    }

    public function errorMessage(): ?string
    {
        if ($this->error) {
            return $this->error;
        }

        return $this->name ? session('errors')?->first($this->name) : null;
    }
}
