<?php

declare(strict_types=1);

namespace Jeremykenedy\LaravelUiKit\Console;

use Illuminate\Console\Command;
use Jeremykenedy\LaravelUiKit\Console\Concerns\HandlesFrameworkSetup;
use Jeremykenedy\LaravelUiKit\Console\Concerns\HasInstallPrompts;

abstract class PackageInstallCommand extends Command
{
    use HandlesFrameworkSetup;
    use HasInstallPrompts;

    abstract protected function packageName(): string;

    abstract protected function configTag(): string;

    abstract protected function viewsTag(): string;

    protected function bannerText(): string
    {
        return strtoupper(
            str_replace(['Laravel ', 'laravel-', 'laravel'], '', $this->packageName())
        );
    }

    protected function migrationsTag(): ?string
    {
        return null;
    }

    public function handle(): int
    {
        $this->renderBanner($this->bannerText());

        $css = $this->promptCssFramework();
        if ($css === false) {
            return self::FAILURE;
        }

        $frontend = $this->promptFrontendFramework();
        if ($frontend === false) {
            return self::FAILURE;
        }

        $this->call('vendor:publish', ['--tag' => $this->configTag(), '--force' => false]);
        $this->call('vendor:publish', ['--tag' => $this->viewsTag(), '--force' => true]);

        if ($this->migrationsTag()) {
            $this->call('vendor:publish', ['--tag' => $this->migrationsTag()]);
        }

        $this->setCssFramework($css);
        $this->setFrontendFramework($frontend);

        $this->showSummary($this->packageName(), $css, $frontend);

        return self::SUCCESS;
    }
}
