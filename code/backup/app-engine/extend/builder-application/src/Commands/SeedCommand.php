<?php

namespace Builder\Application\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Support\Str;
use Builder\Application\Contracts\RepositoryInterface;
use Builder\Application\Module;
use Builder\Application\Support\Config\GenerateConfigReader;
use Builder\Application\Traits\ModuleCommandTrait;
use RuntimeException;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class SeedCommand extends Command
{
    use ModuleCommandTrait;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'builder-application:seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '从指定模块或所有模块运行数据库种子程序.';

    /**
     * Execute the console command.
     * @throws FatalThrowableError
     */
    public function handle()
    {
        try {
            if ($name = $this->argument('module')) {
                $name = Str::studly($name);
                $this->moduleSeed($this->getModuleByName($name));
            } else {
                $modules = $this->getModuleRepository()->getOrdered();
                array_walk($modules, [$this, 'moduleSeed']);
                $this->info('All modules seeded.');
            }
        } catch (\Throwable $e) {
            $this->reportException($e);

            $this->renderException($this->getOutput(), $e);

            return 1;
        }
    }

    /**
     * @throws RuntimeException
     * @return RepositoryInterface
     */
    public function getModuleRepository(): RepositoryInterface
    {
        $modules = $this->laravel['builder-application'];
        if (!$modules instanceof RepositoryInterface) {
            throw new RuntimeException('未找到模块存储库！');
        }

        return $modules;
    }

    /**
     * @param $name
     *
     * @throws RuntimeException
     *
     * @return Module
     */
    public function getModuleByName($name)
    {
        $modules = $this->getModuleRepository();
        if ($modules->has($name) === false) {
            throw new RuntimeException("应用源码模块 [$name] 不存在！");
        }

        return $modules->find($name);
    }

    /**
     * @param Module $module
     *
     * @return void
     */
    public function moduleSeed(Module $module)
    {
        $seeders = [];
        $name = $module->getName();
        $config = $module->get('migration');
        if (is_array($config) && array_key_exists('seeds', $config)) {
            foreach ((array)$config['seeds'] as $class) {
                if (class_exists($class)) {
                    $seeders[] = $class;
                }
            }
        } else {
            $class = $this->getSeederName($name); //legacy support
            if (class_exists($class)) {
                $seeders[] = $class;
            } else {
                //look at other namespaces
                $classes = $this->getSeederNames($name);

                foreach($classes as $class) {
                    if (class_exists($class)) {
                        $seeders[] = $class;
                    }
                }
            }
        }

        if (count($seeders) > 0) {
            array_walk($seeders, [$this, 'dbSeed']);
            $this->info("模块 [$name] 数据初始化成功.");
        }
    }

    /**
     * Seed the specified module.
     *
     * @param string $className
     */
    protected function dbSeed($className)
    {
        if ($option = $this->option('class')) {
            $params['--class'] = Str::finish(substr($className, 0, strrpos($className, '\\')), '\\') . $option;
        } else {
            $params = ['--class' => $className];
        }

        if ($option = $this->option('database')) {
            $params['--database'] = $option;
        }

        if ($option = $this->option('force')) {
            $params['--force'] = $option;
        }

        $this->call('db:seed', $params);
    }

    /**
     * Get master database seeder name for the specified module.
     *
     * @param string $name
     *
     * @return string
     */
    public function getSeederName($name)
    {
        $name = Str::studly($name);

        $namespace = $this->laravel['builder-application']->config('namespace');
        $seederPath = GenerateConfigReader::read('seeder');
        $seederPath = str_replace('/', '\\', $seederPath->getPath());

        return $namespace . '\\' . $name . '\\' . $seederPath . '\\' . $name . 'DatabaseSeeder';
    }

    /**
     * Get master database seeder name for the specified module under a different namespace than Modules.
     *
     * @param string $name
     *
     * @return array $foundModules array containing namespace paths
     */
    public function getSeederNames($name)
    {
        $name = Str::studly($name);

        $seederPath = GenerateConfigReader::read('seeder');
        $seederPath = str_replace('/', '\\', $seederPath->getPath());

        $foundModules = [];
        foreach($this->laravel['builder-application']->config('scan.paths') as $path) {
            $namespace = array_slice(explode('/', $path), -1)[0];
            $foundModules[] = $namespace. '\\' . $name . '\\' . $seederPath . '\\' . $name . 'DatabaseSeeder';
        }

        return $foundModules;
    }

    /**
     * Report the exception to the exception handler.
     *
     * @param  \Symfony\Component\Console\Output\OutputInterface  $output
     * @param  \Throwable  $e
     * @return void
     */
    protected function renderException($output, \Throwable $e)
    {
        $this->laravel[ExceptionHandler::class]->renderForConsole($output, $e);
    }

    /**
     * Report the exception to the exception handler.
     *
     * @param  \Throwable  $e
     * @return void
     */
    protected function reportException(\Throwable $e)
    {
        $this->laravel[ExceptionHandler::class]->report($e);
    }

    /**
     * Get the console command arguments.
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
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['class', null, InputOption::VALUE_OPTIONAL, 'The class name of the root seeder.'],
            ['database', null, InputOption::VALUE_OPTIONAL, 'The database connection to seed.'],
            ['force', null, InputOption::VALUE_NONE, '在生产中强制运行操作.'],
        ];
    }
}
