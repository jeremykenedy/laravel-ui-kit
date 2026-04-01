<?php

declare(strict_types=1);

namespace Jeremykenedy\LaravelUiKit\Console;

use Illuminate\Console\Command;
use Jeremykenedy\LaravelUiKit\Console\Concerns\HandlesFrameworkSetup;
use Jeremykenedy\LaravelUiKit\Console\Concerns\HasInstallPrompts;

class InstallCommand extends Command
{
    use HandlesFrameworkSetup;
    use HasInstallPrompts;

    protected $signature = 'ui-kit:install
        {--css= : CSS framework (tailwind, bootstrap5, bootstrap4)}
        {--frontend= : Frontend framework (blade, livewire, vue, react, svelte)}';

    protected $description = 'Install Laravel UI Kit with the specified CSS and frontend framework';

    public function handle(): int
    {
        $this->renderBanner('UI KIT');

        $css = $this->promptCssFramework();
        if ($css === false) {
            return self::FAILURE;
        }

        $frontend = $this->promptFrontendFramework();
        if ($frontend === false) {
            return self::FAILURE;
        }

        $this->call('vendor:publish', ['--tag' => 'ui-kit-config', '--force' => false]);

        $this->setCssFramework($css);
        $this->setFrontendFramework($frontend);

        $this->showSummary('Laravel UI Kit', $css, $frontend);

        return self::SUCCESS;
    }
}
