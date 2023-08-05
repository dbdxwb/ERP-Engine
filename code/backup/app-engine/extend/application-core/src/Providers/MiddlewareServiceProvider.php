<?php

namespace DevEngine\Core\Providers;

use DevEngine\Core\Console\Kernel;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\ServiceProvider;

class MiddlewareServiceProvider extends ServiceProvider
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
        'api'         => [
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
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     * @throws BindingResolutionException
     */
    public function boot()
    {
        $router = $this->app->make('router');

        // register middleware.
        foreach ($this->middleware as $key => $middleware) {
            $router->middleware($middleware);
        }
        // register middleware group.
        foreach ($this->middlewareGroups as $key => $middleware) {
            $router->middlewareGroup($key, $middleware);
        }

    }

}
