<?php

declare(strict_types=1);

namespace Jeremykenedy\LaravelUiKit\Components;

use Illuminate\View\Component;

class Badge extends Component
{
    public function __construct(
        public string $variant = 'primary',
        public string $size = 'md',
        public bool $rounded = false,
        public bool $dot = false,
        public ?string $icon = null,
    ) {}

    public function render(): \Illuminate\Contracts\View\View
    {
        return view('ui::components.badge');
    }

    public function variantClasses(): string
    {
        return match ($this->variant) {
            'primary' => 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300',
            'secondary' => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300',
            'success' => 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300',
            'danger' => 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300',
            'warning' => 'bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-300',
            'info' => 'bg-cyan-100 text-cyan-800 dark:bg-cyan-900/30 dark:text-cyan-300',
            default => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300',
        };
    }

    public function sizeClasses(): string
    {
        return match ($this->size) {
            'sm' => 'px-2 py-0.5 text-xs',
            'md' => 'px-2.5 py-0.5 text-xs',
            'lg' => 'px-3 py-1 text-sm',
            default => 'px-2.5 py-0.5 text-xs',
        };
    }
}
