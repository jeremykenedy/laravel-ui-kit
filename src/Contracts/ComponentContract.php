<?php

declare(strict_types=1);

namespace Jeremykenedy\LaravelUiKit\Contracts;

interface ComponentContract
{
    public function render(): \Illuminate\Contracts\View\View;
}
