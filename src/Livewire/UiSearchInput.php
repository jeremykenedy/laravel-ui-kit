<?php

declare(strict_types=1);

namespace Jeremykenedy\LaravelUiKit\Livewire;

use Livewire\Component;

class UiSearchInput extends Component
{
    public string $query = '';
    public ?string $placeholder = 'Search...';

    public function updatedQuery(): void
    {
        $this->dispatch('search', query: $this->query);
    }

    public function clear(): void
    {
        $this->query = '';
        $this->dispatch('search', query: '');
    }

    public function render()
    {
        return view('ui-kit::livewire.search-input');
    }
}
