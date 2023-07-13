<?php

namespace Builder\Application\Commands;

use Illuminate\Console\Command;
use Builder\Application\Migrations\Migrator;
use Builder\Application\Publishing\MigrationPublisher;
use Symfony\Component\Console\Input\InputArgument;

class PublishMigrationCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'builder-application:publish-migration';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "将模块的迁移发布到应用程序";

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if ($name = $this->argument('module')) {
            $module = $this->laravel['builder-application']->findOrFail($name);

            $this->publish($module);

            return;
        }

        foreach ($this->laravel['builder-application']->allEnabled() as $module) {
            $this->publish($module);
        }
    }

    /**
     * Publish migration for the specified module.
     *
     * @param \Builder\Application\Module $module
     */
    public function publish($module)
    {
        with(new MigrationPublisher(new Migrator($module)))
            ->setRepository($this->laravel['builder-application'])
            ->setConsole($this)
            ->publish();
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['module', InputArgument::OPTIONAL, '正在使用的模块的名称.'],
        ];
    }
}
