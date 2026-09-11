<?php

declare(strict_types=1);

namespace Jeremykenedy\LaravelUiKit\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class UiTabs extends Component
{
    public string $activeTab = '';

    public array $tabs = [];

    public array $panels = [];

    public function mount(array $tabs = [], ?string $active = null, array $panels = []): void
    {
        $this->tabs = $tabs;
        $this->panels = $panels;
        $this->activeTab = $active ?? (string) (array_key_first($tabs) !== null ? ($tabs[array_key_first($tabs)] ?? '') : '');
    }

    public function selectTab(string $tab): void
    {
        $this->activeTab = $tab;
        $this->dispatch('tab-changed', tab: $tab);
    }

    public function render(): View
    {
        return view('ui-kit::livewire.tabs');
    }
}
