<?php

declare(strict_types=1);

namespace Jeremykenedy\LaravelUiKit\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Breadcrumbs extends Component
{
    public array $items;

    public function __construct(
        array $items = [],
    ) {
        $this->items = $items;
    }

    public function render(): View
    {
        return view('ui::components.breadcrumbs');
    }
}
