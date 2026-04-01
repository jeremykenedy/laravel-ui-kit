<?php

declare(strict_types=1);

namespace Jeremykenedy\LaravelUiKit\Console\Concerns;

use function Laravel\Prompts\select;

trait HasInstallPrompts
{
    protected static array $font = [
        'A' => ['  ██  ', ' ████ ', '██  ██', '██████', '██  ██'],
        'B' => ['█████ ', '██  ██', '█████ ', '██  ██', '█████ '],
        'C' => [' ████ ', '██    ', '██    ', '██    ', ' ████ '],
        'D' => ['████  ', '██  ██', '██  ██', '██  ██', '████  '],
        'E' => ['██████', '██    ', '████  ', '██    ', '██████'],
        'F' => ['██████', '██    ', '████  ', '██    ', '██    '],
        'G' => [' ████ ', '██    ', '██ ███', '██  ██', ' ████ '],
        'H' => ['██  ██', '██  ██', '██████', '██  ██', '██  ██'],
        'I' => ['██████', '  ██  ', '  ██  ', '  ██  ', '██████'],
        'J' => ['   ███', '    ██', '    ██', '██  ██', ' ████ '],
        'K' => ['██  ██', '██ ██ ', '████  ', '██ ██ ', '██  ██'],
        'L' => ['██    ', '██    ', '██    ', '██    ', '██████'],
        'M' => ['██   ██', '███ ███', '██ █ ██', '██   ██', '██   ██'],
        'N' => ['██  ██', '███ ██', '██████', '██ ███', '██  ██'],
        'O' => [' ████ ', '██  ██', '██  ██', '██  ██', ' ████ '],
        'P' => ['█████ ', '██  ██', '█████ ', '██    ', '██    '],
        'Q' => [' ████ ', '██  ██', '██  ██', '██ ██ ', ' ██ ██'],
        'R' => ['█████ ', '██  ██', '█████ ', '██ ██ ', '██  ██'],
        'S' => [' ████ ', '██    ', ' ████ ', '    ██', ' ████ '],
        'T' => ['██████', '  ██  ', '  ██  ', '  ██  ', '  ██  '],
        'U' => ['██  ██', '██  ██', '██  ██', '██  ██', ' ████ '],
        'V' => ['██  ██', '██  ██', '██  ██', ' ████ ', '  ██  '],
        'W' => ['██   ██', '██   ██', '██ █ ██', '███ ███', '██   ██'],
        'X' => ['██  ██', ' ████ ', '  ██  ', ' ████ ', '██  ██'],
        'Y' => ['██  ██', ' ████ ', '  ██  ', '  ██  ', '  ██  '],
        'Z' => ['██████', '   ██ ', '  ██  ', ' ██   ', '██████'],
        '2' => [' ████ ', '    ██', ' ████ ', '██    ', '██████'],
        '-' => ['      ', '      ', ' ████ ', '      ', '      '],
        ' ' => ['   ', '   ', '   ', '   ', '   '],
    ];

    protected function renderBanner(string $name): void
    {
        $chars = str_split(strtoupper($name));
        $lines = ['', '', '', '', ''];

        foreach ($chars as $char) {
            $glyph = self::$font[$char] ?? self::$font[' '];
            for ($i = 0; $i < 5; $i++) {
                $lines[$i] .= $glyph[$i] . ' ';
            }
        }

        $this->newLine();

        // Color gradient: cycle through blue/purple/cyan shades
        $colors = ['34', '35', '94', '95', '96'];

        foreach ($lines as $i => $line) {
            $color = $colors[$i % count($colors)];
            $this->line("  \033[{$color}m{$line}\033[0m");
        }

        $this->newLine();
    }

    protected function promptCssFramework(): string|false
    {
        $valid = ['tailwind', 'bootstrap5', 'bootstrap4'];
        $css = $this->option('css');

        if ($css) {
            if (! in_array($css, $valid)) {
                $this->error("Invalid CSS framework: {$css}. Use: ".implode(', ', $valid));

                return false;
            }

            return $css;
        }

        if ($this->option('no-interaction')) {
            return config('ui-kit.css_framework', 'tailwind');
        }

        return select(
            label: 'Which CSS framework would you like to use?',
            options: [
                'tailwind' => 'Tailwind CSS v4',
                'bootstrap5' => 'Bootstrap 5',
                'bootstrap4' => 'Bootstrap 4',
            ],
            default: config('ui-kit.css_framework', 'tailwind'),
        );
    }

    protected function promptFrontendFramework(): string|false
    {
        $valid = ['blade', 'livewire', 'vue', 'react', 'svelte'];
        $frontend = $this->option('frontend');

        if ($frontend) {
            if (! in_array($frontend, $valid)) {
                $this->error("Invalid frontend: {$frontend}. Use: ".implode(', ', $valid));

                return false;
            }

            return $frontend;
        }

        if ($this->option('no-interaction')) {
            return config('ui-kit.frontend', 'blade');
        }

        return select(
            label: 'Which frontend framework would you like to use?',
            options: [
                'blade' => 'Blade + Alpine.js',
                'livewire' => 'Livewire 3',
                'vue' => 'Vue 3',
                'react' => 'React 18',
                'svelte' => 'Svelte 4',
            ],
            default: config('ui-kit.frontend', 'blade'),
        );
    }

    protected function showSummary(string $packageName, string $css, string $frontend): void
    {
        $cssLabels = [
            'tailwind' => 'Tailwind CSS v4',
            'bootstrap5' => 'Bootstrap 5',
            'bootstrap4' => 'Bootstrap 4',
        ];

        $frontendLabels = [
            'blade' => 'Blade + Alpine.js',
            'livewire' => 'Livewire 3',
            'vue' => 'Vue 3',
            'react' => 'React 18',
            'svelte' => 'Svelte 4',
        ];

        $cssLabel = $cssLabels[$css] ?? $css;
        $feLabel = $frontendLabels[$frontend] ?? $frontend;

        $this->newLine();
        $this->line("  \033[32m{$packageName} installed successfully.\033[0m");
        $this->newLine();
        $this->line("  \033[90mCSS:\033[0m       {$cssLabel}");
        $this->line("  \033[90mFrontend:\033[0m  {$feLabel}");
        $this->newLine();
        $this->line("  Run: \033[33mnpm run build\033[0m");
        $this->newLine();
    }
}
