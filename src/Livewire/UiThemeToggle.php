<?php

declare(strict_types=1);

namespace Jeremykenedy\LaravelUiKit\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class UiThemeToggle extends Component
{
    public string $current = 'system';

    public bool $menuOpen = false;

    public function mount(): void
    {
        $user = auth()->user();
        if ($user && $user->profile) {
            $this->current = $user->profile->dark_mode ?? 'system';
        }
    }

    public function setTheme(string $mode): void
    {
        if (!in_array($mode, ['light', 'dark', 'system'])) {
            return;
        }

        $this->current = $mode;
        $this->menuOpen = false;

        $user = auth()->user();
        if ($user && method_exists($user, 'ensureProfile')) {
            $user->ensureProfile();
            $user->profile->update(['dark_mode' => $mode]);
        }

        $this->dispatch('theme-changed', mode: $mode);
    }

    public function render(): View
    {
        return view('ui-kit::livewire.theme-toggle');
    }
}
