<?php

declare(strict_types=1);

namespace Jeremykenedy\LaravelUiKit\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Jeremykenedy\LaravelUiKit\Contracts\ComponentContract;

class Breadcrumbs extends Component implements ComponentContract
{
    /**
     * @var array<int, array{label: string, url?: string|null}>
     */
    public array $items;

    /**
     * @param  array<int, array{label: string, url?: string|null}>  $items
     */
    public function __construct(
        array $items = [],
        public ?string $homeUrl = null,
        public ?string $homeLabel = null,
        public bool $showHome = true,
    ) {
        $this->items = $items;
    }

    public function render(): View
    {
        return view('ui::components.breadcrumbs');
    }

    /**
     * The URL for the leading home crumb.
     */
    public function resolvedHomeUrl(): string
    {
        if (is_string($this->homeUrl) && $this->homeUrl !== '') {
            return $this->homeUrl;
        }

        $configured = config('ui-kit.breadcrumbs.home_url', '/home');

        return is_string($configured) && $configured !== '' ? url($configured) : url('/home');
    }

    /**
     * The accessible label for the leading home crumb.
     */
    public function resolvedHomeLabel(): string
    {
        if (is_string($this->homeLabel) && $this->homeLabel !== '') {
            return $this->homeLabel;
        }

        return (string) __('ui-kit::ui-kit.breadcrumbs.home');
    }
}
