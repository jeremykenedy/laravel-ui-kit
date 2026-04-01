<?php

declare(strict_types=1);

namespace Jeremykenedy\LaravelUiKit\Components;

use Illuminate\View\Component;

class Input extends Component
{
    public function __construct(
        public string $type = 'text',
        public ?string $name = null,
        public ?string $id = null,
        public ?string $label = null,
        public ?string $placeholder = null,
        public ?string $icon = null,
        public ?string $iconPosition = 'right',
        public ?string $hint = null,
        public ?string $value = null,
        public bool $required = false,
        public bool $disabled = false,
        public bool $readonly = false,
        public ?string $autocomplete = null,
        public ?string $error = null,
    ) {
        $this->id = $this->id ?? $this->name;
    }

    public function render(): \Illuminate\Contracts\View\View
    {
        return view('ui::components.input');
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

    public function inputClasses(): string
    {
        $base = 'block w-full rounded-lg border px-4 py-2.5 transition-colors duration-150 focus:outline-none focus:ring-2 focus:ring-offset-0 sm:text-sm dark:bg-gray-800';

        if ($this->hasError()) {
            return $base . ' border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:ring-red-500 dark:border-red-600 dark:text-red-300';
        }

        return $base . ' border-gray-300 text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:text-gray-100';
    }
}
