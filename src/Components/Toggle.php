<?php

declare(strict_types=1);

namespace Jeremykenedy\LaravelUiKit\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Jeremykenedy\LaravelUiKit\Contracts\ComponentContract;

class Toggle extends Component implements ComponentContract
{
    /**
     * Colours the on state may use.
     *
     * Tailwind only emits classes it can see in source, so the set is fixed rather than
     * built from the attribute. That also keeps caller input out of the Alpine expression.
     *
     * @var array<string, string>
     */
    protected const ON_COLORS = [
        'blue'   => 'bg-blue-600',
        'green'  => 'bg-green-600',
        'red'    => 'bg-red-600',
        'amber'  => 'bg-amber-500',
        'cyan'   => 'bg-cyan-600',
        'gray'   => 'bg-gray-600',
        'indigo' => 'bg-indigo-600',
        'purple' => 'bg-purple-600',
    ];

    public function __construct(
        public ?string $name = null,
        public ?string $id = null,
        public ?string $label = null,
        public ?string $description = null,
        public bool $checked = false,
        public bool $disabled = false,
        public string $size = 'md',
        public string $onColor = 'blue',
    ) {
        $this->id = $this->id ?? $this->name;
    }

    public function render(): View
    {
        return view('ui::components.toggle');
    }

    /**
     * The background class for the on state, falling back to blue for an unknown colour.
     */
    public function onColorClass(): string
    {
        return self::ON_COLORS[$this->onColor] ?? self::ON_COLORS['blue'];
    }

    /**
     * @return list<string>
     */
    public static function availableOnColors(): array
    {
        return array_keys(self::ON_COLORS);
    }

    public function trackSize(): string
    {
        return match ($this->size) {
            'sm'    => 'h-5 w-9',
            'md'    => 'h-6 w-11',
            'lg'    => 'h-7 w-14',
            default => 'h-6 w-11',
        };
    }

    public function thumbSize(): string
    {
        return match ($this->size) {
            'sm'    => 'h-4 w-4',
            'md'    => 'h-5 w-5',
            'lg'    => 'h-6 w-6',
            default => 'h-5 w-5',
        };
    }

    public function thumbTranslate(): string
    {
        return match ($this->size) {
            'sm'    => 'translate-x-4',
            'md'    => 'translate-x-5',
            'lg'    => 'translate-x-7',
            default => 'translate-x-5',
        };
    }
}
