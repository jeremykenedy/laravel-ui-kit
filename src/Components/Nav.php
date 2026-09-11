<?php

declare(strict_types=1);

namespace Jeremykenedy\LaravelUiKit\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Jeremykenedy\LaravelUiKit\Contracts\ComponentContract;

class Nav extends Component implements ComponentContract
{
    public function __construct(
        public string $type = 'horizontal',
        public ?string $variant = null,
        public bool $pills = false,
        public bool $bordered = false,
    ) {
    }

    public function render(): View
    {
        return view('ui::components.nav');
    }
}
