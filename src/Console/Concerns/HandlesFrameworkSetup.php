<?php

declare(strict_types=1);

namespace Jeremykenedy\LaravelUiKit\Console\Concerns;

trait HandlesFrameworkSetup
{
    protected function getCssOption(): string
    {
        return $this->option('css') ?? config('ui-kit.css_framework', 'tailwind');
    }

    protected function getFrontendOption(): string
    {
        return $this->option('frontend') ?? config('ui-kit.frontend', 'blade');
    }

    protected function updateEnvValue(string $key, string $value): void
    {
        if (app()->runningUnitTests()) {
            return;
        }

        $path = base_path('.env');

        if (!file_exists($path)) {
            return;
        }

        $content = file_get_contents($path);

        if (str_contains($content, "{$key}=")) {
            $content = preg_replace("/^{$key}=.*/m", "{$key}={$value}", $content);
        } else {
            $content .= "\n{$key}={$value}";
        }

        file_put_contents($path, $content);
    }

    protected function setCssFramework(string $css): void
    {
        $this->updateEnvValue('UI_KIT_CSS', $css);
        $this->call('config:clear');
        $this->call('view:clear');
    }

    protected function setFrontendFramework(string $frontend): void
    {
        $this->updateEnvValue('UI_KIT_FRONTEND', $frontend);
        $this->call('config:clear');
        $this->call('view:clear');
    }
}
