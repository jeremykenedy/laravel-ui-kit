<?php

declare(strict_types=1);

namespace Jeremykenedy\LaravelUiKit\Components;

use Illuminate\View\Component;

class Tabs extends Component
{
    public function __construct(
        public array $tabs = [],
        public ?string $activeTab = null,
        public string $variant = 'underline',
        public string $id = 'tabs',
        public bool $vertical = false,
    ) {
    }

    public function render(): \Illuminate\Contracts\View\View
    {
        return view('ui::components.tabs');
    }
}
