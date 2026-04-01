<?php

declare(strict_types=1);

namespace Jeremykenedy\LaravelUiKit\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DataTable extends Component
{
    public function __construct(
        public array $headers = [],
        public ?object $rows = null,
        public bool $searchable = true,
        public bool $sortable = true,
        public bool $striped = true,
        public bool $hoverable = true,
        public bool $bordered = false,
        public bool $compact = false,
        public ?string $emptyMessage = 'No records found.',
        public ?string $searchPlaceholder = 'Search...',
        public ?string $id = 'data-table',
    ) {
        $defaults = config('ui-kit.datatable', []);
        $this->searchable = $searchable ?? ($defaults['searchable'] ?? true);
        $this->sortable = $sortable ?? ($defaults['sortable'] ?? true);
    }

    public function render(): View
    {
        return view('ui::components.data-table');
    }
}
