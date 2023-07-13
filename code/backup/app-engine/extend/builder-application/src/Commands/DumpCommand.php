<?php

namespace Builder\Application\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;

/**
 *--------------------------------------------------------------------------
 * 名称：转储自动加载指定模块或所有模块
 *--------------------------------------------------------------------------
 * 描述：转储自动加载指定模块或所有模块
 *--------------------------------------------------------------------------
 * 创建时间：2022/8/8 11:36
 *--------------------------------------------------------------------------
 * USER:646196128@qq.com
 */
class DumpCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'builder-application:dump';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '转储自动加载指定模块或所有模块。';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('生成优化的自动加载模块。');

        if ($module = $this->argument('module')) {
            $this->dump($module);
        } else {
            foreach ($this->laravel['builder-application']->all() as $module) {
                $this->dump($module->getStudlyName());
            }
        }
    }

    public function dump($module)
    {
        $module = $this->laravel['builder-application']->findOrFail($module);

        $this->line("<comment>Running for module</comment>: {$module}");

        chdir($module->getPath());

        passthru('composer dump -o -n -q');
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['module', InputArgument::OPTIONAL, 'Module name.'],
        ];
    }
}
