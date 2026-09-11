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
    /**
     * Every CSS framework this package ships view templates for.
     *
     * @var list<string>
     */
    public const CSS_FRAMEWORKS = ['tailwind', 'bootstrap5', 'bootstrap4'];

    /**
     * Every frontend framework the package can be configured to use.
     *
     * @var list<string>
     */
    public const FRONTENDS = ['blade', 'livewire', 'vue', 'react', 'svelte'];

    /**
     * The CSS framework used whenever the configured one is missing or unknown.
     */
    public const FALLBACK_CSS_FRAMEWORK = 'tailwind';

    /**
     * Livewire component aliases mapped to their backing class.
     *
     * @var array<string, class-string>
     */
    public const LIVEWIRE_COMPONENTS = [
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

    public function register(): void
    {
        $this->mergeConfigFrom($this->packagePath('config/ui-kit.php'), 'ui-kit');

        $this->app->singleton(UiKitManager::class, function ($app) {
            return new UiKitManager($app['config']->get('ui-kit', []));
        });

        $this->app->alias(UiKitManager::class, 'ui-kit');
    }

    public function boot(): void
    {
        $this->registerPublishing();
        $this->registerTranslations();
        $this->registerViews();
        $this->registerComponents();
        $this->registerLivewireComponents();
    }

    /**
     * The CSS framework the package renders with, guaranteed to be one this package ships.
     */
    public function activeCssFramework(): string
    {
        $configured = $this->app['config']->get('ui-kit.css_framework', self::FALLBACK_CSS_FRAMEWORK);

        if (!is_string($configured) || !in_array($configured, self::CSS_FRAMEWORKS, true)) {
            return self::FALLBACK_CSS_FRAMEWORK;
        }

        if (!is_dir($this->packagePath('resources/views/'.$configured))) {
            return self::FALLBACK_CSS_FRAMEWORK;
        }

        return $configured;
    }

    protected function registerPublishing(): void
    {
        if (!$this->app->runningInConsole()) {
            return;
        }

        $this->publishes([
            $this->packagePath('config/ui-kit.php') => config_path('ui-kit.php'),
        ], 'ui-kit-config');

        $this->publishes([
            $this->packagePath('resources/views') => resource_path('views/vendor/ui-kit'),
        ], 'ui-kit-views');

        $this->publishes([
            $this->packagePath('resources/lang') => $this->langPublishPath(),
        ], 'ui-kit-lang');

        $this->publishes([
            $this->packagePath('resources/js') => resource_path('js/ui-kit'),
        ], 'ui-kit-js');

        $this->publishes([
            $this->packagePath('config/ui-kit.php') => config_path('ui-kit.php'),
            $this->packagePath('resources/views')   => resource_path('views/vendor/ui-kit'),
            $this->packagePath('resources/lang')    => $this->langPublishPath(),
            $this->packagePath('resources/js')      => resource_path('js/ui-kit'),
        ], 'ui-kit');

        $this->commands([
            InstallCommand::class,
            UpdateCommand::class,
            SwitchCommand::class,
            SwitchFrameworkCommand::class,
        ]);
    }

    protected function registerTranslations(): void
    {
        $this->loadTranslationsFrom($this->packagePath('resources/lang'), 'ui-kit');
        $this->loadJsonTranslationsFrom($this->packagePath('resources/lang'));
    }

    protected function registerViews(): void
    {
        $cssFramework = $this->activeCssFramework();
        $viewsPath = $this->packagePath('resources/views');

        // The "ui" namespace backs the Blade component render() methods, for example
        // view('ui::components.button'). The active CSS framework wins; Tailwind is the
        // safety net so a framework missing a single template still renders.
        $componentPaths = array_values(array_unique([
            $viewsPath.'/'.$cssFramework,
            $viewsPath.'/'.self::FALLBACK_CSS_FRAMEWORK,
        ]));

        $this->loadViewsFrom($componentPaths, 'ui');

        // The "ui-kit" namespace additionally exposes the package root so shared views
        // such as ui-kit::livewire.button resolve alongside ui-kit::components.button.
        $this->loadViewsFrom(array_merge($componentPaths, [$viewsPath]), 'ui-kit');
    }

    protected function registerComponents(): void
    {
        // Registering the namespace (rather than Blade::component with a prefix) is what
        // gives the <x-ui::button> colon syntax. Blade::component() would yield <x-ui-button>.
        Blade::componentNamespace('Jeremykenedy\\LaravelUiKit\\Components', 'ui');

        // "ui" stays registered unconditionally so published markup keeps working when an
        // application sets a custom prefix.
        $prefix = $this->app['config']->get('ui-kit.prefix', 'ui');

        if (is_string($prefix) && $prefix !== '' && $prefix !== 'ui') {
            Blade::componentNamespace('Jeremykenedy\\LaravelUiKit\\Components', $prefix);
        }
    }

    protected function registerLivewireComponents(): void
    {
        if (!class_exists(Livewire::class)) {
            return;
        }

        // Deferred to "booted" so registration never races Livewire's own service provider,
        // whose manager is not resolvable while providers are still booting.
        $this->app->booted(function (): void {
            foreach (self::LIVEWIRE_COMPONENTS as $name => $class) {
                Livewire::component($name, $class);
            }
        });
    }

    /**
     * Absolute path to a file or directory shipped inside this package.
     */
    protected function packagePath(string $path = ''): string
    {
        return rtrim(dirname(__DIR__, 2).'/'.ltrim($path, '/'), '/');
    }

    /**
     * Laravel 9+ publishes package translations to lang/vendor; older layouts use resources/lang.
     */
    protected function langPublishPath(): string
    {
        if (function_exists('lang_path')) {
            return lang_path('vendor/ui-kit');
        }

        return resource_path('lang/vendor/ui-kit');
    }
}
