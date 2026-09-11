<?php

declare(strict_types=1);

namespace Jeremykenedy\LaravelUiKit\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Jeremykenedy\LaravelUiKit\Contracts\ComponentContract;

class DataTable extends Component implements ComponentContract
{
    public function __construct(
        public array $headers = [],
        public ?object $rows = null,
        public ?bool $searchable = null,
        public ?bool $sortable = null,
        public bool $striped = true,
        public bool $hoverable = true,
        public bool $bordered = false,
        public bool $compact = false,
        public ?string $emptyMessage = 'No records found.',
        public ?string $searchPlaceholder = 'Search...',
        public ?string $id = 'data-table',
    ) {
        $this->searchable ??= (bool) config('ui-kit.datatable.searchable', true);
        $this->sortable ??= (bool) config('ui-kit.datatable.sortable', true);
    }

    public function render(): View
    {
        return view('ui::components.data-table');
    }
}
