<?php

namespace Builder\Application\Commands;

use Illuminate\Console\Command;
use Builder\Application\Json;
use Builder\Application\Process\Installer;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class InstallCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'builder-application:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '按给定的软件包名称（供应商/名称）安装指定的应用源码模块.';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (is_null($this->argument('name'))) {
            $this->installFromFile();

            return;
        }

        $this->install(
            $this->argument('name'),
            $this->argument('version'),
            $this->option('type'),
            $this->option('tree')
        );
    }

    /**
     * Install modules from modules.json file.
     */
    protected function installFromFile()
    {
        if (!file_exists($path = base_path('modules.json'))) {
            $this->error("文件 'modules.json' 不在你的项目根目录.");

            return;
        }

        $modules = Json::make($path);

        $dependencies = $modules->get('require', []);

        foreach ($dependencies as $module) {
            $module = collect($module);

            $this->install(
                $module->get('name'),
                $module->get('version'),
                $module->get('type')
            );
        }
    }

    /**
     * Install the specified module.
     *
     * @param string $name
     * @param string $version
     * @param string $type
     * @param bool $tree
     */
    protected function install($name, $version = 'dev-master', $type = 'composer', $tree = false)
    {
        $installer = new Installer(
            $name,
            $version,
            $type ?: $this->option('type'),
            $tree ?: $this->option('tree')
        );

        $installer->setRepository($this->laravel['builder-application']);

        $installer->setConsole($this);

        if ($timeout = $this->option('timeout')) {
            $installer->setTimeout($timeout);
        }

        if ($path = $this->option('path')) {
            $installer->setPath($path);
        }

        $installer->run();

        if (!$this->option('no-update')) {
            $this->call('builder-application:update', [
                'module' => $installer->getModuleName(),
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
            ['name', InputArgument::OPTIONAL, '将安装模块的名称.'],
            ['version', InputArgument::OPTIONAL, '将安装模块的版本.'],
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
            ['timeout', null, InputOption::VALUE_OPTIONAL, '进程超时.', null],
            ['path', null, InputOption::VALUE_OPTIONAL, '安装路径.', null],
            ['type', null, InputOption::VALUE_OPTIONAL, '安装类型.', null],
            ['tree', null, InputOption::VALUE_NONE, '将模块安装为git子树', null],
            ['no-update', null, InputOption::VALUE_NONE, '禁用依赖项的自动更新.', null],
        ];
    }
}
