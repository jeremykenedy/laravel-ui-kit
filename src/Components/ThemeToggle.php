<?php

declare(strict_types=1);

namespace Jeremykenedy\LaravelUiKit\Components;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;
use Illuminate\View\Component;
use Jeremykenedy\LaravelUiKit\Contracts\ComponentContract;

class ThemeToggle extends Component implements ComponentContract
{
    /**
     * The theme modes the toggle offers, in menu order.
     *
     * @var list<string>
     */
    public const MODES = ['light', 'dark', 'system'];

    public function __construct(
        public ?string $default = null,
        public ?string $endpoint = null,
        public string $align = 'right',
        public ?string $id = null,
    ) {
        $configuredDefault = config('ui-kit.dark_mode.default', 'system');

        $this->default = in_array($this->default, self::MODES, true)
            ? $this->default
            : (in_array($configuredDefault, self::MODES, true) ? $configuredDefault : 'system');

        $this->id = $this->id ?? 'ui-theme-toggle';
    }

    public function render(): View
    {
        return view('ui::components.theme-toggle');
    }

    /**
     * The endpoint the chosen theme is persisted to, or null when persistence is not configured.
     *
     * Resolution order: the endpoint attribute, then ui-kit.dark_mode.persist_url, then
     * ui-kit.dark_mode.persist_route. A configured route name that is not registered resolves
     * to null rather than throwing, so the toggle still renders in applications without it.
     */
    public function persistUrl(): ?string
    {
        if (is_string($this->endpoint) && $this->endpoint !== '') {
            return $this->endpoint;
        }

        $url = config('ui-kit.dark_mode.persist_url');

        if (is_string($url) && $url !== '') {
            return $url;
        }

        $routeName = config('ui-kit.dark_mode.persist_route');

        if (!is_string($routeName) || $routeName === '') {
            return null;
        }

        if (!Route::has($routeName)) {
            return null;
        }

        return route($routeName);
    }

    /**
     * The HTTP method used when persisting the chosen theme.
     */
    public function persistMethod(): string
    {
        $method = config('ui-kit.dark_mode.persist_method', 'PUT');

        return is_string($method) && $method !== '' ? strtoupper($method) : 'PUT';
    }

    /**
     * @return array<string, string>
     */
    public function modeLabels(): array
    {
        return [
            'light'  => (string) __('ui-kit::ui-kit.dark_mode.light'),
            'dark'   => (string) __('ui-kit::ui-kit.dark_mode.dark'),
            'system' => (string) __('ui-kit::ui-kit.dark_mode.system'),
        ];
    }
}
