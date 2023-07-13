<?php

namespace Builder\Application\Commands;

use Illuminate\Console\Command;
use Builder\Application\Generators\ModuleGenerator;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class ModuleMakeCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'builder-application:make';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '创建一个新的源码应用模块.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $names = $this->argument('name');
        foreach ($names as $name) {
            with(new ModuleGenerator($name))
                ->setFilesystem($this->laravel['files'])
                ->setModule($this->laravel['builder-application'])
                ->setConfig($this->laravel['config'])
                ->setConsole($this)
                ->setForce($this->option('force'))
                ->setPlain($this->option('plain'))
                ->setIsAdmin($this->option('is_admin'))
                ->generate();
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
            ['name', InputArgument::IS_ARRAY, '将创建模块的名称.'],
        ];
    }

    protected function getOptions()
    {
        return [
            ['plain', 'p', InputOption::VALUE_NONE, '生成一个普通模块（没有一些资源）.'],
            ['is_admin', null, InputOption::VALUE_NONE, '是否生成管理后台.'],
            ['force', null, InputOption::VALUE_NONE, '当模块已存在时，强制运行该操作.'],
        ];
    }
}
