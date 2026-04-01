<?php

declare(strict_types=1);

namespace Jeremykenedy\LaravelUiKit\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormGroup extends Component
{
    public function __construct(
        public ?string $name = null,
        public ?string $label = null,
        public ?string $hint = null,
        public ?string $error = null,
        public bool $required = false,
        public bool $inline = false,
    ) {}

    public function render(): View
    {
        return view('ui::components.form-group');
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
