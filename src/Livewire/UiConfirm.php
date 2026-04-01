<?php

declare(strict_types=1);

namespace Jeremykenedy\LaravelUiKit\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class UiConfirm extends Component
{
    public bool $show = false;
    public string $title = 'Are you sure?';
    public string $message = '';
    public string $confirmText = 'Confirm';
    public string $cancelText = 'Cancel';
    public string $action = '';

    #[On('confirm-action')]
    public function showConfirm(string $title, string $message, string $action): void
    {
        $this->title = $title;
        $this->message = $message;
        $this->action = $action;
        $this->show = true;
    }

    public function confirmed(): void
    {
        $this->show = false;
        $this->dispatch('confirmed', action: $this->action);
    }

    public function cancelled(): void { $this->show = false; }

    public function render() { return view('ui-kit::livewire.confirm'); }
}
