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
        $path = $this->laravel->environmentFilePath();

        if (!file_exists($path)) {
            return;
        }

        $content = file_get_contents($path);

        $pattern = '/^[\t ]*(?:export[\t ]+)?'.preg_quote($key, '/').'[\t ]*=[^\r\n]*/m';
        $content = preg_replace_callback($pattern, fn (): string => "{$key}={$value}", $content, -1, $count);

        if ($count === 0) {
            $newline = str_contains($content, "\r\n") ? "\r\n" : "\n";
            $content .= ($content !== '' && !str_ends_with($content, "\n") ? $newline : '')."{$key}={$value}".$newline;
        }

        file_put_contents($path, $content, LOCK_EX);
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
