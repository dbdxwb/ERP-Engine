<?php

namespace Builder\Application\Commands;

use Builder\Application\Support\Config\GenerateConfigReader;
use Builder\Application\Support\Stub;
use Builder\Application\Traits\ModuleCommandTrait;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;

class EventMakeCommand extends GeneratorCommand
{
    use ModuleCommandTrait;

    protected $argumentName = 'name';

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'builder-application:make-event';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '为指定的应用源码模块创建新的事件类';

    public function getTemplateContents()
    {
        $module = $this->laravel['builder-application']->findOrFail($this->getModuleName());

        return (new Stub('/event.stub', [
            'NAMESPACE' => $this->getClassNamespace($module),
            'CLASS'     => $this->getClass(),
        ]))->render();
    }

    public function getDestinationFilePath()
    {
        $path = $this->laravel['builder-application']->getModulePath($this->getModuleName());

        $eventPath = GenerateConfigReader::read('event');

        return $path . $eventPath->getPath() . '/' . $this->getFileName() . '.php';
    }

    /**
     * @return string
     */
    protected function getFileName()
    {
        return Str::studly($this->argument('name'));
    }

    public function getDefaultNamespace(): string
    {
        return $this->laravel['builder-application']->config('paths.generator.event.path', 'Events');
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the event.'],
            ['module', InputArgument::OPTIONAL, '将使用模块的名称.'],
        ];
    }
}
