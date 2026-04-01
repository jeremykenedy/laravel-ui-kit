<?php

use Jeremykenedy\LaravelUiKit\Components\Alert;
use Jeremykenedy\LaravelUiKit\Components\Avatar;
use Jeremykenedy\LaravelUiKit\Components\Badge;
use Jeremykenedy\LaravelUiKit\Components\Button;
use Jeremykenedy\LaravelUiKit\Components\Card;
use Jeremykenedy\LaravelUiKit\Components\Input;

// Button Component
it('renders a button with default props', function () {
    $view = $this->blade('<x-ui::button>Click me</x-ui::button>');
    $view->assertSee('Click me');
    $view->assertSee('button');
});

it('renders a button with variant classes', function () {
    $component = new Button(variant: 'danger');
    expect($component->variantClasses())->toContain('bg-red-600');
});

it('renders a button as a link when href is provided', function () {
    $view = $this->blade('<x-ui::button href="/test">Link</x-ui::button>');
    $view->assertSee('href');
    $view->assertSee('/test');
});

it('renders a disabled button', function () {
    $component = new Button(disabled: true);
    expect($component->baseClasses())->toContain('opacity-50');
    expect($component->baseClasses())->toContain('cursor-not-allowed');
});

it('renders a block button', function () {
    $component = new Button(block: true);
    expect($component->baseClasses())->toContain('w-full');
});

it('renders outline button variant', function () {
    $component = new Button(variant: 'primary', outline: true);
    expect($component->variantClasses())->toContain('border');
});

it('returns correct size classes', function () {
    expect((new Button(size: 'xs'))->sizeClasses())->toContain('text-xs');
    expect((new Button(size: 'sm'))->sizeClasses())->toContain('text-sm');
    expect((new Button(size: 'lg'))->sizeClasses())->toContain('text-base');
    expect((new Button(size: 'xl'))->sizeClasses())->toContain('text-lg');
});

// Alert Component
it('renders an alert with variant classes', function () {
    $component = new Alert(variant: 'success');
    expect($component->variantClasses())->toContain('bg-green-50');
});

it('renders dismissible alert by default', function () {
    $component = new Alert;
    expect($component->dismissible)->toBeTrue();
});

it('renders non-dismissible alert', function () {
    $component = new Alert(dismissible: false);
    expect($component->dismissible)->toBeFalse();
});

// Badge Component
it('renders a badge with variant classes', function () {
    $component = new Badge(variant: 'danger');
    expect($component->variantClasses())->toContain('bg-red-100');
});

it('renders badge with correct sizes', function () {
    expect((new Badge(size: 'sm'))->sizeClasses())->toContain('text-xs');
    expect((new Badge(size: 'lg'))->sizeClasses())->toContain('text-sm');
});

// Card Component
it('renders card with padding classes', function () {
    expect((new Card(padding: 'none'))->paddingClasses())->toBe('');
    expect((new Card(padding: 'sm'))->paddingClasses())->toContain('p-3');
    expect((new Card(padding: 'lg'))->paddingClasses())->toContain('p-6');
});

// Input Component
it('auto-generates id from name', function () {
    $component = new Input(name: 'email');
    expect($component->id)->toBe('email');
});

it('detects errors from session', function () {
    $component = new Input(name: 'email', error: 'Invalid email');
    expect($component->hasError())->toBeTrue();
    expect($component->errorMessage())->toBe('Invalid email');
});

it('returns error input classes when has error', function () {
    $component = new Input(error: 'Bad');
    expect($component->inputClasses())->toContain('border-red-300');
});

it('returns normal input classes when no error', function () {
    $component = new Input;
    expect($component->inputClasses())->toContain('border-gray-300');
});

// Avatar Component
it('computes initials from alt text', function () {
    $component = new Avatar(alt: 'Jeremy Kenedy');
    expect($component->computedInitials())->toBe('JK');
});

it('computes initials from single word', function () {
    $component = new Avatar(alt: 'Admin');
    expect($component->computedInitials())->toBe('A');
});

it('uses explicit initials over alt', function () {
    $component = new Avatar(alt: 'Jeremy Kenedy', initials: 'JD');
    expect($component->computedInitials())->toBe('JD');
});

it('returns status classes', function () {
    expect((new Avatar(status: 'online'))->statusClasses())->toContain('bg-green-500');
    expect((new Avatar(status: 'busy'))->statusClasses())->toContain('bg-red-500');
    expect((new Avatar(status: 'away'))->statusClasses())->toContain('bg-amber-500');
});

it('returns correct avatar size classes', function () {
    expect((new Avatar(size: 'xs'))->sizeClasses())->toContain('h-6');
    expect((new Avatar(size: '2xl'))->sizeClasses())->toContain('h-20');
});
