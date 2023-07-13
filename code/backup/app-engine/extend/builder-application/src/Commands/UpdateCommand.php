<?php

namespace Builder\Application\Commands;

use Illuminate\Console\Command;
use Builder\Application\Traits\ModuleCommandTrait;
use Symfony\Component\Console\Input\InputArgument;

class UpdateCommand extends Command
{
    use ModuleCommandTrait;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'builder-application:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '更新指定模块或所有模块的依赖项.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('module');

        if ($name) {
            $this->updateModule($name);

            return;
        }

        /** @var \Builder\Application\Module $module */
        foreach ($this->laravel['builder-application']->getOrdered() as $module) {
            $this->updateModule($module->getName());
        }
    }

    protected function updateModule($name)
    {
        $this->line('Running for builder-application: <info>' . $name . '</info>');

        $this->laravel['builder-application']->update($name);

        $this->info("Module [{$name}] updated successfully.");
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['module', InputArgument::OPTIONAL, '将更新模块的名称.'],
        ];
    }
}
