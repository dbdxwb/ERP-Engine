<?php

namespace DevEngine\Core\Providers;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class UIServiceProvider extends ServiceProvider
{
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
     */
    public function boot(Router $router)
    {
        $this->publishes([
            __DIR__.'/../../public/build/application-core/manage' => public_path('static/build/application-core/manage'),
            __DIR__.'/../../public/build/manifest.json' => public_path('static/build/manifest.json'),
        ], 'dev-engine');
    }
}
