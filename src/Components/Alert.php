<?php

declare(strict_types=1);

namespace Jeremykenedy\LaravelUiKit\Components;

use Illuminate\View\Component;

class Alert extends Component
{
    public function __construct(
        public string $variant = 'info',
        public bool $dismissible = true,
        public ?string $icon = null,
        public ?string $title = null,
    ) {
    }

    public function render(): \Illuminate\Contracts\View\View
    {
        return view('ui::components.alert');
    }

    public function variantClasses(): string
    {
        return match ($this->variant) {
            'success' => 'bg-green-50 text-green-800 border-green-200 dark:bg-green-900/20 dark:text-green-300 dark:border-green-800',
            'danger', 'error' => 'bg-red-50 text-red-800 border-red-200 dark:bg-red-900/20 dark:text-red-300 dark:border-red-800',
            'warning' => 'bg-amber-50 text-amber-800 border-amber-200 dark:bg-amber-900/20 dark:text-amber-300 dark:border-amber-800',
            'info'    => 'bg-blue-50 text-blue-800 border-blue-200 dark:bg-blue-900/20 dark:text-blue-300 dark:border-blue-800',
            default   => 'bg-gray-50 text-gray-800 border-gray-200 dark:bg-gray-900/20 dark:text-gray-300 dark:border-gray-800',
        };
    }
}
