<?php

declare(strict_types=1);
use Illuminate\Contracts\Console\Kernel;

/**
 * The install and update commands both branch on whether config/ui-kit.php exists,
 * so each test starts from a known state and puts the file back the way it found it.
 */
beforeEach(function () {
    $this->configFile = config_path('ui-kit.php');
    $this->configExisted = file_exists($this->configFile);
    $this->originalConfig = $this->configExisted ? file_get_contents($this->configFile) : null;
});

afterEach(function () {
    if ($this->configExisted) {
        file_put_contents($this->configFile, $this->originalConfig);

        return;
    }

    if (file_exists($this->configFile)) {
        unlink($this->configFile);
    }
});

function markInstalled(string $path): void
{
    if (!is_dir(dirname($path))) {
        mkdir(dirname($path), 0755, true);
    }

    file_put_contents($path, "<?php\n\nreturn [];\n");
}

function markNotInstalled(string $path): void
{
    if (file_exists($path)) {
        unlink($path);
    }
}

it('installs every css and frontend combination', function (string $css, string $frontend) {
    $this->artisan('ui-kit:install', ['--css' => $css, '--frontend' => $frontend, '--force' => true])
        ->assertExitCode(0);
})->with(cssFrameworks())->with(frontends());

it('updates every css and frontend combination', function (string $css, string $frontend) {
    markInstalled($this->configFile);

    $this->artisan('ui-kit:update', ['--css' => $css, '--frontend' => $frontend])
        ->assertExitCode(0);
})->with(cssFrameworks())->with(frontends());

it('switches every css and frontend combination', function (string $css, string $frontend) {
    $this->artisan('ui-kit:switch', ['--css' => $css, '--frontend' => $frontend])
        ->assertExitCode(0);
})->with(cssFrameworks())->with(frontends());

it('switches every combination through the shared ui:switch command', function (string $css, string $frontend) {
    $this->artisan('ui:switch', ['--css' => $css, '--frontend' => $frontend])
        ->assertExitCode(0);
})->with(cssFrameworks())->with(frontends());

it('rejects an unknown css framework on install', function () {
    $this->artisan('ui-kit:install', ['--css' => 'foundation', '--frontend' => 'blade', '--force' => true])
        ->expectsOutputToContain('Invalid CSS framework: foundation')
        ->assertExitCode(1);
});

it('rejects an unknown frontend on install', function () {
    $this->artisan('ui-kit:install', ['--css' => 'tailwind', '--frontend' => 'ember', '--force' => true])
        ->expectsOutputToContain('Invalid frontend: ember')
        ->assertExitCode(1);
});

it('rejects an unknown css framework on update', function () {
    markInstalled($this->configFile);

    $this->artisan('ui-kit:update', ['--css' => 'foundation'])
        ->expectsOutputToContain('Invalid CSS framework: foundation')
        ->assertExitCode(1);
});

it('rejects an unknown frontend on update', function () {
    markInstalled($this->configFile);

    $this->artisan('ui-kit:update', ['--frontend' => 'ember'])
        ->expectsOutputToContain('Invalid frontend: ember')
        ->assertExitCode(1);
});

it('rejects an unknown css framework on switch', function () {
    $this->artisan('ui-kit:switch', ['--css' => 'foundation'])
        ->expectsOutputToContain('Invalid CSS: foundation')
        ->assertExitCode(1);
});

it('rejects an unknown frontend on switch', function () {
    $this->artisan('ui-kit:switch', ['--frontend' => 'ember'])
        ->expectsOutputToContain('Invalid frontend: ember')
        ->assertExitCode(1);
});

it('requires at least one option on switch', function () {
    $this->artisan('ui-kit:switch')
        ->expectsOutputToContain('Provide --css and/or --frontend')
        ->assertExitCode(1);
});

it('requires at least one option on the shared switch command', function () {
    $this->artisan('ui:switch')
        ->expectsOutputToContain('Provide at least one option')
        ->assertExitCode(1);
});

it('refuses to update before the package is installed', function () {
    markNotInstalled($this->configFile);

    $this->artisan('ui-kit:update', ['--css' => 'tailwind'])
        ->expectsOutputToContain('not installed')
        ->assertExitCode(1);
});

it('refuses to reinstall non interactively without force', function () {
    markInstalled($this->configFile);

    $this->artisan('ui-kit:install', ['--css' => 'tailwind', '--frontend' => 'blade', '--no-interaction' => true])
        ->assertExitCode(1);
});

it('reinstalls over an existing install when forced', function () {
    markInstalled($this->configFile);

    $this->artisan('ui-kit:install', ['--css' => 'bootstrap5', '--frontend' => 'vue', '--force' => true])
        ->assertExitCode(0);
});

it('falls back to the configured values when run without options and without interaction', function () {
    config(['ui-kit.css_framework' => 'bootstrap4', 'ui-kit.frontend' => 'react']);
    markNotInstalled($this->configFile);

    $this->artisan('ui-kit:install', ['--no-interaction' => true])
        ->assertExitCode(0);
});

it('registers all four artisan commands', function () {
    $commands = array_keys(app(Kernel::class)->all());

    expect($commands)->toContain('ui-kit:install')
        ->and($commands)->toContain('ui-kit:update')
        ->and($commands)->toContain('ui-kit:switch')
        ->and($commands)->toContain('ui:switch');
});
