<?php

namespace Builder\Application\Providers;

use Builder\Application\Commands\AdminProviderMakeCommand;
use Builder\Application\Commands\AdminRouteProviderMakeCommand;
use Builder\Application\Commands\AdminSeedMakeCommand;
use Illuminate\Support\ServiceProvider;
use Builder\Application\Commands\CommandMakeCommand;
use Builder\Application\Commands\ControllerMakeCommand;
use Builder\Application\Commands\DisableCommand;
use Builder\Application\Commands\DumpCommand;
use Builder\Application\Commands\EnableCommand;
use Builder\Application\Commands\EventMakeCommand;
use Builder\Application\Commands\FactoryMakeCommand;
use Builder\Application\Commands\InstallCommand;
use Builder\Application\Commands\JobMakeCommand;
use Builder\Application\Commands\ListCommand;
use Builder\Application\Commands\ListenerMakeCommand;
use Builder\Application\Commands\MailMakeCommand;
use Builder\Application\Commands\MiddlewareMakeCommand;
use Builder\Application\Commands\MigrateCommand;
use Builder\Application\Commands\MigrateRefreshCommand;
use Builder\Application\Commands\MigrateResetCommand;
use Builder\Application\Commands\MigrateRollbackCommand;
use Builder\Application\Commands\MigrateStatusCommand;
use Builder\Application\Commands\MigrationMakeCommand;
use Builder\Application\Commands\ModelMakeCommand;
use Builder\Application\Commands\ModuleMakeCommand;
use Builder\Application\Commands\NotificationMakeCommand;
use Builder\Application\Commands\PolicyMakeCommand;
use Builder\Application\Commands\ProviderMakeCommand;
use Builder\Application\Commands\PublishCommand;
use Builder\Application\Commands\PublishConfigurationCommand;
use Builder\Application\Commands\PublishMigrationCommand;
use Builder\Application\Commands\PublishTranslationCommand;
use Builder\Application\Commands\RequestMakeCommand;
use Builder\Application\Commands\ResourceMakeCommand;
use Builder\Application\Commands\RouteProviderMakeCommand;
use Builder\Application\Commands\RuleMakeCommand;
use Builder\Application\Commands\SeedCommand;
use Builder\Application\Commands\SeedMakeCommand;
use Builder\Application\Commands\SetupCommand;
use Builder\Application\Commands\TestMakeCommand;
use Builder\Application\Commands\UnUseCommand;
use Builder\Application\Commands\UpdateCommand;
use Builder\Application\Commands\UseCommand;

class ConsoleServiceProvider extends ServiceProvider
{
    protected $defer = false;

    /**
     * The available commands
     *
     * @var array
     */
    protected $commands = [
        CommandMakeCommand::class,
        ControllerMakeCommand::class,
        DisableCommand::class,
        DumpCommand::class,
        EnableCommand::class,
        EventMakeCommand::class,
        JobMakeCommand::class,
        ListenerMakeCommand::class,
        MailMakeCommand::class,
        MiddlewareMakeCommand::class,
        NotificationMakeCommand::class,
        ProviderMakeCommand::class,
        RouteProviderMakeCommand::class,
        InstallCommand::class,
        ListCommand::class,
        ModuleMakeCommand::class,
        FactoryMakeCommand::class,
        PolicyMakeCommand::class,
        RequestMakeCommand::class,
        RuleMakeCommand::class,
        MigrateCommand::class,
        MigrateRefreshCommand::class,
        MigrateResetCommand::class,
        MigrateRollbackCommand::class,
        MigrateStatusCommand::class,
        MigrationMakeCommand::class,
        ModelMakeCommand::class,
        PublishCommand::class,
        PublishConfigurationCommand::class,
        PublishMigrationCommand::class,
        PublishTranslationCommand::class,
        SeedCommand::class,
        SeedMakeCommand::class,
        SetupCommand::class,
        UnUseCommand::class,
        UpdateCommand::class,
        UseCommand::class,
        ResourceMakeCommand::class,
        TestMakeCommand::class,
        AdminProviderMakeCommand::class,
        AdminRouteProviderMakeCommand::class,
        AdminSeedMakeCommand::class,
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
