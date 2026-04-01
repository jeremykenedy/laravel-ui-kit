<?php

declare(strict_types=1);

namespace Jeremykenedy\LaravelUiKit\Components;

use Illuminate\View\Component;

class ThemeToggle extends Component
{
    public function render()
    {
        return view('ui::components.theme-toggle');
    }
}
