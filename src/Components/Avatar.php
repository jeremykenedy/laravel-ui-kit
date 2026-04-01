<?php

declare(strict_types=1);

namespace Jeremykenedy\LaravelUiKit\Components;

use Illuminate\View\Component;

class Avatar extends Component
{
    public function __construct(
        public ?string $src = null,
        public ?string $alt = null,
        public string $size = 'md',
        public ?string $fallback = null,
        public bool $rounded = true,
        public ?string $status = null,
        public ?string $initials = null,
    ) {
    }

    public function render(): \Illuminate\Contracts\View\View
    {
        return view('ui::components.avatar');
    }

    public function sizeClasses(): string
    {
        return match ($this->size) {
            'xs'    => 'h-6 w-6 text-xs',
            'sm'    => 'h-8 w-8 text-sm',
            'md'    => 'h-10 w-10 text-sm',
            'lg'    => 'h-12 w-12 text-base',
            'xl'    => 'h-16 w-16 text-lg',
            '2xl'   => 'h-20 w-20 text-xl',
            default => 'h-10 w-10 text-sm',
        };
    }

    public function statusClasses(): string
    {
        return match ($this->status) {
            'online'  => 'bg-green-500',
            'offline' => 'bg-gray-400',
            'away'    => 'bg-amber-500',
            'busy'    => 'bg-red-500',
            default   => '',
        };
    }

    public function computedInitials(): string
    {
        if ($this->initials) {
            return strtoupper(substr($this->initials, 0, 2));
        }

        if ($this->alt) {
            $words = explode(' ', $this->alt);
            $initials = '';
            foreach (array_slice($words, 0, 2) as $word) {
                $initials .= strtoupper(substr($word, 0, 1));
            }

            return $initials;
        }

        return '?';
    }
}
