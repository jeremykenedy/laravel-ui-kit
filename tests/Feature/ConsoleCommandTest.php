<?php

declare(strict_types=1);
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Support\Facades\File;
use Jeremykenedy\LaravelUiKit\Console\PackageInstallCommand;

/**
 * The install and update commands both branch on whether config/ui-kit.php exists,
 * so each test starts from a known state and puts the file back the way it found it.
 */
beforeEach(function () {
    $this->environmentDirectory = sys_get_temp_dir().'/ui-kit-env-'.bin2hex(random_bytes(8));
    mkdir($this->environmentDirectory, 0755, true);
    $this->app->useEnvironmentPath($this->environmentDirectory);
    $this->app->loadEnvironmentFrom('.env.testing');
    $this->environmentFile = $this->app->environmentFilePath();
    file_put_contents($this->environmentFile, "APP_NAME=Example\nUI_KIT_CSS=tailwind\nUI_KIT_FRONTEND=blade\n");
    $this->configFile = config_path('ui-kit.php');
    $this->configExisted = file_exists($this->configFile);
    $this->originalConfig = $this->configExisted ? file_get_contents($this->configFile) : null;
});

afterEach(function () {
    File::deleteDirectory($this->environmentDirectory);
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

    expect(file_get_contents($this->environmentFile))
        ->toBe("APP_NAME=Example\nUI_KIT_CSS=bootstrap4\nUI_KIT_FRONTEND=react\n");
});

it('registers all four artisan commands', function () {
    $commands = array_keys(app(Kernel::class)->all());

    expect($commands)->toContain('ui-kit:install')
        ->and($commands)->toContain('ui-kit:update')
        ->and($commands)->toContain('ui-kit:switch')
        ->and($commands)->toContain('ui:switch');
});

it('persists selections in the configured environment file', function (string $command, string $css, string $frontend) {
    markInstalled($this->configFile);
    $options = ['--css' => $css, '--frontend' => $frontend];

    if ($command === 'ui-kit:install') {
        $options['--force'] = true;
    }

    $this->artisan($command, $options)->assertExitCode(0);

    expect(file_get_contents($this->environmentFile))
        ->toBe("APP_NAME=Example\nUI_KIT_CSS={$css}\nUI_KIT_FRONTEND={$frontend}\n");
})->with(['ui-kit:install', 'ui-kit:update', 'ui-kit:switch', 'ui:switch'])
    ->with(cssFrameworks())->with(frontends());

it('rejects a single invalid noninteractive install option without publishing config', function (string $option, string $value) {
    markNotInstalled($this->configFile);
    $original = file_get_contents($this->environmentFile);

    $this->artisan('ui-kit:install', [$option => $value, '--no-interaction' => true])
        ->assertExitCode(1);

    expect(file_exists($this->configFile))->toBeFalse()
        ->and(file_get_contents($this->environmentFile))->toBe($original);
})->with([['--css', 'foundation'], ['--frontend', 'ember'], ['--css', '0'], ['--frontend', '0']]);

it('does not change either setting when a switch option is invalid', function (string $command) {
    $original = file_get_contents($this->environmentFile);

    $this->artisan($command, ['--css' => 'bootstrap5', '--frontend' => 'ember'])
        ->assertExitCode(1);

    expect(file_get_contents($this->environmentFile))->toBe($original);
})->with(['ui-kit:switch', 'ui:switch']);

it('returns to css selection in the reusable package installer', function () {
    $command = new class extends PackageInstallCommand
    {
        protected $signature = 'example:install';

        public int $selections = 0;

        protected function packageName(): string
        {
            return 'Example';
        }

        protected function configTag(): string
        {
            return 'example-config';
        }

        protected function viewsTag(): string
        {
            return 'example-views';
        }

        protected function promptCssFramework(): string|false
        {
            return ++$this->selections === 1 ? 'tailwind' : 'bootstrap4';
        }

        protected function promptFrontendFramework(): string|false
        {
            return $this->selections === 1 ? '__back__' : 'blade';
        }
    };
    $this->app->make(Kernel::class)->registerCommand($command);

    $this->artisan('example:install')->assertExitCode(0);

    expect($command->selections)->toBe(2)
        ->and(file_get_contents($this->environmentFile))
        ->toBe("APP_NAME=Example\nUI_KIT_CSS=bootstrap4\nUI_KIT_FRONTEND=blade\n");
});

it('updates active environment assignments without changing comments or other keys', function (string $original, string $expected) {
    file_put_contents($this->environmentFile, $original);

    $this->artisan('ui-kit:switch', ['--css' => 'bootstrap5'])->assertExitCode(0);

    expect(file_get_contents($this->environmentFile))->toBe($expected);
})->with([
    'comment' => ["# UI_KIT_CSS=tailwind\n", "# UI_KIT_CSS=tailwind\nUI_KIT_CSS=bootstrap5\n"],
    'similar key' => ["OTHER_UI_KIT_CSS=tailwind\n", "OTHER_UI_KIT_CSS=tailwind\nUI_KIT_CSS=bootstrap5\n"],
    'spaces' => ["  UI_KIT_CSS = tailwind\n", "UI_KIT_CSS=bootstrap5\n"],
    'export' => ["export UI_KIT_CSS=tailwind\n", "UI_KIT_CSS=bootstrap5\n"],
    'windows line endings' => ["UI_KIT_CSS=tailwind\r\nAPP_NAME=Example\r\n", "UI_KIT_CSS=bootstrap5\r\nAPP_NAME=Example\r\n"],
    'missing newline' => ['APP_NAME=Example', "APP_NAME=Example\nUI_KIT_CSS=bootstrap5\n"],
]);

it('preserves the other setting and published config during an update', function () {
    markInstalled($this->configFile);
    $originalConfig = file_get_contents($this->configFile);

    $this->artisan('ui-kit:update', ['--css' => 'bootstrap4'])->assertExitCode(0);

    expect(file_get_contents($this->environmentFile))
        ->toBe("APP_NAME=Example\nUI_KIT_CSS=bootstrap4\nUI_KIT_FRONTEND=blade\n")
        ->and(file_get_contents($this->configFile))->toBe($originalConfig);
});
