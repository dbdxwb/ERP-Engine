<?php

namespace Builder\Application\Providers;

use Illuminate\Support\ServiceProvider;

class BootstrapServiceProvider extends ServiceProvider
{
    /**
     * Booting the package.
     */
    public function boot()
    {
        $this->app['builder-application']->boot();
    }

    /**
     * Register the provider.
     */
    public function register()
    {
        $this->app['builder-application']->register();
    }
}
