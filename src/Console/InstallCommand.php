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
        {--frontend= : Frontend framework (blade, livewire, vue, react, svelte)}
        {--force : Skip confirmation when reinstalling}';

    protected $description = 'Install Laravel UI Kit with the specified CSS and frontend framework';

    public function handle(): int
    {
        $this->renderBanner('UI KIT');

        if ($this->isAlreadyInstalled() && !$this->option('force')) {
            $this->warn('  Laravel UI Kit is already installed.');
            $this->newLine();
            $this->line('  To change frameworks, use the update command instead:');
            $this->line('    <comment>php artisan ui-kit:update</comment>');
            $this->newLine();
            $this->line('  To switch a single setting quickly:');
            $this->line('    <comment>php artisan ui-kit:switch --css=bootstrap5</comment>');
            $this->newLine();
            $this->warn('  Reinstalling will overwrite your config and published views.');
            $this->warn('  This is a destructive action that resets all package settings.');
            $this->newLine();

            if ($this->option('no-interaction')) {
                $this->error('  Already installed. Use --force to reinstall non-interactively.');

                return self::FAILURE;
            }

            $confirm = $this->ask('  Type "yes" to reinstall from scratch, or any other key to cancel');

            if ($confirm !== 'yes') {
                $this->info('  Cancelled. No changes were made.');

                return self::SUCCESS;
            }

            $this->newLine();
        }

        $result = $this->promptFrameworks();
        if ($result === false) {
            return self::FAILURE;
        }

        $this->call('vendor:publish', ['--tag' => 'ui-kit-config', '--force' => true]);

        $this->setCssFramework($result['css']);
        $this->setFrontendFramework($result['frontend']);

        $this->showSummary('Laravel UI Kit', $result['css'], $result['frontend']);

        return self::SUCCESS;
    }

    protected function isAlreadyInstalled(): bool
    {
        return file_exists(config_path('ui-kit.php'));
    }
}
