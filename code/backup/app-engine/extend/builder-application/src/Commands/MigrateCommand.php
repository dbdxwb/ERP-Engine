<?php

namespace Builder\Application\Commands;

use Illuminate\Console\Command;
use Builder\Application\Migrations\Migrator;
use Builder\Application\Module;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class MigrateCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'builder-application:migrate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '从指定模块或所有模块迁移迁移.';

    /**
     * @var \Builder\Application\Contracts\RepositoryInterface
     */
    protected $module;

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->module = $this->laravel['builder-application'];

        $name = $this->argument('module');

        if ($name) {
            $module = $this->module->findOrFail($name);

            return $this->migrate($module);
        }

        foreach ($this->module->getOrdered($this->option('direction')) as $module) {
            $this->line('Running for builder-application: <info>' . $module->getName() . '</info>');

            $this->migrate($module);
        }
    }

    /**
     * Run the migration from the specified module.
     *
     * @param Module $module
     */
    protected function migrate(Module $module)
    {
        $path = str_replace(base_path(), '', (new Migrator($module))->getPath());

        if ($this->option('subpath')) {
            $path = $path . "/" . $this->option("subpath");
        }

        $this->call('migrate', [
            '--path'     => $path,
            '--database' => $this->option('database'),
            '--pretend'  => $this->option('pretend'),
            '--force'    => $this->option('force'),
        ]);

        if ($this->option('seed')) {
            $this->call('builder-application:seed', ['module' => $module->getName()]);
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
            ['direction', 'd', InputOption::VALUE_OPTIONAL, '排序方向.', 'asc'],
            ['database', null, InputOption::VALUE_OPTIONAL, '要使用的数据库连接.'],
            ['pretend', null, InputOption::VALUE_NONE, '转储将要运行的SQL查询.'],
            ['force', null, InputOption::VALUE_NONE, '在生产中强制运行操作.'],
            ['seed', null, InputOption::VALUE_NONE, '指示是否应重新运行种子任务.'],
            ['subpath', null, InputOption::VALUE_OPTIONAL, '指示要从中运行迁移的子路径'],
        ];
    }
}
