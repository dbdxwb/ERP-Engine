<?php

namespace DevEngine\Core\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The root namespace to assume when generating URLs to actions.
     *
     * @var string
     */
    protected $namespace = 'DevEngine\Core';

    /**
     * Called before routes are registered.
     *
     * Register any model bindings or pattern based filters.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        $this->mapAdminRoutes();

        $this->mapServiceRoutes();

        $this->mapAuthAdminRoutes();

    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace('DevEngine\Core\Web')
            ->group(__DIR__ . '/../Routes/web.php');
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->namespace("DevEngine\Core\Api")
            ->middleware('api')
            ->group(__DIR__ . '/../Routes/api.php');
    }

    /**
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapAdminRoutes()
    {
        Route::namespace("DevEngine\Core\Admin")
            ->prefix('admin')
            ->middleware('web')
            ->group(__DIR__ . '/../Routes/admin.php');
    }

    /**
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapServiceRoutes()
    {
        Route::middleware('service')
            ->group(__DIR__ . '/../Routes/service.php');
    }


    /**
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapAuthAdminRoutes()
    {
        Route::middleware(['api', 'auth.api'])
            ->namespace("DevEngine\Core\Admin")
            ->group(__DIR__ . '/../Routes/auth-admin.php');
    }
}
