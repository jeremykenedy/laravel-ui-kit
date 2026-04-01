<?php

declare(strict_types=1);

namespace Jeremykenedy\LaravelUiKit\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Card extends Component
{
    public function __construct(
        public ?string $title = null,
        public ?string $subtitle = null,
        public ?string $footer = null,
        public ?string $variant = null,
        public bool $hoverable = false,
        public bool $bordered = true,
        public ?string $padding = 'md',
    ) {}

    public function render(): View
    {
        return view('ui::components.card');
    }

    public function paddingClasses(): string
    {
        return match ($this->padding) {
            'none' => '',
            'sm' => 'p-3',
            'md' => 'p-4 sm:p-6',
            'lg' => 'p-6 sm:p-8',
            default => 'p-4 sm:p-6',
        };
    }
}
