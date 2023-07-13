<?php

namespace Builder\Application\Commands;

use Illuminate\Console\Command;
use Builder\Application\Module;
use Builder\Application\Publishing\AssetPublisher;
use Symfony\Component\Console\Input\InputArgument;

class PublishCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'builder-application:publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '将模块的资产发布到应用程序';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if ($name = $this->argument('module')) {
            $this->publish($name);

            return;
        }

        $this->publishAll();
    }

    /**
     * Publish assets from all modules.
     */
    public function publishAll()
    {
        foreach ($this->laravel['builder-application']->allEnabled() as $module) {
            $this->publish($module);
        }
    }

    /**
     * Publish assets from the specified module.
     *
     * @param string $name
     */
    public function publish($name)
    {
        if ($name instanceof Module) {
            $module = $name;
        } else {
            $module = $this->laravel['builder-application']->findOrFail($name);
        }

        with(new AssetPublisher($module))
            ->setRepository($this->laravel['builder-application'])
            ->setConsole($this)
            ->publish();

        $this->line("<info>Published</info>: {$module->getStudlyName()}");
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['module', InputArgument::OPTIONAL, '将使用模块的名称.'],
        ];
    }
}
