<?php

declare(strict_types=1);

namespace Jeremykenedy\LaravelUiKit\Components;

use Illuminate\View\Component;

class SearchInput extends Component
{
    public function __construct(
        public ?string $name = 'search',
        public ?string $id = null,
        public ?string $placeholder = 'Search...',
        public ?string $value = null,
        public ?string $action = null,
        public string $method = 'GET',
        public bool $clearable = true,
        public bool $autofocus = false,
        public ?int $debounce = 300,
    ) {
        $this->id = $this->id ?? $this->name;
    }

    public function render(): \Illuminate\Contracts\View\View
    {
        return view('ui::components.search-input');
    }
}
