<?php

declare(strict_types=1);

namespace Jeremykenedy\LaravelUiKit\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Jeremykenedy\LaravelUiKit\Console\InstallCommand;
use Jeremykenedy\LaravelUiKit\Console\SwitchCommand;
use Jeremykenedy\LaravelUiKit\Console\SwitchFrameworkCommand;
use Jeremykenedy\LaravelUiKit\Console\UpdateCommand;
use Jeremykenedy\LaravelUiKit\Livewire\UiAlert;
use Jeremykenedy\LaravelUiKit\Livewire\UiAvatar;
use Jeremykenedy\LaravelUiKit\Livewire\UiBadge;
use Jeremykenedy\LaravelUiKit\Livewire\UiButton;
use Jeremykenedy\LaravelUiKit\Livewire\UiCard;
use Jeremykenedy\LaravelUiKit\Livewire\UiCheckbox;
use Jeremykenedy\LaravelUiKit\Livewire\UiConfirm;
use Jeremykenedy\LaravelUiKit\Livewire\UiDataTable;
use Jeremykenedy\LaravelUiKit\Livewire\UiDropdown;
use Jeremykenedy\LaravelUiKit\Livewire\UiFormGroup;
use Jeremykenedy\LaravelUiKit\Livewire\UiIcon;
use Jeremykenedy\LaravelUiKit\Livewire\UiInput;
use Jeremykenedy\LaravelUiKit\Livewire\UiModal;
use Jeremykenedy\LaravelUiKit\Livewire\UiNav;
use Jeremykenedy\LaravelUiKit\Livewire\UiPagination;
use Jeremykenedy\LaravelUiKit\Livewire\UiPasswordInput;
use Jeremykenedy\LaravelUiKit\Livewire\UiSearchInput;
use Jeremykenedy\LaravelUiKit\Livewire\UiSelect;
use Jeremykenedy\LaravelUiKit\Livewire\UiStatCard;
use Jeremykenedy\LaravelUiKit\Livewire\UiStatusPanel;
use Jeremykenedy\LaravelUiKit\Livewire\UiTabs;
use Jeremykenedy\LaravelUiKit\Livewire\UiTextarea;
use Jeremykenedy\LaravelUiKit\Livewire\UiThemeToggle;
use Jeremykenedy\LaravelUiKit\Livewire\UiToggle;
use Jeremykenedy\LaravelUiKit\Services\UiKitManager;
use Livewire\Livewire;

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
                InstallCommand::class,
                UpdateCommand::class,
                SwitchCommand::class,
                SwitchFrameworkCommand::class,
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
        if (!class_exists(Livewire::class)) {
            return;
        }

        $livewireComponents = [
            'ui-alert'          => UiAlert::class,
            'ui-avatar'         => UiAvatar::class,
            'ui-badge'          => UiBadge::class,
            'ui-button'         => UiButton::class,
            'ui-card'           => UiCard::class,
            'ui-checkbox'       => UiCheckbox::class,
            'ui-confirm'        => UiConfirm::class,
            'ui-data-table'     => UiDataTable::class,
            'ui-dropdown'       => UiDropdown::class,
            'ui-form-group'     => UiFormGroup::class,
            'ui-icon'           => UiIcon::class,
            'ui-input'          => UiInput::class,
            'ui-modal'          => UiModal::class,
            'ui-nav'            => UiNav::class,
            'ui-pagination'     => UiPagination::class,
            'ui-password-input' => UiPasswordInput::class,
            'ui-search-input'   => UiSearchInput::class,
            'ui-select'         => UiSelect::class,
            'ui-status-panel'   => UiStatusPanel::class,
            'ui-tabs'           => UiTabs::class,
            'ui-textarea'       => UiTextarea::class,
            'ui-toggle'         => UiToggle::class,
            'ui-theme-toggle'   => UiThemeToggle::class,
            'ui-stat-card'      => UiStatCard::class,
        ];

        foreach ($livewireComponents as $name => $class) {
            Livewire::component($name, $class);
        }
    }
}
