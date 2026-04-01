<?php

declare(strict_types=1);

namespace Jeremykenedy\LaravelUiKit\Livewire;

use Livewire\Component;

class UiTabs extends Component
{
    public string $activeTab = '';

    public array $tabs = [];

    public function mount(array $tabs = [], ?string $active = null): void
    {
        $this->tabs = $tabs;
        $this->activeTab = $active ?? ($tabs[0] ?? '');
    }

    public function selectTab(string $tab): void
    {
        $this->activeTab = $tab;
        $this->dispatch('tab-changed', tab: $tab);
    }

    public function render()
    {
        return view('ui-kit::livewire.tabs');
    }
}
