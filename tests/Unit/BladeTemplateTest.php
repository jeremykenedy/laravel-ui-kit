<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Blade;

/**
 * @return list<string>
 */
function shippedTemplates(): array
{
    $templates = [];
    $directory = new RecursiveDirectoryIterator(packagePath('resources/views'));

    foreach (new RecursiveIteratorIterator($directory) as $file) {
        if ($file->isFile() && str_ends_with($file->getFilename(), '.blade.php')) {
            $templates[] = $file->getPathname();
        }
    }

    sort($templates);

    return $templates;
}

it('ships a component template per css framework plus the livewire wrappers', function () {
    $perFramework = count(glob(packagePath('resources/views/tailwind/components/*.blade.php')) ?: []);
    $livewire = count(glob(packagePath('resources/views/livewire/*.blade.php')) ?: []);

    expect($perFramework)->toBe(25)
        ->and($livewire)->toBe(24)
        ->and(shippedTemplates())->toHaveCount(($perFramework * 3) + $livewire);
});

it('compiles every shipped template to valid php', function () {
    $failures = [];
    $scratch = sys_get_temp_dir().'/ui-kit-blade-'.getmypid();

    if (!is_dir($scratch)) {
        mkdir($scratch, 0755, true);
    }

    foreach (shippedTemplates() as $template) {
        $target = $scratch.'/'.md5($template).'.php';
        file_put_contents($target, Blade::compileString((string) file_get_contents($template)));

        $output = [];
        exec('php -l '.escapeshellarg($target).' 2>&1', $output, $status);
        unlink($target);

        if ($status !== 0) {
            $failures[] = str_replace(packagePath().'/', '', $template).': '.implode(' ', $output);
        }
    }

    rmdir($scratch);

    expect($failures)->toBe([]);
});
