<?php

namespace Builder\Application\Commands;

use Builder\Application\Support\Config\GenerateConfigReader;
use Builder\Application\Support\Stub;
use Builder\Application\Traits\ModuleCommandTrait;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;

final class NotificationMakeCommand extends GeneratorCommand
{
    use ModuleCommandTrait;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'builder-application:make-notification';

    protected $argumentName = 'name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '为指定的应用源码模块创建新的通知类.';

    public function getDefaultNamespace(): string
    {
        return $this->laravel['builder-application']->config('paths.generator.notifications.path', 'Notifications');
    }

    /**
     * Get template contents.
     *
     * @return string
     */
    protected function getTemplateContents()
    {
        $module = $this->laravel['builder-application']->findOrFail($this->getModuleName());

        return (new Stub('/notification.stub', [
            'NAMESPACE' => $this->getClassNamespace($module),
            'CLASS'     => $this->getClass(),
        ]))->render();
    }

    /**
     * Get the destination file path.
     *
     * @return string
     */
    protected function getDestinationFilePath()
    {
        $path = $this->laravel['builder-application']->getModulePath($this->getModuleName());

        $notificationPath = GenerateConfigReader::read('notifications');

        return $path . $notificationPath->getPath() . '/' . $this->getFileName() . '.php';
    }

    /**
     * @return string
     */
    private function getFileName()
    {
        return Str::studly($this->argument('name'));
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, '通知类的名称.'],
            ['module', InputArgument::OPTIONAL, '将使用模块的名称.'],
        ];
    }
}
