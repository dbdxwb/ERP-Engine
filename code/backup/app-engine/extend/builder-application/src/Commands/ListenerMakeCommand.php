<?php

namespace Builder\Application\Commands;

use Builder\Application\Module;
use Builder\Application\Support\Config\GenerateConfigReader;
use Builder\Application\Support\Stub;
use Builder\Application\Traits\ModuleCommandTrait;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class ListenerMakeCommand extends GeneratorCommand
{
    use ModuleCommandTrait;

    protected $argumentName = 'name';

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'builder-application:make-listener';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '为指定的应用源码模块创建新的监听类';

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, '命令的名称.'],
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
            ['event', 'e', InputOption::VALUE_OPTIONAL, '正在收听的事件类.'],
            ['queued', null, InputOption::VALUE_NONE, '指示事件侦听器应排队.'],
        ];
    }

    protected function getTemplateContents()
    {
        $module = $this->laravel['builder-application']->findOrFail($this->getModuleName());

        return (new Stub($this->getStubName(), [
            'NAMESPACE'      => $this->getNamespace($module),
            'EVENTNAME'      => $this->getEventName($module),
            'SHORTEVENTNAME' => $this->option('event'),
            'CLASS'          => $this->getClass(),
        ]))->render();
    }

    private function getNamespace($module)
    {
        $listenerPath = GenerateConfigReader::read('listener');

        $namespace = str_replace('/', '\\', $listenerPath->getPath());

        return $this->getClassNamespace($module) . "\\" . $namespace;
    }

    protected function getEventName(Module $module)
    {
        $eventPath = GenerateConfigReader::read('event');

        return $this->getClassNamespace($module) . "\\" . $eventPath->getPath() . "\\" . $this->option('event');
    }

    protected function getDestinationFilePath()
    {
        $path = $this->laravel['builder-application']->getModulePath($this->getModuleName());

        $listenerPath = GenerateConfigReader::read('listener');

        return $path . $listenerPath->getPath() . '/' . $this->getFileName() . '.php';
    }

    /**
     * @return string
     */
    protected function getFileName()
    {
        return Str::studly($this->argument('name'));
    }

    /**
     * @return string
     */
    protected function getStubName(): string
    {
        if ($this->option('queued')) {
            if ($this->option('event')) {
                return '/listener-queued.stub';
            }

            return '/listener-queued-duck.stub';
        }

        if ($this->option('event')) {
            return '/listener.stub';
        }

        return '/listener-duck.stub';
    }
}
