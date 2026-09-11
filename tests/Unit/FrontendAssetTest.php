<?php

declare(strict_types=1);

/**
 * @return array<string, string> directory => file extension
 */
function frontendDirectories(): array
{
    return ['vue' => 'vue', 'react' => 'jsx', 'svelte' => 'svelte'];
}

/**
 * @return list<string>
 */
function componentFilesFor(string $directory, string $extension): array
{
    $files = glob(packagePath("resources/js/{$directory}/Ui*.{$extension}")) ?: [];
    $names = array_map(fn (string $path) => basename($path, '.'.$extension), $files);
    sort($names);

    return $names;
}

it('ships the same component names in vue, react and svelte', function () {
    $sets = [];

    foreach (frontendDirectories() as $directory => $extension) {
        $sets[$directory] = componentFilesFor($directory, $extension);
    }

    expect($sets['react'])->toBe($sets['vue'])
        ->and($sets['svelte'])->toBe($sets['vue'])
        ->and($sets['vue'])->not->toBeEmpty();
});

it('exports every component file from the barrel file', function (string $directory) {
    $extension = frontendDirectories()[$directory];
    $barrel = (string) file_get_contents(packagePath("resources/js/{$directory}/index.js"));
    $missing = [];

    foreach (componentFilesFor($directory, $extension) as $component) {
        if (!str_contains($barrel, "./{$component}.{$extension}")) {
            $missing[] = $component;
        }
    }

    expect($missing)->toBe([]);
})->with(array_keys(frontendDirectories()));

it('exports nothing from the barrel file that does not exist', function (string $directory) {
    $extension = frontendDirectories()[$directory];
    $barrel = (string) file_get_contents(packagePath("resources/js/{$directory}/index.js"));
    $components = componentFilesFor($directory, $extension);
    $orphans = [];

    preg_match_all("#\./(Ui\w+)\.{$extension}#", $barrel, $matches);

    foreach ($matches[1] as $exported) {
        if (!in_array($exported, $components, true)) {
            $orphans[] = $exported;
        }
    }

    expect($orphans)->toBe([]);
})->with(array_keys(frontendDirectories()));

it('keeps frontend components off utilities that tailwind v4 removed', function (string $directory) {
    $extension = frontendDirectories()[$directory];
    $removed = ['flex-shrink-', 'flex-grow-', 'bg-opacity-', 'text-opacity-', 'ring-opacity-', 'border-opacity-'];
    $offenders = [];

    foreach (glob(packagePath("resources/js/{$directory}/*.{$extension}")) ?: [] as $path) {
        $contents = (string) file_get_contents($path);

        foreach ($removed as $needle) {
            if (str_contains($contents, $needle)) {
                $offenders[] = basename($path).' uses '.$needle;
            }
        }
    }

    expect($offenders)->toBe([]);
})->with(array_keys(frontendDirectories()));

it('keeps alpine directives out of the framework components', function (string $directory) {
    $extension = frontendDirectories()[$directory];
    $alpineOnly = ['x-data', 'x-show', 'x-cloak', 'click.away'];
    $offenders = [];

    foreach (glob(packagePath("resources/js/{$directory}/*.{$extension}")) ?: [] as $path) {
        $contents = (string) file_get_contents($path);

        foreach ($alpineOnly as $needle) {
            if (str_contains($contents, $needle)) {
                $offenders[] = basename($path).' uses '.$needle;
            }
        }
    }

    expect($offenders)->toBe([]);
})->with(array_keys(frontendDirectories()));

it('keeps blade syntax out of the framework components', function (string $directory) {
    $extension = frontendDirectories()[$directory];
    $offenders = [];

    foreach (glob(packagePath("resources/js/{$directory}/*.{$extension}")) ?: [] as $path) {
        $contents = (string) file_get_contents($path);

        if (preg_match('/@(if|endif|foreach|endforeach|php|endphp)\b/', $contents) === 1) {
            $offenders[] = basename($path);
        }
    }

    expect($offenders)->toBe([]);
})->with(array_keys(frontendDirectories()));

it('gives every switch an accessible name when a label is supplied', function (string $directory) {
    $extension = frontendDirectories()[$directory];
    $contents = (string) file_get_contents(packagePath("resources/js/{$directory}/UiToggle.{$extension}"));

    expect($contents)->toContain('aria-labelledby')
        ->and($contents)->toContain('role="switch"');
})->with(array_keys(frontendDirectories()));

it('makes every switch a focusable native button', function (string $directory) {
    $extension = frontendDirectories()[$directory];
    $contents = (string) file_get_contents(packagePath("resources/js/{$directory}/UiToggle.{$extension}"));

    expect($contents)->toContain('<button')
        ->and($contents)->toContain('disabled');
})->with(array_keys(frontendDirectories()));

it('announces dropdown state in every frontend', function (string $directory) {
    $extension = frontendDirectories()[$directory];
    $contents = (string) file_get_contents(packagePath("resources/js/{$directory}/UiDropdown.{$extension}"));

    expect($contents)->toContain('aria-expanded')
        ->and($contents)->toContain('aria-haspopup')
        ->and($contents)->toContain('role="menu"');
})->with(array_keys(frontendDirectories()));

it('closes every dropdown on an outside click', function (string $directory) {
    $extension = frontendDirectories()[$directory];
    $contents = (string) file_get_contents(packagePath("resources/js/{$directory}/UiDropdown.{$extension}"));

    expect($contents)->toContain('mousedown');
})->with(array_keys(frontendDirectories()));

it('keeps the vue components off apis newer than the documented vue 3 baseline', function () {
    $offenders = [];

    foreach (glob(packagePath('resources/js/vue/*.vue')) ?: [] as $path) {
        if (str_contains((string) file_get_contents($path), 'useId')) {
            $offenders[] = basename($path);
        }
    }

    expect($offenders)->toBe([]);
});

it('does not impose button semantics on a supplied dropdown trigger', function (string $directory) {
    $extension = frontendDirectories()[$directory];
    $contents = (string) file_get_contents(packagePath("resources/js/{$directory}/UiDropdown.{$extension}"));

    expect($contents)->not->toContain('role="button"')
        ->and($contents)->toContain('<button');
})->with(array_keys(frontendDirectories()));
