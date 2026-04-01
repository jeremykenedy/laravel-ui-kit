<?php

declare(strict_types=1);

namespace Jeremykenedy\LaravelUiKit\Components;

use Illuminate\View\Component;

class Nav extends Component
{
    public function __construct(
        public string $type = 'horizontal',
        public ?string $variant = null,
        public bool $pills = false,
        public bool $bordered = false,
    ) {}

    public function render(): \Illuminate\Contracts\View\View
    {
        return view('ui::components.nav');
    }
}
