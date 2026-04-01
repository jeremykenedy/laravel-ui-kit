<?php

declare(strict_types=1);

namespace Jeremykenedy\LaravelUiKit\Console;

use Illuminate\Console\Command;
use Jeremykenedy\LaravelUiKit\Console\Concerns\HandlesFrameworkSetup;

class SwitchFrameworkCommand extends Command
{
    use HandlesFrameworkSetup;

    protected $signature = 'ui:switch
        {--css= : CSS framework (tailwind, bootstrap5, bootstrap4)}
        {--frontend= : Frontend framework (blade, livewire, vue, react, svelte)}';

    protected $description = 'Switch the CSS and/or frontend framework for all packages';

    public function handle(): int
    {
        $css = $this->option('css');
        $frontend = $this->option('frontend');

        if (!$css && !$frontend) {
            $this->error('Provide at least one option: --css or --frontend');

            return self::FAILURE;
        }

        if ($css) {
            if (!in_array($css, ['tailwind', 'bootstrap5', 'bootstrap4'])) {
                $this->error("Invalid CSS framework: {$css}. Use tailwind, bootstrap5, or bootstrap4.");

                return self::FAILURE;
            }
            $this->setCssFramework($css);
            $this->info("CSS framework switched to: {$css}");
        }

        if ($frontend) {
            if (!in_array($frontend, ['blade', 'livewire', 'vue', 'react', 'svelte'])) {
                $this->error("Invalid frontend: {$frontend}. Use blade, livewire, vue, react, or svelte.");

                return self::FAILURE;
            }
            $this->setFrontendFramework($frontend);
            $this->info("Frontend framework switched to: {$frontend}");
        }

        $this->newLine();
        $this->info('All packages will use the new framework on next request.');

        return self::SUCCESS;
    }
}
