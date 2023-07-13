<?php

namespace Builder\Application\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;

class ListCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'builder-application:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '查看所有的应用源码模块.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->table(['Name', 'Status', 'Order', 'Path'], $this->getRows());
    }

    /**
     * Get table rows.
     *
     * @return array
     */
    public function getRows()
    {
        $rows = [];

        foreach ($this->getModules() as $module) {
            $rows[] = [
                $module->getName(),
                $module->enabled() ? 'Enabled' : 'Disabled',
                $module->get('order'),
                $module->getPath(),
            ];
        }

        return $rows;
    }

    public function getModules()
    {
        switch ($this->option('only')) {
            case 'enabled':
                return $this->laravel['builder-application']->getByStatus(1);
                break;

            case 'disabled':
                return $this->laravel['builder-application']->getByStatus(0);
                break;

            case 'ordered':
                return $this->laravel['builder-application']->getOrdered($this->option('direction'));
                break;

            default:
                return $this->laravel['builder-application']->all();
                break;
        }
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['only', null, InputOption::VALUE_OPTIONAL, 'Types of modules will be displayed.', null],
            ['direction', 'd', InputOption::VALUE_OPTIONAL, '排序方向.', 'asc'],
        ];
    }
}
