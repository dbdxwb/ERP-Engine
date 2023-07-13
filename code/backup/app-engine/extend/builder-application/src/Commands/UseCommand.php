<?php

namespace Builder\Application\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;

class UseCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'builder-application:use';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '使用指定的模块.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $module = Str::studly($this->argument('module'));

        if (!$this->laravel['builder-application']->has($module)) {
            $this->error("Module [{$module}] does not exists.");

            return;
        }

        $this->laravel['builder-application']->setUsed($module);

        $this->info("Module [{$module}] used successfully.");
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['module', InputArgument::REQUIRED, '将使用模块的名称.'],
        ];
    }
}
