<?php

declare(strict_types=1);

namespace Jeremykenedy\LaravelUiKit\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Jeremykenedy\LaravelUiKit\Services\UiKitManager;

class UiKitServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../../config/ui-kit.php', 'ui-kit');

        $this->app->singleton(UiKitManager::class, function ($app) {
            return new UiKitManager($app['config']->get('ui-kit'));
        });

        $this->app->alias(UiKitManager::class, 'ui-kit');
    }

    public function boot(): void
    {
        $this->registerPublishing();
        $this->registerViews();
        $this->registerComponents();
        $this->registerLivewireComponents();
    }

    protected function registerPublishing(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../../config/ui-kit.php' => config_path('ui-kit.php'),
            ], 'ui-kit-config');

            $this->publishes([
                __DIR__.'/../../resources/views' => resource_path('views/vendor/ui-kit'),
            ], 'ui-kit-views');

            $this->commands([
                \Jeremykenedy\LaravelUiKit\Console\SwitchFrameworkCommand::class,
                \Jeremykenedy\LaravelUiKit\Console\SwitchCommand::class,
                \Jeremykenedy\LaravelUiKit\Console\InstallCommand::class,
            ]);
        }
    }

    protected function registerViews(): void
    {
        $cssFramework = $this->app['config']->get('ui-kit.css_framework', 'tailwind');

        // Register view namespace for component render() methods: view('ui::components.input')
        $this->loadViewsFrom(
            __DIR__.'/../../resources/views/'.$cssFramework,
            'ui'
        );

        // Also register under ui-kit namespace for Livewire views
        $this->loadViewsFrom(
            __DIR__.'/../../resources/views/'.$cssFramework,
            'ui-kit'
        );
    }

    protected function registerComponents(): void
    {
        // Register component namespace so <x-ui::input> resolves to
        // Jeremykenedy\LaravelUiKit\Components\Input class
        // This is the CORRECT way to register namespaced Blade components.
        // Using Blade::component() with prefix creates <x-ui-input> (dash),
        // but we need <x-ui::input> (namespace colon syntax).
        Blade::componentNamespace('Jeremykenedy\\LaravelUiKit\\Components', 'ui');
    }

    protected function registerLivewireComponents(): void
    {
        if (!class_exists(\Livewire\Livewire::class)) {
            return;
        }

        $livewireComponents = [
            'ui-alert'          => \Jeremykenedy\LaravelUiKit\Livewire\UiAlert::class,
            'ui-avatar'         => \Jeremykenedy\LaravelUiKit\Livewire\UiAvatar::class,
            'ui-badge'          => \Jeremykenedy\LaravelUiKit\Livewire\UiBadge::class,
            'ui-button'         => \Jeremykenedy\LaravelUiKit\Livewire\UiButton::class,
            'ui-card'           => \Jeremykenedy\LaravelUiKit\Livewire\UiCard::class,
            'ui-checkbox'       => \Jeremykenedy\LaravelUiKit\Livewire\UiCheckbox::class,
            'ui-confirm'        => \Jeremykenedy\LaravelUiKit\Livewire\UiConfirm::class,
            'ui-data-table'     => \Jeremykenedy\LaravelUiKit\Livewire\UiDataTable::class,
            'ui-dropdown'       => \Jeremykenedy\LaravelUiKit\Livewire\UiDropdown::class,
            'ui-form-group'     => \Jeremykenedy\LaravelUiKit\Livewire\UiFormGroup::class,
            'ui-icon'           => \Jeremykenedy\LaravelUiKit\Livewire\UiIcon::class,
            'ui-input'          => \Jeremykenedy\LaravelUiKit\Livewire\UiInput::class,
            'ui-modal'          => \Jeremykenedy\LaravelUiKit\Livewire\UiModal::class,
            'ui-nav'            => \Jeremykenedy\LaravelUiKit\Livewire\UiNav::class,
            'ui-pagination'     => \Jeremykenedy\LaravelUiKit\Livewire\UiPagination::class,
            'ui-password-input' => \Jeremykenedy\LaravelUiKit\Livewire\UiPasswordInput::class,
            'ui-search-input'   => \Jeremykenedy\LaravelUiKit\Livewire\UiSearchInput::class,
            'ui-select'         => \Jeremykenedy\LaravelUiKit\Livewire\UiSelect::class,
            'ui-status-panel'   => \Jeremykenedy\LaravelUiKit\Livewire\UiStatusPanel::class,
            'ui-tabs'           => \Jeremykenedy\LaravelUiKit\Livewire\UiTabs::class,
            'ui-textarea'       => \Jeremykenedy\LaravelUiKit\Livewire\UiTextarea::class,
            'ui-toggle'         => \Jeremykenedy\LaravelUiKit\Livewire\UiToggle::class,
            'ui-theme-toggle'   => \Jeremykenedy\LaravelUiKit\Livewire\UiThemeToggle::class,
            'ui-stat-card'      => \Jeremykenedy\LaravelUiKit\Livewire\UiStatCard::class,
        ];

        foreach ($livewireComponents as $name => $class) {
            \Livewire\Livewire::component($name, $class);
        }
    }
}
