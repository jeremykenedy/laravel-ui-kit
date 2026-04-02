<?php

declare(strict_types=1);

namespace Jeremykenedy\LaravelUiKit\Console;

use Illuminate\Console\Command;
use Jeremykenedy\LaravelUiKit\Console\Concerns\HandlesFrameworkSetup;
use Jeremykenedy\LaravelUiKit\Console\Concerns\HasInstallPrompts;

use function Laravel\Prompts\info;

class UpdateCommand extends Command
{
    use HandlesFrameworkSetup;
    use HasInstallPrompts;

    protected $signature = 'ui-kit:update
        {--css= : CSS framework (tailwind, bootstrap5, bootstrap4)}
        {--frontend= : Frontend framework (blade, livewire, vue, react, svelte)}';

    protected $description = 'Update the CSS and/or frontend framework for Laravel UI Kit';

    public function handle(): int
    {
        $this->renderBanner('UI KIT');

        if (!$this->isInstalled()) {
            $this->warn('  Laravel UI Kit is not installed yet.');
            $this->newLine();
            $this->line('  Run the install command first:');
            $this->line('    <comment>php artisan ui-kit:install</comment>');

            return self::FAILURE;
        }

        $css = $this->option('css');
        $frontend = $this->option('frontend');

        if (!$css && !$frontend) {
            $result = $this->promptFrameworks();
            if ($result === false) {
                return self::FAILURE;
            }
            $css = $result['css'];
            $frontend = $result['frontend'];
        } else {
            $validCss = ['tailwind', 'bootstrap5', 'bootstrap4'];
            $validFrontend = ['blade', 'livewire', 'vue', 'react', 'svelte'];

            if ($css && !in_array($css, $validCss)) {
                $this->error("Invalid CSS framework: {$css}. Valid: ".implode(', ', $validCss));

                return self::FAILURE;
            }

            if ($frontend && !in_array($frontend, $validFrontend)) {
                $this->error("Invalid frontend: {$frontend}. Valid: ".implode(', ', $validFrontend));

                return self::FAILURE;
            }
        }

        if ($css) {
            $this->setCssFramework($css);
            info("CSS framework updated to: {$css}");
        }

        if ($frontend) {
            $this->setFrontendFramework($frontend);
            info("Frontend framework updated to: {$frontend}");
        }

        info('Run: php artisan view:clear && npm run build');

        return self::SUCCESS;
    }

    protected function isInstalled(): bool
    {
        return file_exists(config_path('ui-kit.php'));
    }
}
