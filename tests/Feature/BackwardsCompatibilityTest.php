<?php

declare(strict_types=1);

use Jeremykenedy\LaravelUiKit\Components\Breadcrumbs;
use Jeremykenedy\LaravelUiKit\Components\Button;
use Jeremykenedy\LaravelUiKit\Components\DataTable;
use Jeremykenedy\LaravelUiKit\Components\Icon;
use Jeremykenedy\LaravelUiKit\Components\PasswordInput;
use Jeremykenedy\LaravelUiKit\Components\ThemeToggle;
use Jeremykenedy\LaravelUiKit\Console\PackageInstallCommand;
use Jeremykenedy\LaravelUiKit\Contracts\ComponentContract;
use Jeremykenedy\LaravelUiKit\Facades\UiKit;

/**
 * These cover the public surface that applications already depend on. A change here
 * means a consuming application breaks on upgrade, so each one is deliberate.
 */
it('keeps every documented component class', function (string $class) {
    expect(class_exists('Jeremykenedy\\LaravelUiKit\\Components\\'.$class))->toBeTrue();
})->with([
    'Alert', 'Avatar', 'Badge', 'Breadcrumbs', 'Button', 'Card', 'Checkbox', 'Confirm',
    'DataTable', 'Dropdown', 'FormGroup', 'Icon', 'Input', 'Modal', 'Nav', 'Pagination',
    'PasswordInput', 'SearchInput', 'Select', 'StatCard', 'StatusPanel', 'Tabs',
    'Textarea', 'ThemeToggle', 'Toggle',
]);

it('keeps every component render method returning a view', function (string $class) {
    $fqcn = 'Jeremykenedy\\LaravelUiKit\\Components\\'.$class;
    $method = new ReflectionMethod($fqcn, 'render');

    expect((string) $method->getReturnType())->toBe('Illuminate\\Contracts\\View\\View')
        ->and(is_subclass_of($fqcn, ComponentContract::class))->toBeTrue();
})->with([
    'Alert', 'Avatar', 'Badge', 'Breadcrumbs', 'Button', 'Card', 'Checkbox', 'Confirm',
    'DataTable', 'Dropdown', 'FormGroup', 'Icon', 'Input', 'Modal', 'Nav', 'Pagination',
    'PasswordInput', 'SearchInput', 'Select', 'StatCard', 'StatusPanel', 'Tabs',
    'Textarea', 'ThemeToggle', 'Toggle',
]);

it('keeps the abstract install command available for packages that extend it', function () {
    expect(class_exists(PackageInstallCommand::class))->toBeTrue()
        ->and((new ReflectionClass(PackageInstallCommand::class))->isAbstract())->toBeTrue();
});

it('keeps every facade method resolvable', function (string $method) {
    expect(method_exists(UiKit::getFacadeRoot(), $method))->toBeTrue();
})->with([
    'cssFramework', 'frontend', 'iconSet', 'prefix', 'darkModeEnabled', 'darkModeDefault',
    'isTailwind', 'isBootstrap5', 'isBootstrap4', 'confirmDefaults', 'passwordDefaults', 'toastDefaults',
]);

it('keeps the documented component defaults', function () {
    $button = new Button();

    expect($button->variant)->toBe('primary')
        ->and($button->size)->toBe('md')
        ->and($button->type)->toBe('button')
        ->and($button->iconPosition)->toBe('left')
        ->and($button->disabled)->toBeFalse()
        ->and($button->loading)->toBeFalse();
});

it('keeps the icon helper methods other packages call', function () {
    $icon = new Icon(name: 'user');

    expect($icon->sizeClasses())->toBe('w-5 h-5')
        ->and($icon->resolvedClass())->toBe('lucide-user')
        ->and($icon->iconSet())->toBe('lucide');
});

it('accepts an unknown icon name without failing', function () {
    $icon = new Icon(name: 'not-a-real-icon');

    expect($icon->hasPath())->toBeFalse()
        ->and($icon->path())->toContain('<path');
});

it('renders the component markup applications already ship', function () {
    $this->blade(<<<'BLADE'
        <x-ui::card title="Dashboard" hoverable>
            <x-ui::stat-card label="Users" value="1,234" icon="users" />
            <x-ui::button variant="primary">Save</x-ui::button>
            <x-ui::alert variant="success" dismissible>Settings saved.</x-ui::alert>
            <x-ui::input name="email" label="Email" type="email" required />
            <x-ui::select name="role" label="Role" :options="['admin' => 'Admin']" />
            <x-ui::toggle name="active" label="Active" />
        </x-ui::card>
        <x-ui::modal id="confirm-delete" title="Confirm"><p>Are you sure?</p></x-ui::modal>
        BLADE)
        ->assertSee('Dashboard')
        ->assertSee('1,234')
        ->assertSee('Save')
        ->assertSee('Settings saved.')
        ->assertSee('Are you sure?');
});

it('renders the theme toggle without a persistence route configured', function (string $framework) {
    useCssFramework($framework);
    config(['ui-kit.dark_mode.persist_route' => null, 'ui-kit.dark_mode.persist_url' => null]);

    $this->blade('<x-ui::theme-toggle />')->assertSee('Light');
})->with(cssFrameworks());

it('ignores a persistence route that is not registered', function () {
    config(['ui-kit.dark_mode.persist_route' => 'profile.dark-mode']);

    expect((new ThemeToggle())->persistUrl())->toBeNull();
});

it('uses a persistence url when one is configured', function () {
    config(['ui-kit.dark_mode.persist_url' => '/settings/theme']);

    expect((new ThemeToggle())->persistUrl())->toBe('/settings/theme');
});

it('keeps the confirm target on the value applications already pass', function () {
    expect((new Button(confirmAction: 'deleteModal'))->confirmTargetId())->toBe('deleteModal')
        ->and((new Button())->confirmTargetId())->toBe('confirmModal')
        ->and((new Button(confirmAction: 'delete-form', confirmTarget: 'warningModal'))->confirmTargetId())->toBe('warningModal');
});

it('renders a real icon in every css framework rather than an empty sprite', function (string $framework) {
    useCssFramework($framework);

    $this->blade('<x-ui::icon name="user" />')
        ->assertSee('<path', false)
        ->assertDontSee('<use', false);
})->with(cssFrameworks());

it('submits a multiple select as an array', function (string $framework) {
    useCssFramework($framework);

    $this->blade('<x-ui::select name="roles" multiple :options="[\'admin\' => \'Admin\']" />')
        ->assertSee('name="roles[]"', false);
})->with(cssFrameworks());

it('keeps a single select name untouched', function (string $framework) {
    useCssFramework($framework);

    $this->blade('<x-ui::select name="role" :options="[\'admin\' => \'Admin\']" />')
        ->assertSee('name="role"', false);
})->with(cssFrameworks());

it('keeps the default breadcrumb home target', function () {
    expect((new Breadcrumbs())->resolvedHomeUrl())->toBe(url('/home'));
});

it('lets the breadcrumb home target be overridden', function () {
    config(['ui-kit.breadcrumbs.home_url' => '/dashboard']);

    expect((new Breadcrumbs())->resolvedHomeUrl())->toBe(url('/dashboard'))
        ->and((new Breadcrumbs(homeUrl: '/root'))->resolvedHomeUrl())->toBe('/root');
});

it('does not render a navigable link for a disabled button', function (string $framework) {
    useCssFramework($framework);

    $this->blade('<x-ui::button href="/reports" disabled>Reports</x-ui::button>')
        ->assertDontSee('href="/reports"', false)
        ->assertSee('aria-disabled="true"', false);
})->with(cssFrameworks());

it('keeps the link on an enabled button', function (string $framework) {
    useCssFramework($framework);

    $this->blade('<x-ui::button href="/reports">Reports</x-ui::button>')
        ->assertSee('href="/reports"', false);
})->with(cssFrameworks());

it('does not wire the confirm dialog to a disabled button', function (string $framework) {
    useCssFramework($framework);

    $this->blade('<x-ui::button confirm="Sure?" disabled>Delete</x-ui::button>')
        ->assertDontSee('open-confirm', false)
        ->assertDontSee('data-confirm-message', false);
})->with(cssFrameworks());

it('passes consumer attributes to the search control itself', function (string $framework) {
    useCssFramework($framework);

    $this->blade('<x-ui::search-input data-testid="user-search" />')
        ->assertSee('data-testid="user-search"', false);
})->with(cssFrameworks());

it('applies the datatable config when the attribute is not given', function () {
    config(['ui-kit.datatable.searchable' => false, 'ui-kit.datatable.sortable' => false]);

    $component = new DataTable();

    expect($component->searchable)->toBeFalse()
        ->and($component->sortable)->toBeFalse();
});

it('lets an explicit datatable attribute win over the config', function () {
    config(['ui-kit.datatable.searchable' => false, 'ui-kit.datatable.sortable' => false]);

    $component = new DataTable(searchable: true, sortable: true);

    expect($component->searchable)->toBeTrue()
        ->and($component->sortable)->toBeTrue();
});

it('keeps the datatable defaults when nothing is configured', function () {
    $component = new DataTable();

    expect($component->searchable)->toBeTrue()
        ->and($component->sortable)->toBeTrue();
});

it('applies the password config when the attribute is not given', function () {
    config(['ui-kit.password.strength_meter' => false, 'ui-kit.password.show_hide' => false]);

    $component = new PasswordInput();

    expect($component->strengthMeter)->toBeFalse()
        ->and($component->showHide)->toBeFalse();
});

it('lets an explicit password attribute win over the config', function () {
    config(['ui-kit.password.strength_meter' => false, 'ui-kit.password.show_hide' => false]);

    $component = new PasswordInput(strengthMeter: true, showHide: true);

    expect($component->strengthMeter)->toBeTrue()
        ->and($component->showHide)->toBeTrue();
});

it('hides the strength meter in the markup when the config disables it', function (string $framework) {
    useCssFramework($framework);
    config(['ui-kit.password.strength_meter' => false]);

    $this->blade('<x-ui::password-input name="password" />')
        ->assertDontSee('Password strength');
})->with(cssFrameworks());

it('keeps a caller supplied toggle colour out of the alpine expression', function () {
    useCssFramework('tailwind');

    $this->blade('<x-ui::toggle name="active" on-color="not-a-colour\' + alert(1) + \'" />')
        ->assertDontSee('alert(1)', false)
        ->assertSee('bg-blue-600', false);
});

it('renders the requested toggle colour when it is a known one', function () {
    useCssFramework('tailwind');

    $this->blade('<x-ui::toggle name="active" on-color="green" />')
        ->assertSee('bg-green-600', false);
});
