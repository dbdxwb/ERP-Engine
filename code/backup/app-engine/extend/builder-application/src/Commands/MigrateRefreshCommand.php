<?php

namespace Builder\Application\Commands;

use Illuminate\Console\Command;
use Builder\Application\Traits\ModuleCommandTrait;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class MigrateRefreshCommand extends Command
{
    use ModuleCommandTrait;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'builder-application:migrate-refresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '回滚并重新迁移模块迁移.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->call('builder-application:migrate-reset', [
            'module' => $this->getModuleName(),
            '--database' => $this->option('database'),
            '--force' => $this->option('force'),
        ]);

        $this->call('builder-application:migrate', [
            'module' => $this->getModuleName(),
            '--database' => $this->option('database'),
            '--force' => $this->option('force'),
        ]);

        if ($this->option('seed')) {
            $this->call('builder-application:seed', [
                'module' => $this->getModuleName(),
            ]);
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
            ['module', InputArgument::OPTIONAL, '将使用模块的名称.'],
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['database', null, InputOption::VALUE_OPTIONAL, '要使用的数据库连接.'],
            ['force', null, InputOption::VALUE_NONE, '在生产中强制运行操作.'],
            ['seed', null, InputOption::VALUE_NONE, '指示是否应重新运行种子任务.'],
        ];
    }

    public function getModuleName()
    {
        $module = $this->argument('module');

        $module = app('modules')->find($module);

        if ($module === null) {
            return $module;
        }

        return $module->getStudlyName();
    }
}
