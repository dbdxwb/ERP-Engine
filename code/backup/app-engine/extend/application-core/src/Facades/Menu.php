<?php

namespace DevEngine\Core\Facades;

use DevEngine\Core\Util\MenuStore;
use Illuminate\Support\Facades\Facade;

/**
 *--------------------------------------------------------------------------
 * 名称：
 *--------------------------------------------------------------------------
 * 描述：
 *--------------------------------------------------------------------------
 * 创建时间：2023/8/3 13:53
 *--------------------------------------------------------------------------
 * USER:lzq
 *--------------------------------------------------------------------------
 *
 * @method static void add(string $index, array $params, $rule = null)
 * @method static void navbar(string $index, array $params, $rule = null)
 * @method static void push(string $index, callable $callback)
 * @method static void app(array $data)
 * @method static void group(array $params, ?callable $callback = null, $index = null)
 * @method static void link(string $name, string $route, array $params = [], int $index = 0)
 * @method static array getData()
 * @method static array getApps()
 * @method static array getNavbar()
 *
 */
class Menu extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Menu';
    }
}
