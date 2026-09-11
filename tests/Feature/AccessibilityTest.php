<?php

declare(strict_types=1);

it('labels the alert dismiss control', function (string $framework) {
    useCssFramework($framework);

    $this->blade('<x-ui::alert dismissible>Saved</x-ui::alert>')
        ->assertSee('role="alert"', false)
        ->assertSee('aria-label="Dismiss"', false);
})->with(cssFrameworks());

it('marks an invalid input and points it at the error message', function (string $framework) {
    useCssFramework($framework);

    $this->blade('<x-ui::input name="email" label="Email" error="Email is required" />')
        ->assertSee('aria-invalid="true"', false)
        ->assertSee('Email is required');
})->with(cssFrameworks());

it('describes a hinted input', function () {
    useCssFramework('tailwind');

    $this->blade('<x-ui::input id="email" name="email" hint="Work address only" />')
        ->assertSee('aria-describedby="email-hint"', false)
        ->assertSee('id="email-hint"', false);
});

it('marks the current breadcrumb', function (string $framework) {
    useCssFramework($framework);

    $this->blade('<x-ui::breadcrumbs :items="[[\'label\' => \'Users\', \'url\' => \'/users\'], [\'label\' => \'Ada\']]" />')
        ->assertSee('aria-current="page"', false);
})->with(cssFrameworks());

it('gives the modal a dialog role tied to its title', function () {
    useCssFramework('tailwind');

    $this->blade('<x-ui::modal id="edit" title="Edit user">Body</x-ui::modal>')
        ->assertSee('role="dialog"', false)
        ->assertSee('aria-modal="true"', false)
        ->assertSee('aria-labelledby="modal-title-edit"', false)
        ->assertSee('id="modal-title-edit"', false);
});

it('announces dropdown state and menu role', function (string $framework) {
    useCssFramework($framework);

    $this->blade('<x-ui::dropdown label="Actions">items</x-ui::dropdown>')
        ->assertSee('aria-haspopup', false)
        ->assertSee('aria-expanded', false);
})->with(cssFrameworks());

it('exposes the toggle as a switch', function (string $framework) {
    useCssFramework($framework);

    $this->blade('<x-ui::toggle name="active" label="Active" />')
        ->assertSee('role="switch"', false);
})->with(cssFrameworks());

it('wires tab buttons to their panels', function () {
    useCssFramework('tailwind');

    $this->blade('<x-ui::tabs id="settings" :tabs="[\'general\' => \'General\']" />')
        ->assertSee('role="tablist"', false)
        ->assertSee('role="tab"', false)
        ->assertSee('aria-controls="settings-panel-general"', false);
});

it('labels the search field for screen readers', function (string $framework) {
    useCssFramework($framework);

    $this->blade('<x-ui::search-input id="q" placeholder="Find users" />')
        ->assertSee('for="q"', false);
})->with(cssFrameworks());

it('hides decorative icons from assistive technology', function (string $framework) {
    useCssFramework($framework);

    $this->blade('<x-ui::icon name="user" />')
        ->assertSee('aria-hidden="true"', false);
})->with(cssFrameworks());

it('exposes an icon that is given a label', function () {
    useCssFramework('tailwind');

    $this->blade('<x-ui::icon name="user" aria-label="Account" />')
        ->assertSee('aria-hidden="false"', false)
        ->assertSee('aria-label="Account"', false);
});

it('marks a disabled button as disabled for assistive technology', function (string $framework) {
    useCssFramework($framework);

    $this->blade('<x-ui::button disabled>Save</x-ui::button>')
        ->assertSee('aria-disabled="true"', false);
})->with(cssFrameworks());

it('marks a loading button as busy', function (string $framework) {
    useCssFramework($framework);

    $this->blade('<x-ui::button loading>Save</x-ui::button>')
        ->assertSee('aria-busy="true"', false);
})->with(cssFrameworks());

it('keeps a disabled link out of the tab order', function () {
    useCssFramework('tailwind');

    $this->blade('<x-ui::button href="/reports" disabled>Reports</x-ui::button>')
        ->assertSee('tabindex="-1"', false);
});

it('announces the sort direction of a sortable column', function () {
    useCssFramework('tailwind');

    $this->blade('<x-ui::data-table :headers="[\'name\' => \'Name\']" />')
        ->assertSee('aria-sort', false);
});

it('announces the password strength politely', function (string $framework) {
    useCssFramework($framework);

    $this->blade('<x-ui::password-input name="password" />')
        ->assertSee('aria-live="polite"', false)
        ->assertSee('Password strength');
})->with(cssFrameworks());

it('respects reduced motion in the tailwind templates', function () {
    $withTransitions = [];
    $withoutReducedMotion = [];

    foreach (glob(packagePath('resources/views/tailwind/components/*.blade.php')) ?: [] as $path) {
        $contents = (string) file_get_contents($path);

        if (!str_contains($contents, 'transition-colors') && !str_contains($contents, 'transition-shadow')) {
            continue;
        }

        $withTransitions[] = basename($path);

        if (!str_contains($contents, 'motion-reduce:')) {
            $withoutReducedMotion[] = basename($path);
        }
    }

    expect($withTransitions)->not->toBeEmpty()
        ->and($withoutReducedMotion)->toBe([]);
});
