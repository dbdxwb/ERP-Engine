<?php

namespace Builder\Application\Providers;

use Illuminate\Support\ServiceProvider;
use Builder\Application\Contracts\RepositoryInterface;
use Builder\Application\Laravel\LaravelFileRepository;

class ContractsServiceProvider extends ServiceProvider
{
    /**
     * Register some binding.
     */
    public function register()
    {
        $this->app->bind(RepositoryInterface::class, LaravelFileRepository::class);
    }
}
