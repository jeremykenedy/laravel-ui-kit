<?php

declare(strict_types=1);

namespace Jeremykenedy\LaravelUiKit\Components;

use Illuminate\View\Component;

class PasswordInput extends Component
{
    public function __construct(
        public ?string $name = 'password',
        public ?string $id = null,
        public ?string $label = null,
        public ?string $placeholder = null,
        public bool $strengthMeter = true,
        public bool $showHide = true,
        public bool $required = false,
        public ?string $autocomplete = 'new-password',
        public ?string $confirmName = null,
        public ?string $error = null,
    ) {
        $this->id = $this->id ?? $this->name;
        $defaults = config('ui-kit.password', []);
        $this->strengthMeter = $strengthMeter ?? ($defaults['strength_meter'] ?? true);
        $this->showHide = $showHide ?? ($defaults['show_hide'] ?? true);
    }

    public function render(): \Illuminate\Contracts\View\View
    {
        return view('ui::components.password-input');
    }

    public function hasError(): bool
    {
        return $this->error !== null || ($this->name && session('errors')?->has($this->name));
    }

    public function errorMessage(): ?string
    {
        if ($this->error) {
            return $this->error;
        }

        return $this->name ? session('errors')?->first($this->name) : null;
    }

    public function strengthMessages(): array
    {
        return config('ui-kit.password.messages', [
            'short' => 'Too short',
            'weak' => 'Weak',
            'medium' => 'Medium',
            'strong' => 'Strong',
        ]);
    }

    public function minLength(): int
    {
        return config('ui-kit.password.min_length', 8);
    }
}
