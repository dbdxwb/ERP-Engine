<?php

namespace Builder\Application\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class PublishConfigurationCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'builder-application:publish-config';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '将模块的配置文件发布到应用程序';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if ($module = $this->argument('module')) {
            $this->publishConfiguration($module);

            return;
        }

        foreach ($this->laravel['builder-application']->allEnabled() as $module) {
            $this->publishConfiguration($module->getName());
        }
    }

    /**
     * @param string $module
     * @return string
     */
    private function getServiceProviderForModule($module)
    {
        $namespace = $this->laravel['config']->get('modules.namespace');
        $studlyName = Str::studly($module);

        return "$namespace\\$studlyName\\Providers\\{$studlyName}ServiceProvider";
    }

    /**
     * @param string $module
     */
    private function publishConfiguration($module)
    {
        $this->call('vendor:publish', [
            '--provider' => $this->getServiceProviderForModule($module),
            '--force' => $this->option('force'),
            '--tag' => ['config'],
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
            ['module', InputArgument::OPTIONAL, '正在使用的模块的名称.'],
        ];
    }

    /**
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['--force', '-f', InputOption::VALUE_NONE, '强制发布配置文件'],
        ];
    }
}
