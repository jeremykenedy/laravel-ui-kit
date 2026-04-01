<?php

it('renders a button component', function () {
    $view = $this->blade('<x-ui::button>Submit</x-ui::button>');
    $view->assertSee('Submit');
});

it('renders an alert component', function () {
    $view = $this->blade('<x-ui::alert variant="success">Saved!</x-ui::alert>');
    $view->assertSee('Saved!');
});

it('renders a card component with title', function () {
    $view = $this->blade('<x-ui::card title="My Card">Content</x-ui::card>');
    $view->assertSee('My Card');
    $view->assertSee('Content');
});

it('renders an input component', function () {
    $view = $this->blade('<x-ui::input name="email" label="Email" placeholder="you@example.com" />');
    $view->assertSee('Email');
    $view->assertSee('you@example.com');
});

it('renders a badge component', function () {
    $view = $this->blade('<x-ui::badge variant="success">Active</x-ui::badge>');
    $view->assertSee('Active');
});

it('renders an avatar with initials fallback', function () {
    $view = $this->blade('<x-ui::avatar alt="Jeremy Kenedy" />');
    $view->assertSee('JK');
});

it('renders a checkbox component', function () {
    $view = $this->blade('<x-ui::checkbox name="agree" label="I agree" />');
    $view->assertSee('I agree');
});

it('renders a select component with options', function () {
    $view = $this->blade('<x-ui::select name="role" label="Role" :options="[1 => \'Admin\', 2 => \'User\']" />');
    $view->assertSee('Role');
    $view->assertSee('Admin');
    $view->assertSee('User');
});

it('renders a textarea component', function () {
    $view = $this->blade('<x-ui::textarea name="bio" label="Bio" placeholder="Tell us about yourself" />');
    $view->assertSee('Bio');
});

it('renders a status panel component', function () {
    $view = $this->blade('<x-ui::status-panel title="Success" message="Operation complete" variant="success" />');
    $view->assertSee('Success');
    $view->assertSee('Operation complete');
});

it('renders a toggle component', function () {
    $view = $this->blade('<x-ui::toggle name="notifications" label="Enable notifications" />');
    $view->assertSee('Enable notifications');
});

it('renders a search input component', function () {
    $view = $this->blade('<x-ui::search-input placeholder="Find users..." />');
    $view->assertSee('Find users...');
});

it('renders a form group component', function () {
    $view = $this->blade('<x-ui::form-group label="Username" name="username"><input type="text" /></x-ui::form-group>');
    $view->assertSee('Username');
});

it('loads tailwind views by default', function () {
    expect(config('ui-kit.css_framework'))->toBe('tailwind');
});

it('registers all components', function () {
    $components = [
        'ui::button', 'ui::alert', 'ui::badge', 'ui::card',
        'ui::input', 'ui::modal', 'ui::confirm', 'ui::avatar',
        'ui::checkbox', 'ui::select', 'ui::textarea', 'ui::toggle',
        'ui::search-input', 'ui::form-group', 'ui::status-panel',
    ];

    foreach ($components as $component) {
        $name = str_replace('ui::', '', $component);
        $className = str_replace(' ', '', ucwords(str_replace('-', ' ', $name)));
        $fqcn = 'Jeremykenedy\\LaravelUiKit\\Components\\'.$className;
        expect(view()->exists("components.{$component}") || class_exists($fqcn))->toBeTrue(
            "Component {$component} not found (checked {$fqcn})"
        );
    }
});
