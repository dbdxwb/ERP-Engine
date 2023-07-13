<?php

namespace Builder\Application\Commands;

use Builder\Application\Support\Config\GenerateConfigReader;
use Builder\Application\Support\Stub;
use Builder\Application\Traits\ModuleCommandTrait;
use Symfony\Component\Console\Input\InputArgument;

class RouteProviderMakeCommand extends GeneratorCommand
{
    use ModuleCommandTrait;

    protected $argumentName = 'module';

    /**
     * The command name.
     *
     * @var string
     */
    protected $name = 'builder-application:route-provider';

    /**
     * The command description.
     *
     * @var string
     */
    protected $description = '为指定的模块创建新的路由服务提供程序。';

    /**
     * The command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
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

        return (new Stub('/route-provider.stub', [
            'NAMESPACE'        => $this->getClassNamespace($module),
            'CLASS'            => $this->getFileName(),
            'MODULE_NAMESPACE' => $this->laravel['builder-application']->config('namespace'),
            'MODULE'           => $this->getModuleName(),
            'WEB_ROUTES_PATH'  => $this->getWebRoutesPath(),
            'API_ROUTES_PATH'  => $this->getApiRoutesPath(),
            'LOWER_NAME'       => $module->getLowerName(),
        ]))->render();
    }

    /**
     * @return string
     */
    private function getFileName()
    {
        return 'RouteServiceProvider';
    }

    /**
     * Get the destination file path.
     *
     * @return string
     */
    protected function getDestinationFilePath()
    {
        $path = $this->laravel['builder-application']->getModulePath($this->getModuleName());

        $generatorPath = GenerateConfigReader::read('provider');

        return $path . $generatorPath->getPath() . '/' . $this->getFileName() . '.php';
    }

    /**
     * @return mixed
     */
    protected function getWebRoutesPath()
    {
        return '/' . $this->laravel['config']->get('stubs.files.routes', 'Routes/web.php');
    }

    /**
     * @return mixed
     */
    protected function getApiRoutesPath()
    {
        return '/' . $this->laravel['config']->get('stubs.files.routes', 'Routes/api.php');
    }

    public function getDefaultNamespace() : string
    {
        return $this->laravel['builder-application']->config('paths.generator.provider.path', 'Providers');
    }
}
