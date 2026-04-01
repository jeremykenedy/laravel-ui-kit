<?php

declare(strict_types=1);

namespace Jeremykenedy\LaravelUiKit\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Pagination extends Component
{
    public function __construct(
        public ?object $paginator = null,
        public bool $showInfo = true,
        public bool $simple = false,
        public string $size = 'md',
    ) {
    }

    public function render(): View
    {
        return view('ui::components.pagination');
    }
}
