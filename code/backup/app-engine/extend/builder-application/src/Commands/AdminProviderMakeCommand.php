<?php

namespace Builder\Application\Commands;

use Illuminate\Support\Str;
use Builder\Application\Module;
use Builder\Application\Support\Config\GenerateConfigReader;
use Builder\Application\Support\Stub;
use Builder\Application\Traits\ModuleCommandTrait;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class AdminProviderMakeCommand extends GeneratorCommand
{
    use ModuleCommandTrait;

    /**
     * The name of argument name.
     *
     * @var string
     */
    protected $argumentName = 'name';

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'builder-application:make-admin-provider';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '为指定的模块创建新的管理后台服务提供程序类.';

    public function getDefaultNamespace(): string
    {
        return $this->laravel['builder-application']->config('paths.generator.provider.path', 'Providers');
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, '服务提供商名称服务提供商名称.'],
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
            ['master', null, InputOption::VALUE_NONE, '指示主服务提供商', null],
        ];
    }

    /**
     * @return mixed
     */
    protected function getTemplateContents()
    {
        $stub = 'scaffold/provider-admin';

        /** @var Module $module */
        $module = $this->laravel['builder-application']->findOrFail($this->getModuleName());

        return (new Stub('/' . $stub . '.stub', [
            'NAMESPACE'        => $this->getClassNamespace($module),
            'CLASS'            => $this->getClass(),
            'LOWER_NAME'       => $module->getLowerName(),
            'MODULE'           => $this->getModuleName(),
            'NAME'             => $this->getFileName(),
            'STUDLY_NAME'      => $module->getStudlyName(),
            'MODULE_NAMESPACE' => $this->laravel['builder-application']->config('namespace'),
            'PATH_VIEWS'       => GenerateConfigReader::read('views')->getPath(),
            'PATH_LANG'        => GenerateConfigReader::read('lang')->getPath(),
            'PATH_CONFIG'      => GenerateConfigReader::read('config')->getPath(),
            'MIGRATIONS_PATH'  => GenerateConfigReader::read('migration')->getPath(),
            'FACTORIES_PATH'   => GenerateConfigReader::read('factory')->getPath(),
        ]))->render();
    }

    /**
     * @return mixed
     */
    protected function getDestinationFilePath()
    {
        $path = $this->laravel['builder-application']->getModulePath($this->getModuleName());

        $generatorPath = GenerateConfigReader::read('provider');

        return $path . $generatorPath->getPath() . '/' . $this->getFileName() . '.php';
    }

    /**
     * @return string
     */
    private function getFileName()
    {
        return Str::studly($this->argument('name'));
    }
}
