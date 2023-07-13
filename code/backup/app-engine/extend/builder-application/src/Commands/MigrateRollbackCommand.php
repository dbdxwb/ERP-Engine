<?php

namespace Builder\Application\Commands;

use Illuminate\Console\Command;
use Builder\Application\Migrations\Migrator;
use Builder\Application\Traits\MigrationLoaderTrait;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class MigrateRollbackCommand extends Command
{
    use MigrationLoaderTrait;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'builder-application:migrate-rollback';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '回滚模块迁移.';

    /**
     * @var \Builder\Application\Contracts\RepositoryInterface
     */
    protected $module;

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->module = $this->laravel['builder-application'];

        $name = $this->argument('module');

        if (!empty($name)) {
            $this->rollback($name);

            return;
        }

        foreach ($this->module->getOrdered($this->option('direction')) as $module) {
            $this->line('Running for builder-application: <info>' . $module->getName() . '</info>');

            $this->rollback($module);
        }
    }

    /**
     * Rollback migration from the specified module.
     *
     * @param $module
     */
    public function rollback($module)
    {
        if (is_string($module)) {
            $module = $this->module->findOrFail($module);
        }

        $migrator = new Migrator($module);

        $database = $this->option('database');

        if (!empty($database)) {
            $migrator->setDatabase($database);
        }

        $migrated = $migrator->rollback();

        if (count($migrated)) {
            foreach ($migrated as $migration) {
                $this->line("Rollback: <info>{$migration}</info>");
            }

            return;
        }

        $this->comment('Nothing to rollback.');
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
            ['direction', 'd', InputOption::VALUE_OPTIONAL, '排序方向.', 'desc'],
            ['database', null, InputOption::VALUE_OPTIONAL, '要使用的数据库连接.'],
            ['force', null, InputOption::VALUE_NONE, '在生产中强制运行操作.'],
            ['pretend', null, InputOption::VALUE_NONE, '转储将要运行的SQL查询.'],
        ];
    }
}
