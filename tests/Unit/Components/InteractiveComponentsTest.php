<?php

use Jeremykenedy\LaravelUiKit\Components\Confirm;
use Jeremykenedy\LaravelUiKit\Components\Dropdown;
use Jeremykenedy\LaravelUiKit\Components\Modal;
use Jeremykenedy\LaravelUiKit\Components\Toggle;

// Modal Component
it('returns correct modal size classes', function () {
    expect((new Modal(size: 'sm'))->sizeClasses())->toContain('sm:max-w-sm');
    expect((new Modal(size: 'lg'))->sizeClasses())->toContain('sm:max-w-2xl');
    expect((new Modal(size: 'xl'))->sizeClasses())->toContain('sm:max-w-4xl');
    expect((new Modal(size: 'full'))->sizeClasses())->toContain('sm:max-w-full');
});

it('defaults to closeable modal', function () {
    $component = new Modal;
    expect($component->closeable)->toBeTrue();
    expect($component->static)->toBeFalse();
});

// Confirm Component
it('loads confirm defaults from config', function () {
    config(['ui-kit.confirm.default_title' => 'Are you sure?']);
    $component = new Confirm;
    expect($component->title)->toBe('Are you sure?');
});

it('accepts custom confirm text', function () {
    $component = new Confirm(title: 'Custom Title', message: 'Custom Message');
    expect($component->title)->toBe('Custom Title');
    expect($component->message)->toBe('Custom Message');
});

// Toggle Component
it('returns correct toggle track sizes', function () {
    expect((new Toggle(size: 'sm'))->trackSize())->toContain('h-5');
    expect((new Toggle(size: 'md'))->trackSize())->toContain('h-6');
    expect((new Toggle(size: 'lg'))->trackSize())->toContain('h-7');
});

it('returns correct toggle thumb sizes', function () {
    expect((new Toggle(size: 'sm'))->thumbSize())->toContain('h-4');
    expect((new Toggle(size: 'lg'))->thumbSize())->toContain('h-6');
});

it('returns correct thumb translate distances', function () {
    expect((new Toggle(size: 'sm'))->thumbTranslate())->toBe('translate-x-4');
    expect((new Toggle(size: 'lg'))->thumbTranslate())->toBe('translate-x-7');
});

// Dropdown Component
it('returns correct dropdown alignment classes', function () {
    expect((new Dropdown(align: 'left'))->alignClasses())->toContain('left-0');
    expect((new Dropdown(align: 'right'))->alignClasses())->toContain('right-0');
    expect((new Dropdown(align: 'center'))->alignClasses())->toContain('-translate-x-1/2');
});

it('returns correct dropdown width classes', function () {
    expect((new Dropdown(width: '48'))->widthClasses())->toBe('w-48');
    expect((new Dropdown(width: '64'))->widthClasses())->toBe('w-64');
    expect((new Dropdown(width: 'full'))->widthClasses())->toBe('w-full');
});
