<?php

namespace Builder\Application\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;

/**
 *--------------------------------------------------------------------------
 * 名称：关闭源码应用模块
 *--------------------------------------------------------------------------
 * 描述：关闭源码应用模块
 *--------------------------------------------------------------------------
 * 创建时间：2022/8/8 11:36
 *--------------------------------------------------------------------------
 * USER:646196128@qq.com
 */
class DisableCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'builder-application:disable';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '关闭源码应用模块.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $module = $this->laravel['builder-application']->findOrFail($this->argument('module'));

        if ($module->enabled()) {
            $module->disable();

            $this->info("应用源码模块 [{$module}] 关闭成功！");
        } else {
            $this->comment("应用源码模块 [{$module}] 已经被关闭！");
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
