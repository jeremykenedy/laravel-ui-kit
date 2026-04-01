<?php

declare(strict_types=1);

namespace Jeremykenedy\LaravelUiKit\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Modal extends Component
{
    public function __construct(
        public string $id = 'modal',
        public ?string $title = null,
        public string $size = 'md',
        public bool $closeable = true,
        public bool $static = false,
        public ?string $variant = null,
    ) {}

    public function render(): View
    {
        return view('ui::components.modal');
    }

    public function sizeClasses(): string
    {
        return match ($this->size) {
            'sm' => 'sm:max-w-sm',
            'md' => 'sm:max-w-lg',
            'lg' => 'sm:max-w-2xl',
            'xl' => 'sm:max-w-4xl',
            'full' => 'sm:max-w-full sm:mx-4',
            default => 'sm:max-w-lg',
        };
    }
}
