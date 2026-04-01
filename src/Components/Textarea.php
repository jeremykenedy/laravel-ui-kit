<?php

declare(strict_types=1);

namespace Jeremykenedy\LaravelUiKit\Components;

use Illuminate\View\Component;

class Textarea extends Component
{
    public function __construct(
        public ?string $name = null,
        public ?string $id = null,
        public ?string $label = null,
        public ?string $placeholder = null,
        public ?string $value = null,
        public int $rows = 4,
        public bool $required = false,
        public bool $disabled = false,
        public ?int $maxlength = null,
        public bool $showCount = false,
        public ?string $error = null,
    ) {
        $this->id = $this->id ?? $this->name;
    }

    public function render(): \Illuminate\Contracts\View\View
    {
        return view('ui::components.textarea');
    }

    public function hasError(): bool
    {
        return $this->error !== null || ($this->name && session('errors')?->has($this->name));
    }

    public function errorMessage(): ?string
    {
        return $this->error ?? ($this->name ? session('errors')?->first($this->name) : null);
    }
}
