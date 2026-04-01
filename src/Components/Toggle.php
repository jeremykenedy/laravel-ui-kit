<?php

declare(strict_types=1);

namespace Jeremykenedy\LaravelUiKit\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Toggle extends Component
{
    public function __construct(
        public ?string $name = null,
        public ?string $id = null,
        public ?string $label = null,
        public ?string $description = null,
        public bool $checked = false,
        public bool $disabled = false,
        public string $size = 'md',
        public string $onColor = 'blue',
    ) {
        $this->id = $this->id ?? $this->name;
    }

    public function render(): View
    {
        return view('ui::components.toggle');
    }

    public function trackSize(): string
    {
        return match ($this->size) {
            'sm' => 'h-5 w-9',
            'md' => 'h-6 w-11',
            'lg' => 'h-7 w-14',
            default => 'h-6 w-11',
        };
    }

    public function thumbSize(): string
    {
        return match ($this->size) {
            'sm' => 'h-4 w-4',
            'md' => 'h-5 w-5',
            'lg' => 'h-6 w-6',
            default => 'h-5 w-5',
        };
    }

    public function thumbTranslate(): string
    {
        return match ($this->size) {
            'sm' => 'translate-x-4',
            'md' => 'translate-x-5',
            'lg' => 'translate-x-7',
            default => 'translate-x-5',
        };
    }
}
