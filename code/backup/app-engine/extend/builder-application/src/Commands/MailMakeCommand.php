<?php

namespace Builder\Application\Commands;

use Builder\Application\Support\Config\GenerateConfigReader;
use Builder\Application\Support\Stub;
use Builder\Application\Traits\ModuleCommandTrait;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;

class MailMakeCommand extends GeneratorCommand
{
    use ModuleCommandTrait;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'builder-application:make-mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '为指定的模块创建新的电子邮件类';

    protected $argumentName = 'name';

    public function getDefaultNamespace(): string
    {
        return $this->laravel['builder-application']->config('paths.generator.emails.path', 'Emails');
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, '可邮寄邮件的名称.'],
            ['module', InputArgument::OPTIONAL, '将使用模块的名称.'],
        ];
    }

    /**
     * Get template contents.
     *
     * @return string
     */
    protected function getTemplateContents()
    {
        $module = $this->laravel['builder-application']->findOrFail($this->getModuleName());

        return (new Stub('/mail.stub', [
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

        $mailPath = GenerateConfigReader::read('emails');

        return $path . $mailPath->getPath() . '/' . $this->getFileName() . '.php';
    }

    /**
     * @return string
     */
    private function getFileName()
    {
        return Str::studly($this->argument('name'));
    }
}
