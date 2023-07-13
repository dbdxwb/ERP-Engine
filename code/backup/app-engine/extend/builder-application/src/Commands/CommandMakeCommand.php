<?php

namespace Builder\Application\Commands;

use Illuminate\Support\Str;
use Builder\Application\Support\Config\GenerateConfigReader;
use Builder\Application\Support\Stub;
use Builder\Application\Traits\ModuleCommandTrait;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

/**
 *--------------------------------------------------------------------------
 * 名称：创建一个新的源码应用的命令行
 *--------------------------------------------------------------------------
 * 描述：创建一个新的源码应用的命令行
 *--------------------------------------------------------------------------
 * 创建时间：2022/8/6 15:33
 *--------------------------------------------------------------------------
 * USER:646196128@qq.com
 */
class CommandMakeCommand extends GeneratorCommand
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
    protected $name = 'builder-application:make-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '创建一个新的源码应用.';

    public function getDefaultNamespace(): string
    {
        return $this->laravel['builder-application']->config('paths.generator.command.path', 'Console');
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, '这个名称是一个命令.'],
            ['module', InputArgument::OPTIONAL, '当前名称已经被使用.'],
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
            ['command', null, InputOption::VALUE_OPTIONAL, 'The terminal command that should be assigned.', null],
        ];
    }

    /**
     * @return mixed
     */
    protected function getTemplateContents()
    {
        $module = $this->laravel['builder-application']->findOrFail($this->getModuleName());

        return (new Stub('/command.stub', [
            'COMMAND_NAME' => $this->getCommandName(),
            'NAMESPACE'    => $this->getClassNamespace($module),
            'CLASS'        => $this->getClass(),
        ]))->render();
    }

    /**
     * @return string
     */
    private function getCommandName()
    {
        return $this->option('command') ?: 'command:name';
    }

    /**
     * @return mixed
     */
    protected function getDestinationFilePath()
    {
        $path = $this->laravel['builder-application']->getModulePath($this->getModuleName());

        $commandPath = GenerateConfigReader::read('command');

        return $path . $commandPath->getPath() . '/' . $this->getFileName() . '.php';
    }

    /**
     * @return string
     */
    private function getFileName()
    {
        return Str::studly($this->argument('name'));
    }
}
