<?php

declare(strict_types=1);

namespace Jeremykenedy\LaravelUiKit\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class StatCard extends Component
{
    public function __construct(
        public string $value = '0',
        public string $label = '',
        public string $variant = 'default',
        public ?string $icon = null,
        public ?string $href = null,
        public ?string $change = null,
        public bool $changeUp = true,
    ) {
    }

    public function render(): View
    {
        return view('ui::components.stat-card');
    }

    public function variantColor(): string
    {
        return match ($this->variant) {
            'primary' => 'text-blue-600 dark:text-blue-400',
            'success' => 'text-green-600 dark:text-green-400',
            'warning' => 'text-amber-600 dark:text-amber-400',
            'danger'  => 'text-red-600 dark:text-red-400',
            'info'    => 'text-cyan-600 dark:text-cyan-400',
            default   => 'text-gray-900 dark:text-gray-100',
        };
    }
}
