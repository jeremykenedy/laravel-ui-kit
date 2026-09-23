<?php

declare(strict_types=1);

use Illuminate\Support\Facades\File;

it('renders the browser fixture with the selected css framework', function (string $framework) {
    useCssFramework($framework);
    $page = $this->blade(file_get_contents(packagePath('tests/Browser/fixtures/blade.blade.php')), ['framework' => $framework]);
    $page->assertSee('Account settings')->assertSee('Profile saved');

    File::ensureDirectoryExists(packagePath('tests/Browser/dist'));
    File::put(packagePath("tests/Browser/dist/{$framework}.html"), (string) $page);
})->with(cssFrameworks());
