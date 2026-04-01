<?php

declare(strict_types=1);

namespace Jeremykenedy\LaravelUiKit\Livewire;

use Livewire\Component;

class UiPagination extends Component
{
    public int $currentPage = 1;

    public int $lastPage = 1;

    public int $total = 0;

    public int $perPage = 15;

    public function goToPage(int $page): void
    {
        $this->currentPage = max(1, min($page, $this->lastPage));
        $this->dispatch('page-changed', page: $this->currentPage);
    }

    public function render()
    {
        return view('ui-kit::livewire.pagination');
    }
}
