<?php

use Jeremykenedy\LaravelUiKit\Services\UiKitManager;

it('resolves the ui kit manager from the container', function () {
    $manager = app(UiKitManager::class);
    expect($manager)->toBeInstanceOf(UiKitManager::class);
});

it('returns the configured css framework', function () {
    config(['ui-kit.css_framework' => 'bootstrap5']);
    $manager = new UiKitManager(config('ui-kit'));
    expect($manager->cssFramework())->toBe('bootstrap5');
});

it('returns the configured frontend', function () {
    config(['ui-kit.frontend' => 'vue']);
    $manager = new UiKitManager(config('ui-kit'));
    expect($manager->frontend())->toBe('vue');
});

it('detects tailwind correctly', function () {
    $manager = new UiKitManager(['css_framework' => 'tailwind']);
    expect($manager->isTailwind())->toBeTrue();
    expect($manager->isBootstrap5())->toBeFalse();
    expect($manager->isBootstrap4())->toBeFalse();
});

it('detects bootstrap 5 correctly', function () {
    $manager = new UiKitManager(['css_framework' => 'bootstrap5']);
    expect($manager->isTailwind())->toBeFalse();
    expect($manager->isBootstrap5())->toBeTrue();
});

it('detects bootstrap 4 correctly', function () {
    $manager = new UiKitManager(['css_framework' => 'bootstrap4']);
    expect($manager->isBootstrap4())->toBeTrue();
});

it('returns default icon set', function () {
    $manager = new UiKitManager([]);
    expect($manager->iconSet())->toBe('lucide');
});

it('returns dark mode enabled by default', function () {
    $manager = new UiKitManager(['dark_mode' => ['enabled' => true]]);
    expect($manager->darkModeEnabled())->toBeTrue();
});

it('returns confirm defaults', function () {
    $manager = new UiKitManager([]);
    $defaults = $manager->confirmDefaults();
    expect($defaults)->toHaveKey('default_title');
    expect($defaults)->toHaveKey('confirm_text');
    expect($defaults)->toHaveKey('cancel_text');
});

it('returns password defaults', function () {
    $manager = new UiKitManager([]);
    $defaults = $manager->passwordDefaults();
    expect($defaults)->toHaveKey('strength_meter');
    expect($defaults)->toHaveKey('min_length');
});
