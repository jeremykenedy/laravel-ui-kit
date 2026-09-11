<?php

declare(strict_types=1);

use Jeremykenedy\LaravelUiKit\Livewire\UiAlert;
use Jeremykenedy\LaravelUiKit\Livewire\UiConfirm;
use Jeremykenedy\LaravelUiKit\Livewire\UiDataTable;
use Jeremykenedy\LaravelUiKit\Livewire\UiDropdown;
use Jeremykenedy\LaravelUiKit\Livewire\UiModal;
use Jeremykenedy\LaravelUiKit\Livewire\UiNav;
use Jeremykenedy\LaravelUiKit\Livewire\UiPagination;
use Jeremykenedy\LaravelUiKit\Livewire\UiPasswordInput;
use Jeremykenedy\LaravelUiKit\Livewire\UiSearchInput;
use Jeremykenedy\LaravelUiKit\Livewire\UiTabs;
use Jeremykenedy\LaravelUiKit\Livewire\UiThemeToggle;
use Jeremykenedy\LaravelUiKit\Livewire\UiToggle;
use Jeremykenedy\LaravelUiKit\Providers\UiKitServiceProvider;
use Livewire\Livewire;

it('mounts every livewire component by alias', function () {
    $aliases = array_keys(UiKitServiceProvider::LIVEWIRE_COMPONENTS);

    foreach ($aliases as $alias) {
        Livewire::test($alias)->assertOk();
    }

    expect($aliases)->toHaveCount(24);
});

it('mounts every livewire component under each css framework', function (string $framework) {
    useCssFramework($framework);
    $rendered = 0;

    foreach (UiKitServiceProvider::LIVEWIRE_COMPONENTS as $class) {
        Livewire::test($class)->assertOk();
        $rendered++;
    }

    expect($rendered)->toBe(24);
})->with(cssFrameworks());

it('hides the alert once it is dismissed', function () {
    Livewire::test(UiAlert::class, ['content' => 'Saved'])
        ->assertSee('Saved')
        ->assertSet('visible', true)
        ->call('dismiss')
        ->assertSet('visible', false);
});

it('opens and closes the modal through its listeners', function () {
    Livewire::test(UiModal::class)
        ->assertSet('show', false)
        ->dispatch('open-modal', title: 'Delete record')
        ->assertSet('show', true)
        ->assertSet('title', 'Delete record')
        ->dispatch('close-modal')
        ->assertSet('show', false);
});

it('dispatches the action when the confirm dialog is accepted', function () {
    Livewire::test(UiConfirm::class)
        ->dispatch('confirm-action', title: 'Delete', message: 'Sure?', action: 'delete-user')
        ->assertSet('show', true)
        ->call('confirmed')
        ->assertSet('show', false)
        ->assertDispatched('confirmed', action: 'delete-user');
});

it('leaves the action undispatched when the confirm dialog is cancelled', function () {
    Livewire::test(UiConfirm::class)
        ->dispatch('confirm-action', title: 'Delete', message: 'Sure?', action: 'delete-user')
        ->call('cancelled')
        ->assertSet('show', false)
        ->assertNotDispatched('confirmed');
});

it('flips the sort direction when the same column is sorted twice', function () {
    Livewire::test(UiDataTable::class, ['headers' => ['name', 'email']])
        ->call('sortBy', 'name')
        ->assertSet('sortField', 'name')
        ->assertSet('sortDirection', 'asc')
        ->call('sortBy', 'name')
        ->assertSet('sortDirection', 'desc')
        ->call('sortBy', 'email')
        ->assertSet('sortField', 'email')
        ->assertSet('sortDirection', 'asc');
});

it('renders data table rows against the declared headers', function () {
    Livewire::test(UiDataTable::class, [
        'headers' => ['name', 'email'],
        'rows'    => [['name' => 'Ada', 'email' => 'ada@example.com']],
    ])
        ->assertSee('Ada')
        ->assertSee('ada@example.com');
});

it('shows the empty message when the data table has no rows', function () {
    Livewire::test(UiDataTable::class, ['headers' => ['name']])
        ->assertSee('No records found.');
});

it('clamps pagination to the available page range', function () {
    $component = Livewire::test(UiPagination::class, ['currentPage' => 2, 'lastPage' => 5, 'total' => 50, 'perPage' => 10]);

    $component->call('goToPage', 0)->assertSet('currentPage', 1);
    $component->call('goToPage', 99)->assertSet('currentPage', 5);
    $component->call('goToPage', 3)->assertSet('currentPage', 3)->assertDispatched('page-changed', page: 3);
});

it('toggles the switch and announces the new state', function () {
    Livewire::test(UiToggle::class, ['name' => 'notifications'])
        ->assertSet('checked', false)
        ->call('toggle')
        ->assertSet('checked', true)
        ->assertDispatched('toggled', checked: true, name: 'notifications');
});

it('refuses to toggle a disabled switch', function () {
    Livewire::test(UiToggle::class, ['checked' => true, 'disabled' => true])
        ->call('toggle')
        ->assertSet('checked', true)
        ->assertNotDispatched('toggled');
});

it('clears the search query and tells listeners', function () {
    Livewire::test(UiSearchInput::class)
        ->set('query', 'ada')
        ->assertDispatched('search', query: 'ada')
        ->call('clear')
        ->assertSet('query', '')
        ->assertDispatched('search', query: '');
});

it('selects the first tab on mount and switches on demand', function () {
    Livewire::test(UiTabs::class, ['tabs' => ['Profile', 'Billing'], 'panels' => ['Profile' => 'Profile body']])
        ->assertSet('activeTab', 'Profile')
        ->assertSee('Profile body')
        ->call('selectTab', 'Billing')
        ->assertSet('activeTab', 'Billing')
        ->assertDispatched('tab-changed', tab: 'Billing');
});

it('opens and closes the dropdown', function () {
    Livewire::test(UiDropdown::class, ['items' => [['label' => 'Edit', 'url' => '/edit']]])
        ->assertSet('open', false)
        ->call('toggle')
        ->assertSet('open', true)
        ->assertSee('Edit')
        ->call('close')
        ->assertSet('open', false);
});

it('toggles the mobile nav', function () {
    Livewire::test(UiNav::class, ['brand' => 'Acme', 'links' => [['label' => 'Docs', 'url' => '/docs']]])
        ->assertSee('Acme')
        ->assertSet('mobileOpen', false)
        ->call('toggleMobile')
        ->assertSet('mobileOpen', true);
});

it('accepts only the three known theme modes', function () {
    $component = Livewire::test(UiThemeToggle::class)->assertSet('current', 'system');

    $component->call('setTheme', 'dark')->assertSet('current', 'dark')->assertDispatched('theme-changed', mode: 'dark');
    $component->call('setTheme', 'sepia')->assertSet('current', 'dark');
});

it('closes the theme menu after a mode is chosen', function () {
    Livewire::test(UiThemeToggle::class)
        ->set('menuOpen', true)
        ->call('setTheme', 'light')
        ->assertSet('menuOpen', false);
});

it('reveals and hides the password', function () {
    Livewire::test(UiPasswordInput::class)
        ->assertSet('showPassword', false)
        ->call('toggleVisibility')
        ->assertSet('showPassword', true)
        ->call('toggleVisibility')
        ->assertSet('showPassword', false);
});

it('encodes data table headers that contain quotes', function () {
    Livewire::test(UiDataTable::class, ['headers' => ["Owner's name"]])
        ->assertOk()
        ->assertSee('Owner\\u0027s name', false);
});

it('encodes tab labels that contain quotes', function () {
    Livewire::test(UiTabs::class, ['tabs' => ["Owner's tab"]])
        ->assertOk()
        ->assertSet('activeTab', "Owner's tab");
});

it('starts on the first tab when given an associative array', function () {
    Livewire::test(UiTabs::class, ['tabs' => ['general' => 'General', 'billing' => 'Billing']])
        ->assertSet('activeTab', 'General');
});

it('switches the password input type when the livewire action runs', function () {
    Livewire::test(UiPasswordInput::class)
        ->assertSee('type="password"', false)
        ->call('toggleVisibility')
        ->assertSee('type="text"', false);
});

it('ships the client side theme script with the livewire theme toggle', function () {
    $scripts = json_encode(Livewire::test(UiThemeToggle::class)->effects['scripts'] ?? []);

    expect($scripts)->toContain('classList.toggle(')
        ->and($scripts)->toContain('localStorage')
        ->and($scripts)->toContain('theme-changed');
});
