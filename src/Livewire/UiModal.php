<?php

declare(strict_types=1);

namespace Jeremykenedy\LaravelUiKit\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class UiModal extends Component
{
    public bool $show = false;

    public string $title = '';

    public string $size = 'md';

    #[On('open-modal')]
    public function open(string $title = ''): void
    {
        $this->title = $title;
        $this->show = true;
    }

    #[On('close-modal')]
    public function close(): void
    {
        $this->show = false;
    }

    public function render()
    {
        return view('ui-kit::livewire.modal');
    }
}
