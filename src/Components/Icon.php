<?php

declare(strict_types=1);

namespace Jeremykenedy\LaravelUiKit\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Icon extends Component
{
    public function __construct(
        public string $name,
        public string $size = 'md',
        public ?string $class = null,
    ) {
    }

    public function render(): View
    {
        return view('ui::components.icon');
    }

    public function sizeClasses(): string
    {
        return match ($this->size) {
            'xs'    => 'w-3 h-3',
            'sm'    => 'w-4 h-4',
            'md'    => 'w-5 h-5',
            'lg'    => 'w-6 h-6',
            'xl'    => 'w-8 h-8',
            default => 'w-5 h-5',
        };
    }

    public function iconSet(): string
    {
        return config('ui-kit.icons', 'lucide');
    }

    public function resolvedClass(): string
    {
        $iconSet = $this->iconSet();

        return match ($iconSet) {
            'fontawesome' => 'fa fa-'.$this->name,
            'heroicons'   => 'hero-'.$this->name,
            default       => 'lucide-'.$this->name,
        };
    }
}
