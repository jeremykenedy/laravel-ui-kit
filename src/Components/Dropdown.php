<?php

declare(strict_types=1);

namespace Jeremykenedy\LaravelUiKit\Components;

use Illuminate\View\Component;

class Dropdown extends Component
{
    public function __construct(
        public ?string $label = null,
        public string $align = 'right',
        public string $width = '48',
        public ?string $id = null,
        public bool $divided = false,
    ) {
    }

    public function render(): \Illuminate\Contracts\View\View
    {
        return view('ui::components.dropdown');
    }

    public function alignClasses(): string
    {
        return match ($this->align) {
            'left'   => 'origin-top-left left-0',
            'right'  => 'origin-top-right right-0',
            'center' => 'origin-top left-1/2 -translate-x-1/2',
            default  => 'origin-top-right right-0',
        };
    }

    public function widthClasses(): string
    {
        return match ($this->width) {
            '48'    => 'w-48',
            '56'    => 'w-56',
            '64'    => 'w-64',
            '72'    => 'w-72',
            'full'  => 'w-full',
            default => 'w-48',
        };
    }
}
