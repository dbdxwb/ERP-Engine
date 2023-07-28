<?php

namespace DevEngine\Core\Providers;

use DevEngine\Core\Model\SystemUser;
use DevEngine\Core\Util\Cache;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Gate;

class AdminServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        app('config')->set('auth.guards.admin', [
            'driver'   => 'jwt',
            'provider' => 'admins',
        ]);

        app('config')->set('auth.providers.admins', [
            'driver' => 'eloquent',
            'model'  => SystemUser::class,
        ]);

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Router $router)
    {
        Route::get('/', function () {
            return redirect(\route('admin.index'));
        })->middleware('web')->name('admin.web');

    }

}
