<?php

declare(strict_types=1);

namespace Jeremykenedy\LaravelUiKit\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class UiDataTable extends Component
{
    public array $headers = [];

    public array $rows = [];

    public string $sortField = '';

    public string $sortDirection = 'asc';

    public function sortBy(string $field): void
    {
        $this->sortDirection = $this->sortField === $field && $this->sortDirection === 'asc' ? 'desc' : 'asc';
        $this->sortField = $field;
        $this->dispatch('sort-changed', field: $field, direction: $this->sortDirection);
    }

    public function render(): View
    {
        return view('ui-kit::livewire.data-table');
    }
}
