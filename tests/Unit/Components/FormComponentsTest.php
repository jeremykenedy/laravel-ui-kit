<?php

use Jeremykenedy\LaravelUiKit\Components\PasswordInput;
use Jeremykenedy\LaravelUiKit\Components\Select;
use Jeremykenedy\LaravelUiKit\Components\Textarea;
use Jeremykenedy\LaravelUiKit\Components\Checkbox;
use Jeremykenedy\LaravelUiKit\Components\FormGroup;
use Jeremykenedy\LaravelUiKit\Components\SearchInput;
use Jeremykenedy\LaravelUiKit\Components\Icon;
use Jeremykenedy\LaravelUiKit\Components\StatusPanel;

// PasswordInput Component
it('auto-generates password input id from name', function () {
    $component = new PasswordInput(name: 'user_password');
    expect($component->id)->toBe('user_password');
});

it('loads password strength messages from config', function () {
    config(['ui-kit.password.messages.strong' => 'Very Strong!']);
    $component = new PasswordInput();
    expect($component->strengthMessages()['strong'])->toBe('Very Strong!');
});

it('loads min length from config', function () {
    config(['ui-kit.password.min_length' => 12]);
    $component = new PasswordInput();
    expect($component->minLength())->toBe(12);
});

it('defaults to strength meter and show/hide enabled', function () {
    $component = new PasswordInput();
    expect($component->strengthMeter)->toBeTrue();
    expect($component->showHide)->toBeTrue();
});

// Select Component
it('auto-generates select id from name', function () {
    $component = new Select(name: 'role_id');
    expect($component->id)->toBe('role_id');
});

it('detects select errors', function () {
    $component = new Select(name: 'role', error: 'Required');
    expect($component->hasError())->toBeTrue();
    expect($component->errorMessage())->toBe('Required');
});

// Textarea Component
it('auto-generates textarea id from name', function () {
    $component = new Textarea(name: 'bio');
    expect($component->id)->toBe('bio');
});

it('defaults to 4 rows', function () {
    $component = new Textarea();
    expect($component->rows)->toBe(4);
});

// Checkbox Component
it('auto-generates checkbox id from name', function () {
    $component = new Checkbox(name: 'agree_terms');
    expect($component->id)->toBe('agree_terms');
});

it('defaults value to 1', function () {
    $component = new Checkbox();
    expect($component->value)->toBe('1');
});

// FormGroup Component
it('detects form group errors', function () {
    $component = new FormGroup(name: 'email', error: 'Invalid');
    expect($component->hasError())->toBeTrue();
});

// SearchInput Component
it('defaults to search placeholder', function () {
    $component = new SearchInput();
    expect($component->placeholder)->toBe('Search...');
});

it('defaults to clearable', function () {
    $component = new SearchInput();
    expect($component->clearable)->toBeTrue();
});

it('defaults to 300ms debounce', function () {
    $component = new SearchInput();
    expect($component->debounce)->toBe(300);
});

// Icon Component
it('resolves fontawesome icon class', function () {
    config(['ui-kit.icons' => 'fontawesome']);
    $component = new Icon(name: 'user');
    expect($component->resolvedClass())->toBe('fa fa-user');
});

it('resolves lucide icon class', function () {
    config(['ui-kit.icons' => 'lucide']);
    $component = new Icon(name: 'user');
    expect($component->resolvedClass())->toBe('lucide-user');
});

it('returns correct icon size classes', function () {
    expect((new Icon(name: 'x', size: 'xs'))->sizeClasses())->toContain('w-3');
    expect((new Icon(name: 'x', size: 'xl'))->sizeClasses())->toContain('w-8');
});

// StatusPanel Component
it('returns correct status variant classes', function () {
    expect((new StatusPanel(variant: 'success'))->variantClasses())->toContain('text-green-600');
    expect((new StatusPanel(variant: 'danger'))->variantClasses())->toContain('text-red-600');
    expect((new StatusPanel(variant: 'warning'))->variantClasses())->toContain('text-amber-600');
});

it('defaults to centered', function () {
    $component = new StatusPanel();
    expect($component->centered)->toBeTrue();
});
