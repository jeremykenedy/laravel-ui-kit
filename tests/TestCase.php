<?php

declare(strict_types=1);

namespace Jeremykenedy\LaravelUiKit\Tests;

use Jeremykenedy\LaravelUiKit\Providers\UiKitServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

abstract class TestCase extends OrchestraTestCase
{
    protected function getPackageProviders($app): array
    {
        return [
            UiKitServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app): void
    {
        // Force SQLite in-memory -- UI Kit tests NEVER touch a real database
        $app['config']->set('database.default', 'testing');
        $app['config']->set('database.connections.testing', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
        $app['config']->set('database.connections.mysql', null);
        $app['config']->set('database.connections.pgsql', null);
        $app['config']->set('database.connections.sqlsrv', null);

        // UI Kit config
        $app['config']->set('ui-kit.css_framework', 'tailwind');
        $app['config']->set('ui-kit.frontend', 'blade');
        $app['config']->set('ui-kit.prefix', 'ui');
        $app['config']->set('ui-kit.icons', 'lucide');
        $app['config']->set('ui-kit.dark_mode.enabled', true);
        $app['config']->set('app.env', 'testing');
    }

    protected function setUp(): void
    {
        parent::setUp();

        // Hard fail if any real database connection is active
        $driver = config('database.default');
        $connection = config("database.connections.{$driver}");

        if ($connection !== null) {
            $dbDriver = $connection['driver'] ?? 'unknown';
            $dbName = $connection['database'] ?? 'unknown';

            if ($dbDriver !== 'sqlite' || $dbName !== ':memory:') {
                $this->fail(
                    "SAFETY: UI Kit tests detected a non-memory database: {$dbDriver}/{$dbName}. "
                    .'UI Kit tests must NEVER touch a real database.'
                );
            }
        }
    }
}
