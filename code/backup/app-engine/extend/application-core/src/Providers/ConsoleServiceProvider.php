<?php

namespace DevEngine\Core\Providers;

use Illuminate\Support\ServiceProvider;

class ConsoleServiceProvider extends ServiceProvider
{
    protected $defer = false;

    /**
     * The available commands
     *
     * @var array
     */
    protected $commands = [
        \DevEngine\Core\Console\AppBuild::class,
        \DevEngine\Core\Console\App::class,
        \DevEngine\Core\Console\AppAdmin::class,
        \DevEngine\Core\Console\AppModel::class,
        \DevEngine\Core\Console\Install::class,
        \DevEngine\Core\Console\Uninstall::class,
        \DevEngine\Core\Console\Operate::class,
        \DevEngine\Core\Console\Visitor::class,
    ];

    /**
     * Register the commands.
     */
    public function register()
    {
        $this->commands($this->commands);
    }

    /**
     * @return array
     */
    public function provides()
    {
        $provides = $this->commands;

        return $provides;
    }
}
