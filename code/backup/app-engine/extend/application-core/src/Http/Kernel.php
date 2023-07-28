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
        \DevEngine\Core\Middleware\TrustProxies::class,
        // \Fruitcake\Cors\HandleCors::class,
        \Illuminate\Http\Middleware\HandleCors::class,

        \DevEngine\Core\Middleware\PreventRequestsDuringMaintenance::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,

        \DevEngine\Core\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,

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
        'web' => [
            \DevEngine\Core\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,

            // \DevEngine\Core\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
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

    /**
     * 路由独立中间层
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
    ];
}
