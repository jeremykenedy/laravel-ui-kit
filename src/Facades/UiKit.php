<?php

declare(strict_types=1);

namespace Jeremykenedy\LaravelUiKit\Facades;

use Illuminate\Support\Facades\Facade;
use Jeremykenedy\LaravelUiKit\Services\UiKitManager;

/**
 * @method static string cssFramework()
 * @method static string frontend()
 * @method static string iconSet()
 * @method static string prefix()
 * @method static bool   darkModeEnabled()
 * @method static string darkModeDefault()
 * @method static bool   isTailwind()
 * @method static bool   isBootstrap5()
 * @method static bool   isBootstrap4()
 * @method static array  confirmDefaults()
 * @method static array  passwordDefaults()
 * @method static array  toastDefaults()
 *
 * @see \Jeremykenedy\LaravelUiKit\Services\UiKitManager
 */
class UiKit extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return UiKitManager::class;
    }
}
