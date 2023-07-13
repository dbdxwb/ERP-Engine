<?php

namespace Builder\Application\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;

/**
 *--------------------------------------------------------------------------
 * 名称：打开源码应用模块
 *--------------------------------------------------------------------------
 * 描述：打开源码应用模块
 *--------------------------------------------------------------------------
 * 创建时间：2022/8/8 11:36
 *--------------------------------------------------------------------------
 * USER:646196128@qq.com
 */
class EnableCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'builder-application:enable';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '打开源码应用模块.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $module = $this->laravel['builder-application']->findOrFail($this->argument('module'));

        if ($module->disabled()) {
            $module->enable();

            $this->info("Module [{$module}] enabled successful.");
        } else {
            $this->comment("Module [{$module}] has already enabled.");
        }
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['module', InputArgument::REQUIRED, 'Module name.'],
        ];
    }
}
