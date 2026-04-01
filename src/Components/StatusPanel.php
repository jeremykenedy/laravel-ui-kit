<?php

declare(strict_types=1);

namespace Jeremykenedy\LaravelUiKit\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class StatusPanel extends Component
{
    public function __construct(
        public string $variant = 'info',
        public ?string $title = null,
        public ?string $message = null,
        public ?string $icon = null,
        public bool $centered = true,
    ) {}

    public function render(): View
    {
        return view('ui::components.status-panel');
    }

    public function variantClasses(): string
    {
        return match ($this->variant) {
            'success' => 'text-green-600 dark:text-green-400',
            'danger', 'error' => 'text-red-600 dark:text-red-400',
            'warning' => 'text-amber-600 dark:text-amber-400',
            'info' => 'text-blue-600 dark:text-blue-400',
            default => 'text-gray-600 dark:text-gray-400',
        };
    }
}
