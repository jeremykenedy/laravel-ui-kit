<?php

declare(strict_types=1);

namespace Jeremykenedy\LaravelUiKit\Contracts;

use Illuminate\Contracts\View\View;

interface ComponentContract
{
    public function render(): View;
}
