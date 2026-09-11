<?php

declare(strict_types=1);

namespace Jeremykenedy\LaravelUiKit\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Jeremykenedy\LaravelUiKit\Contracts\ComponentContract;

class Button extends Component implements ComponentContract
{
    public function __construct(
        public string $variant = 'primary',
        public string $size = 'md',
        public string $type = 'button',
        public ?string $icon = null,
        public ?string $iconPosition = 'left',
        public ?string $href = null,
        public bool $disabled = false,
        public bool $loading = false,
        public bool $block = false,
        public bool $outline = false,
        public bool $iconOnly = false,
        public ?string $tooltip = null,
        public ?string $confirm = null,
        public ?string $confirmTitle = null,
        public ?string $confirmAction = null,
        public ?string $confirmTarget = null,
        public ?string $form = null,
    ) {
    }

    public function render(): View
    {
        return view('ui::components.button');
    }

    /**
     * The DOM id of the confirmation dialog this button opens.
     *
     * Historically Bootstrap builds targeted the confirm-action value directly, so that
     * value is still honoured when no explicit target is given.
     */
    public function confirmTargetId(): string
    {
        foreach ([$this->confirmTarget, $this->confirmAction] as $candidate) {
            if (is_string($candidate) && $candidate !== '') {
                return $candidate;
            }
        }

        $configured = config('ui-kit.confirm.modal_id', 'confirmModal');

        return is_string($configured) && $configured !== '' ? $configured : 'confirmModal';
    }

    public function variantClasses(): string
    {
        $base = $this->outline ? 'outline' : 'solid';

        $variants = [
            'solid' => [
                'primary'   => 'bg-blue-600 text-white hover:bg-blue-700 focus-visible:ring-blue-500',
                'secondary' => 'bg-gray-600 text-white hover:bg-gray-700 focus-visible:ring-gray-500',
                'success'   => 'bg-green-600 text-white hover:bg-green-700 focus-visible:ring-green-500',
                'danger'    => 'bg-red-600 text-white hover:bg-red-700 focus-visible:ring-red-500',
                'warning'   => 'bg-amber-500 text-white hover:bg-amber-600 focus-visible:ring-amber-500',
                'info'      => 'bg-cyan-600 text-white hover:bg-cyan-700 focus-visible:ring-cyan-500',
            ],
            'outline' => [
                'primary'   => 'border border-blue-600 text-blue-600 dark:text-blue-400 dark:border-blue-400 hover:bg-blue-50 dark:hover:bg-blue-900/20 focus-visible:ring-blue-500',
                'secondary' => 'border border-gray-600 text-gray-600 dark:text-gray-300 dark:border-gray-400 hover:bg-gray-50 dark:hover:bg-gray-900/20 focus-visible:ring-gray-500',
                'success'   => 'border border-green-600 text-green-600 dark:text-green-400 dark:border-green-400 hover:bg-green-50 dark:hover:bg-green-900/20 focus-visible:ring-green-500',
                'danger'    => 'border border-red-600 text-red-600 dark:text-red-400 dark:border-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 focus-visible:ring-red-500',
                'warning'   => 'border border-amber-500 text-amber-600 dark:text-amber-400 dark:border-amber-400 hover:bg-amber-50 dark:hover:bg-amber-900/20 focus-visible:ring-amber-500',
                'info'      => 'border border-cyan-600 text-cyan-600 dark:text-cyan-400 dark:border-cyan-400 hover:bg-cyan-50 dark:hover:bg-cyan-900/20 focus-visible:ring-cyan-500',
            ],
        ];

        return $variants[$base][$this->variant] ?? $variants['solid']['primary'];
    }

    public function sizeClasses(): string
    {
        if ($this->iconOnly) {
            return match ($this->size) {
                'xs'    => 'p-1 text-xs',
                'sm'    => 'p-1.5 text-sm',
                'md'    => 'p-2 text-sm',
                'lg'    => 'p-2.5 text-base',
                'xl'    => 'p-3 text-lg',
                default => 'p-2 text-sm',
            };
        }

        return match ($this->size) {
            'xs'    => 'px-2 py-1 text-xs',
            'sm'    => 'px-3 py-1.5 text-sm',
            'md'    => 'px-4 py-2 text-sm',
            'lg'    => 'px-5 py-2.5 text-base',
            'xl'    => 'px-6 py-3 text-lg',
            default => 'px-4 py-2 text-sm',
        };
    }

    public function baseClasses(): string
    {
        $classes = 'inline-flex cursor-pointer items-center justify-center rounded-lg font-medium transition-colors duration-150 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 motion-reduce:transition-none dark:focus-visible:ring-offset-gray-800';

        if ($this->block) {
            $classes .= ' w-full';
        }

        if ($this->disabled || $this->loading) {
            $classes .= ' opacity-50 cursor-not-allowed';
        }

        return $classes;
    }
}
