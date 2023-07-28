<?php

namespace DevEngine\Core\Providers;

use DevEngine\Core\Events\ServiceBoot;
use DevEngine\Core\Events\ServiceRegister;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class CoreServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        // 调用系统扩展
        event(new ServiceRegister);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Router $router)
    {
        // 注册数据库目录
        $this->loadMigrationsFrom(realpath(__DIR__ . '/../../database/migrations'));

        // 调用系统扩展
        event(new ServiceBoot);
    }
}
