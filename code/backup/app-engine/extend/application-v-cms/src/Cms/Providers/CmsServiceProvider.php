<?php

namespace Modules\Cms\Providers;

use Modules\Cms\Middleware\Web;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class CmsServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // 注册主题配置
        $this->mergeConfigFrom(__DIR__ . '/../Config/Theme.php', 'theme');


        // 注册中间件
        $kernel = $this->app->make(Kernel::class);
        $kernel->appendMiddlewareToGroup('web', Web::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Router $router)
    {
        \DevEngine\Core\Util\Blade::make('marker', \Modules\Cms\Service\Blade::class, 'mark');
        \DevEngine\Core\Util\Blade::loopMake('menu', \Modules\Cms\Service\Blade::class, 'menu');
        \DevEngine\Core\Util\Blade::loopMake('form', \Modules\Cms\Service\Blade::class, 'form');

        // 注册数据库目录
        $this->loadMigrationsFrom(realpath(__DIR__ . '/../../../database/migrations'));


        $this->publishes([
            __DIR__.'/../../../theme' => public_path('themes'),
        ], 'dev-engine/application-cms');
    }
}
