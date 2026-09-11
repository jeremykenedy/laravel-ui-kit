<?php

declare(strict_types=1);

/**
 * Flatten a translation array into dot notation so locales can be compared key by key.
 *
 * @param  array<string, mixed>  $translations
 * @return list<string>
 */
function flattenKeys(array $translations, string $prefix = ''): array
{
    $keys = [];

    foreach ($translations as $key => $value) {
        if (is_array($value)) {
            $keys = array_merge($keys, flattenKeys($value, $prefix.$key.'.'));

            continue;
        }

        $keys[] = $prefix.$key;
    }

    sort($keys);

    return $keys;
}

/**
 * @return list<string>
 */
function availableLocales(): array
{
    $directories = glob(packagePath('resources/lang/*'), GLOB_ONLYDIR) ?: [];

    return array_map(fn (string $path) => basename($path), $directories);
}

it('ships more than one locale', function () {
    expect(availableLocales())->toHaveCount(42);
});

it('gives every locale the same keys as english', function () {
    $english = flattenKeys(require packagePath('resources/lang/en/ui-kit.php'));
    $mismatched = [];

    foreach (availableLocales() as $locale) {
        $keys = flattenKeys(require packagePath("resources/lang/{$locale}/ui-kit.php"));

        if ($keys !== $english) {
            $mismatched[$locale] = [
                'missing' => array_values(array_diff($english, $keys)),
                'extra'   => array_values(array_diff($keys, $english)),
            ];
        }
    }

    expect($mismatched)->toBe([]);
});

it('leaves no translation value empty', function () {
    $empty = [];

    foreach (availableLocales() as $locale) {
        $translations = require packagePath("resources/lang/{$locale}/ui-kit.php");

        array_walk_recursive($translations, function ($value, $key) use (&$empty, $locale) {
            if (!is_string($value) || trim($value) === '') {
                $empty[] = "{$locale}.{$key}";
            }
        });
    }

    expect($empty)->toBe([]);
});

it('resolves the keys the components actually use', function () {
    $used = [
        'ui-kit::ui-kit.alert.dismiss',
        'ui-kit::ui-kit.breadcrumbs.home',
        'ui-kit::ui-kit.dark_mode.light',
        'ui-kit::ui-kit.dark_mode.dark',
        'ui-kit::ui-kit.dark_mode.system',
        'ui-kit::ui-kit.dropdown.toggle',
        'ui-kit::ui-kit.modal.close',
        'ui-kit::ui-kit.nav.toggle',
        'ui-kit::ui-kit.pagination.next',
        'ui-kit::ui-kit.pagination.of',
        'ui-kit::ui-kit.pagination.previous',
        'ui-kit::ui-kit.pagination.results',
        'ui-kit::ui-kit.pagination.showing',
        'ui-kit::ui-kit.pagination.to',
        'ui-kit::ui-kit.password.hide',
        'ui-kit::ui-kit.password.show',
        'ui-kit::ui-kit.password.strength.label',
        'ui-kit::ui-kit.search.clear',
        'ui-kit::ui-kit.search.no_results',
        'ui-kit::ui-kit.search.placeholder',
        'ui-kit::ui-kit.table.empty',
    ];

    foreach ($used as $key) {
        expect(__($key))->not->toBe($key, "Translation key {$key} does not resolve");
    }
});

it('translates component output when the locale changes', function () {
    app()->setLocale('es');

    expect(__('ui-kit::ui-kit.alert.dismiss'))->toBe('Descartar')
        ->and(__('ui-kit::ui-kit.modal.close'))->toBe('Cerrar');
});

it('uses the active locale in rendered markup', function () {
    app()->setLocale('fr');

    $this->blade('<x-ui::alert dismissible>Bonjour</x-ui::alert>')
        ->assertSee(__('ui-kit::ui-kit.alert.dismiss'), false);
});
