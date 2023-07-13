<?php

namespace Builder\Application\Commands;

use Illuminate\Support\Str;
use Builder\Application\Support\Config\GenerateConfigReader;
use Builder\Application\Support\Stub;
use Builder\Application\Traits\ModuleCommandTrait;
use Symfony\Component\Console\Input\InputArgument;

class RuleMakeCommand extends GeneratorCommand
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
    protected $name = 'builder-application:make-rule';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '为指定的模块创建新的验证规则.';

    public function getDefaultNamespace() : string
    {
        return $this->laravel['builder-application']->config('paths.generator.rules.path', 'Rules');
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, '规则类的名称.'],
            ['module', InputArgument::OPTIONAL, '将使用模块的名称.'],
        ];
    }

    /**
     * @return mixed
     */
    protected function getTemplateContents()
    {
        $module = $this->laravel['builder-application']->findOrFail($this->getModuleName());

        return (new Stub('/rule.stub', [
            'NAMESPACE' => $this->getClassNamespace($module),
            'CLASS'     => $this->getClass(),
        ]))->render();
    }

    /**
     * @return mixed
     */
    protected function getDestinationFilePath()
    {
        $path = $this->laravel['builder-application']->getModulePath($this->getModuleName());

        $rulePath = GenerateConfigReader::read('rules');

        return $path . $rulePath->getPath() . '/' . $this->getFileName() . '.php';
    }

    /**
     * @return string
     */
    private function getFileName()
    {
        return Str::studly($this->argument('name'));
    }
}
