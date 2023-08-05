<?php

namespace DevEngine\Core\Http;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Routing\Router;

class Kernel extends \Illuminate\Foundation\Http\Kernel
{

    /**
     * 全局中间层
     * @var array
     */
    protected $middleware = [
        \DevEngine\Core\Middleware\CheckInstall::class,
        \DevEngine\Core\Middleware\VisitorBefore::class,
        \DevEngine\Core\Middleware\VisitorAfter::class
    ];
    /**
     * 路由分组中间层
     *
     * @var array
     */
    protected $middlewareGroups = [
        'api' => [
            \DevEngine\Core\Middleware\Header::class,
            // 'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            \DevEngine\Core\Middleware\Api::class,
        ],

        'auth.manage' => [
            'web',
            \DevEngine\Core\Middleware\Manage::class,
        ],

        'auth.manage.register' => [
            'web',
            \DevEngine\Core\Middleware\ManageRegister::class,
        ]
    ];
}
