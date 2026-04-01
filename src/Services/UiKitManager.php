<?php

declare(strict_types=1);

namespace Jeremykenedy\LaravelUiKit\Services;

class UiKitManager
{
    protected array $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function cssFramework(): string
    {
        return $this->config['css_framework'] ?? 'tailwind';
    }

    public function frontend(): string
    {
        return $this->config['frontend'] ?? 'blade';
    }

    public function iconSet(): string
    {
        return $this->config['icons'] ?? 'lucide';
    }

    public function prefix(): string
    {
        return $this->config['prefix'] ?? 'ui';
    }

    public function darkModeEnabled(): bool
    {
        return $this->config['dark_mode']['enabled'] ?? true;
    }

    public function darkModeDefault(): string
    {
        return $this->config['dark_mode']['default'] ?? 'system';
    }

    public function isTailwind(): bool
    {
        return $this->cssFramework() === 'tailwind';
    }

    public function isBootstrap5(): bool
    {
        return $this->cssFramework() === 'bootstrap5';
    }

    public function isBootstrap4(): bool
    {
        return $this->cssFramework() === 'bootstrap4';
    }

    public function confirmDefaults(): array
    {
        return $this->config['confirm'] ?? [
            'default_title' => 'Confirm Action',
            'default_message' => 'Are you sure you want to proceed?',
            'cancel_text' => 'Cancel',
            'confirm_text' => 'Confirm',
        ];
    }

    public function passwordDefaults(): array
    {
        return $this->config['password'] ?? [
            'strength_meter' => true,
            'show_hide' => true,
            'min_length' => 8,
        ];
    }

    public function toastDefaults(): array
    {
        return $this->config['toast'] ?? [
            'position' => 'top-right',
            'duration' => 5000,
            'max_visible' => 5,
        ];
    }
}
