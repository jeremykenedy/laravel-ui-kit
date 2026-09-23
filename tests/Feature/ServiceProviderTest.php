<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\View;
use Jeremykenedy\LaravelUiKit\Providers\UiKitServiceProvider;
use Jeremykenedy\LaravelUiKit\Services\UiKitManager;

it('binds the manager as a shared singleton', function () {
    expect(app(UiKitManager::class))->toBe(app(UiKitManager::class))
        ->and(app('ui-kit'))->toBe(app(UiKitManager::class));
});

it('resolves component views through the ui namespace', function () {
    expect(view()->exists('ui::components.button'))->toBeTrue()
        ->and(view()->exists('ui::components.modal'))->toBeTrue();
});

it('resolves livewire views through the ui-kit namespace', function () {
    expect(view()->exists('ui-kit::livewire.button'))->toBeTrue()
        ->and(view()->exists('ui-kit::components.button'))->toBeTrue();
});

it('loads package translations under the ui-kit namespace', function () {
    expect(Lang::has('ui-kit::ui-kit.alert.dismiss'))->toBeTrue()
        ->and(__('ui-kit::ui-kit.alert.dismiss'))->toBe('Dismiss');
});

it('registers a publish group for every shipped asset type', function () {
    $groups = UiKitServiceProvider::publishableGroups();

    expect($groups)->toContain('ui-kit-config')
        ->and($groups)->toContain('ui-kit-views')
        ->and($groups)->toContain('ui-kit-lang')
        ->and($groups)->toContain('ui-kit-js')
        ->and($groups)->toContain('ui-kit');
});

it('publishes the config to the application config path', function () {
    $paths = UiKitServiceProvider::pathsToPublish(UiKitServiceProvider::class, 'ui-kit-config');

    expect($paths)->toHaveCount(1)
        ->and(array_values($paths)[0])->toBe(config_path('ui-kit.php'));
});

it('falls back to tailwind when the configured css framework is unknown', function () {
    config(['ui-kit.css_framework' => 'not-a-framework']);

    $provider = new UiKitServiceProvider(app());

    expect($provider->activeCssFramework())->toBe('tailwind');
});

it('keeps a supported css framework', function (string $framework) {
    config(['ui-kit.css_framework' => $framework]);

    expect((new UiKitServiceProvider(app()))->activeCssFramework())->toBe($framework);
})->with(cssFrameworks());

it('registers the ui component namespace', function () {
    expect(Blade::getClassComponentNamespaces())->toHaveKey('ui')
        ->and(Blade::getClassComponentNamespaces()['ui'])->toBe('Jeremykenedy\\LaravelUiKit\\Components');
});

it('registers a custom prefix alongside ui so existing markup keeps working', function () {
    config(['ui-kit.prefix' => 'kit']);

    (new UiKitServiceProvider(app()))->boot();

    $namespaces = Blade::getClassComponentNamespaces();

    expect($namespaces)->toHaveKey('kit')
        ->and($namespaces)->toHaveKey('ui');
});

it('exposes a livewire alias for every livewire component class', function () {
    foreach (UiKitServiceProvider::LIVEWIRE_COMPONENTS as $alias => $class) {
        expect(class_exists($class))->toBeTrue("Missing Livewire class for {$alias}")
            ->and($alias)->toStartWith('ui-');
    }
});

it('resolves every livewire alias to its component class', function () {
    foreach (UiKitServiceProvider::LIVEWIRE_COMPONENTS as $alias => $class) {
        expect(Livewire\Livewire::test($alias)->instance())->toBeInstanceOf($class);
    }
});

it('reads component views from the active css framework', function (string $framework) {
    useCssFramework($framework);

    $resolved = View::getFinder()->find('ui::components.button');

    expect($resolved)->toContain("/resources/views/{$framework}/components/button.blade.php");
})->with(cssFrameworks());

it('renders published framework overrides through both view namespaces', function (string $framework) {
    $directory = sys_get_temp_dir().'/ui-kit-views-'.bin2hex(random_bytes(8));
    $path = $directory.'/vendor/ui-kit/'.$framework.'/components';
    File::ensureDirectoryExists($path);
    file_put_contents($path.'/button.blade.php', '<button>Published button</button>');
    config(['view.paths' => [$directory], 'ui-kit.css_framework' => $framework]);
    View::replaceNamespace('ui', []);
    View::replaceNamespace('ui-kit', []);
    View::getFinder()->flush();

    try {
        (new UiKitServiceProvider($this->app))->boot();

        $this->blade('<x-ui::button />')->assertSee('Published button');
        expect(view('ui-kit::components.button')->render())->toContain('Published button');
        expect(View::getFinder()->find('ui::components.card'))
            ->toBe(packagePath("resources/views/{$framework}/components/card.blade.php"));
    } finally {
        File::deleteDirectory($directory);
    }
})->with(cssFrameworks());

it('keeps existing flat view overrides ahead of framework overrides', function (string $namespace) {
    $directory = sys_get_temp_dir().'/ui-kit-views-'.bin2hex(random_bytes(8));
    File::ensureDirectoryExists($directory.'/vendor/'.$namespace.'/components');
    File::ensureDirectoryExists($directory.'/vendor/ui-kit/tailwind/components');
    file_put_contents($directory.'/vendor/'.$namespace.'/components/button.blade.php', 'Existing override');
    file_put_contents($directory.'/vendor/ui-kit/tailwind/components/button.blade.php', 'Framework override');
    config(['view.paths' => [$directory]]);
    View::replaceNamespace($namespace, []);
    View::getFinder()->flush();

    try {
        (new UiKitServiceProvider($this->app))->boot();

        expect(view($namespace.'::components.button')->render())->toBe('Existing override');
    } finally {
        File::deleteDirectory($directory);
    }
})->with(['ui', 'ui-kit']);
