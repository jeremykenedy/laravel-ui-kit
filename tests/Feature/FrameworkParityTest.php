<?php

declare(strict_types=1);

/**
 * Every component has to render in all three CSS frameworks, and no template may
 * contain classes belonging to a framework other than the one it lives under.
 */
dataset('components', [
    ['alert', '<x-ui::alert variant="success" title="Saved">Your changes are saved.</x-ui::alert>', 'Your changes are saved.'],
    ['avatar', '<x-ui::avatar alt="Jeremy Kenedy" status="online" />', 'JK'],
    ['badge', '<x-ui::badge variant="success" dot>Active</x-ui::badge>', 'Active'],
    ['breadcrumbs', '<x-ui::breadcrumbs :items="[[\'label\' => \'Reports\']]" />', 'Reports'],
    ['button', '<x-ui::button variant="primary" icon="save">Save</x-ui::button>', 'Save'],
    ['card', '<x-ui::card title="Dashboard" subtitle="Overview">Body</x-ui::card>', 'Dashboard'],
    ['checkbox', '<x-ui::checkbox name="agree" label="I agree" description="Required" />', 'I agree'],
    ['confirm', '<x-ui::confirm />', 'Confirm'],
    ['data-table', '<x-ui::data-table :headers="[\'Name\']" />', 'Name'],
    ['dropdown', '<x-ui::dropdown label="Actions" />', 'Actions'],
    ['form-group', '<x-ui::form-group name="email" label="Email" hint="Work address">field</x-ui::form-group>', 'Work address'],
    ['icon', '<x-ui::icon name="user" />', 'svg'],
    ['input', '<x-ui::input name="email" label="Email" type="email" />', 'Email'],
    ['modal', '<x-ui::modal id="demo" title="Demo">Body</x-ui::modal>', 'Demo'],
    ['nav', '<x-ui::nav>links</x-ui::nav>', 'links'],
    ['password-input', '<x-ui::password-input name="password" label="Password" />', 'Password'],
    ['search-input', '<x-ui::search-input placeholder="Find users" />', 'Find users'],
    ['select', '<x-ui::select name="role" label="Role" :options="[\'admin\' => \'Admin\']" />', 'Admin'],
    ['stat-card', '<x-ui::stat-card value="1,234" label="Users" icon="users" />', '1,234'],
    ['status-panel', '<x-ui::status-panel title="Nothing here" message="No records" icon="info" />', 'No records'],
    ['tabs', '<x-ui::tabs :tabs="[\'one\' => \'One\']" />', 'One'],
    ['textarea', '<x-ui::textarea name="bio" label="Bio" :maxlength="200" show-count />', 'Bio'],
    ['theme-toggle', '<x-ui::theme-toggle />', 'Light'],
    ['toggle', '<x-ui::toggle name="active" label="Active" />', 'Active'],
]);

it('renders in tailwind', function (string $name, string $markup, string $expected) {
    useCssFramework('tailwind');

    $this->blade($markup)->assertSee($expected, false);
})->with('components');

it('renders in bootstrap 5', function (string $name, string $markup, string $expected) {
    useCssFramework('bootstrap5');

    $this->blade($markup)->assertSee($expected, false);
})->with('components');

it('renders in bootstrap 4', function (string $name, string $markup, string $expected) {
    useCssFramework('bootstrap4');

    $this->blade($markup)->assertSee($expected, false);
})->with('components');

it('ships the same component set in every css framework', function () {
    $sets = [];

    foreach (cssFrameworks() as $framework) {
        $files = glob(packagePath("resources/views/{$framework}/components/*.blade.php")) ?: [];
        $sets[$framework] = array_map(fn (string $path) => basename($path), $files);
        sort($sets[$framework]);
    }

    expect($sets['bootstrap5'])->toBe($sets['tailwind'])
        ->and($sets['bootstrap4'])->toBe($sets['tailwind'])
        ->and($sets['tailwind'])->not->toBeEmpty();
});

it('keeps bootstrap templates free of tailwind dark mode variants', function (string $framework) {
    $offenders = [];

    foreach (glob(packagePath("resources/views/{$framework}/components/*.blade.php")) ?: [] as $path) {
        if (str_contains((string) file_get_contents($path), 'dark:')) {
            $offenders[] = basename($path);
        }
    }

    expect($offenders)->toBe([]);
})->with(['bootstrap5', 'bootstrap4']);

it('keeps bootstrap 4 templates free of bootstrap 5 only utilities', function () {
    $bootstrap5Only = ['data-bs-', 'btn-close', 'form-select', 'visually-hidden', 'dropdown-menu-end'];
    $offenders = [];

    foreach (glob(packagePath('resources/views/bootstrap4/components/*.blade.php')) ?: [] as $path) {
        $contents = (string) file_get_contents($path);

        foreach ($bootstrap5Only as $needle) {
            if (str_contains($contents, $needle)) {
                $offenders[] = basename($path).' uses '.$needle;
            }
        }
    }

    expect($offenders)->toBe([]);
});

it('keeps bootstrap 5 templates free of bootstrap 4 only utilities', function () {
    $bootstrap4Only = ['data-toggle=', 'data-dismiss=', 'custom-control', 'input-group-prepend', 'input-group-append', 'font-weight-'];
    $offenders = [];

    foreach (glob(packagePath('resources/views/bootstrap5/components/*.blade.php')) ?: [] as $path) {
        $contents = (string) file_get_contents($path);

        foreach ($bootstrap4Only as $needle) {
            if (str_contains($contents, $needle)) {
                $offenders[] = basename($path).' uses '.$needle;
            }
        }
    }

    expect($offenders)->toBe([]);
});

it('cloaks every template that hides elements with x-show', function (string $framework) {
    $offenders = [];

    foreach (glob(packagePath("resources/views/{$framework}/components/*.blade.php")) ?: [] as $path) {
        $contents = (string) file_get_contents($path);

        if (str_contains($contents, 'x-show') && !str_contains($contents, 'x-cloak')) {
            $offenders[] = basename($path);
        }
    }

    expect($offenders)->toBe([]);
})->with(cssFrameworks());

it('keeps tailwind templates off utilities that tailwind v4 removed', function () {
    $removed = ['flex-shrink-', 'flex-grow-', 'bg-opacity-', 'text-opacity-', 'ring-opacity-', 'border-opacity-', 'overflow-ellipsis'];
    $offenders = [];

    foreach (glob(packagePath('resources/views/tailwind/components/*.blade.php')) ?: [] as $path) {
        $contents = (string) file_get_contents($path);

        foreach ($removed as $needle) {
            if (str_contains($contents, $needle)) {
                $offenders[] = basename($path).' uses '.$needle;
            }
        }
    }

    expect($offenders)->toBe([]);
});
