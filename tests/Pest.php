<?php

declare(strict_types=1);

use Illuminate\Support\Facades\View;
use Jeremykenedy\LaravelUiKit\Tests\TestCase;

uses(TestCase::class)->in('Feature', 'Unit');

/**
 * Point the ui and ui-kit view namespaces at a different CSS framework.
 *
 * replaceNamespace is required here: addNamespace appends, which would leave the
 * previously registered framework first in the lookup order and silently keep
 * rendering the old templates.
 */
function useCssFramework(string $framework): void
{
    config(['ui-kit.css_framework' => $framework]);

    $viewsPath = packagePath('resources/views');

    View::replaceNamespace('ui', [$viewsPath.'/'.$framework, $viewsPath.'/tailwind']);
    View::replaceNamespace('ui-kit', [$viewsPath.'/'.$framework, $viewsPath.'/tailwind', $viewsPath]);
}

/**
 * Absolute path to a file shipped inside the package, independent of testbench's base path.
 */
function packagePath(string $path = ''): string
{
    return rtrim(realpath(__DIR__.'/..').'/'.ltrim($path, '/'), '/');
}

/**
 * Every CSS framework the package ships templates for.
 *
 * @return list<string>
 */
function cssFrameworks(): array
{
    return ['tailwind', 'bootstrap5', 'bootstrap4'];
}

/**
 * Every frontend the install and switch commands accept.
 *
 * @return list<string>
 */
function frontends(): array
{
    return ['blade', 'livewire', 'vue', 'react', 'svelte'];
}
