<?php

declare(strict_types=1);

namespace Jeremykenedy\LaravelUiKit\Console;

use Illuminate\Console\Command;
use Jeremykenedy\LaravelUiKit\Console\Concerns\HandlesFrameworkSetup;

class SwitchCommand extends Command
{
    use HandlesFrameworkSetup;

    protected $signature = 'ui-kit:switch
        {--css= : CSS framework (tailwind, bootstrap5, bootstrap4)}
        {--frontend= : Frontend framework (blade, livewire, vue, react, svelte)}';

    protected $description = 'Switch the CSS and/or frontend framework for Laravel UI Kit';

    public function handle(): int
    {
        $css = $this->option('css');
        $frontend = $this->option('frontend');

        if (! $css && ! $frontend) {
            $this->error('Provide --css and/or --frontend');

            return self::FAILURE;
        }

        if ($css && ! in_array($css, ['tailwind', 'bootstrap5', 'bootstrap4'])) {
            $this->error("Invalid CSS: {$css}");

            return self::FAILURE;
        }

        if ($frontend && ! in_array($frontend, ['blade', 'livewire', 'vue', 'react', 'svelte'])) {
            $this->error("Invalid frontend: {$frontend}");

            return self::FAILURE;
        }

        if ($css) {
            $this->setCssFramework($css);
            $this->info("UI Kit CSS switched to: {$css}");
        }

        if ($frontend) {
            $this->setFrontendFramework($frontend);
            $this->info("UI Kit frontend switched to: {$frontend}");
        }

        return self::SUCCESS;
    }
}
