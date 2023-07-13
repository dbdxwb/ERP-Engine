<?php

namespace Builder\Application\Commands;

use Illuminate\Console\Command;
use Builder\Application\Migrations\Migrator;
use Builder\Application\Module;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class MigrateStatusCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'builder-application:migrate-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '所有模块迁移的状态';

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

            return $this->migrateStatus($module);
        }

        foreach ($this->module->getOrdered($this->option('direction')) as $module) {
            $this->line('Running for builder-application: <info>' . $module->getName() . '</info>');
            $this->migrateStatus($module);
        }
    }

    /**
     * Run the migration from the specified module.
     *
     * @param Module $module
     */
    protected function migrateStatus(Module $module)
    {
        $path = str_replace(base_path(), '', (new Migrator($module))->getPath());

        $this->call('migrate:status', [
            '--path' => $path,
            '--database' => $this->option('database'),
        ]);
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
        ];
    }
}
