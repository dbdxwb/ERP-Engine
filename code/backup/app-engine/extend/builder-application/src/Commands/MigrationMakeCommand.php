<?php

namespace Builder\Application\Commands;

use Illuminate\Support\Str;
use Builder\Application\Support\Config\GenerateConfigReader;
use Builder\Application\Support\Migrations\NameParser;
use Builder\Application\Support\Migrations\SchemaParser;
use Builder\Application\Support\Stub;
use Builder\Application\Traits\ModuleCommandTrait;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class MigrationMakeCommand extends GeneratorCommand
{
    use ModuleCommandTrait;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'builder-application:make-migration';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '为指定模块创建新迁移.';

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, '将创建迁移名称.'],
            ['module', InputArgument::OPTIONAL, '将创建模块的名称。'],
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
            ['fields', null, InputOption::VALUE_OPTIONAL, '指定字段表.', null],
            ['plain', null, InputOption::VALUE_NONE, '创建普通迁移.'],
        ];
    }

    /**
     * Get schema parser.
     *
     * @return SchemaParser
     */
    public function getSchemaParser()
    {
        return new SchemaParser($this->option('fields'));
    }

    /**
     * @throws \InvalidArgumentException
     *
     * @return mixed
     */
    protected function getTemplateContents()
    {
        $parser = new NameParser($this->argument('name'));

        if ($parser->isCreate()) {
            return Stub::create('/migration/create.stub', [
                'class' => $this->getClass(),
                'table' => $parser->getTableName(),
                'fields' => $this->getSchemaParser()->render(),
            ]);
        } elseif ($parser->isAdd()) {
            return Stub::create('/migration/add.stub', [
                'class' => $this->getClass(),
                'table' => $parser->getTableName(),
                'fields_up' => $this->getSchemaParser()->up(),
                'fields_down' => $this->getSchemaParser()->down(),
            ]);
        } elseif ($parser->isDelete()) {
            return Stub::create('/migration/delete.stub', [
                'class' => $this->getClass(),
                'table' => $parser->getTableName(),
                'fields_down' => $this->getSchemaParser()->up(),
                'fields_up' => $this->getSchemaParser()->down(),
            ]);
        } elseif ($parser->isDrop()) {
            return Stub::create('/migration/drop.stub', [
                'class' => $this->getClass(),
                'table' => $parser->getTableName(),
                'fields' => $this->getSchemaParser()->render(),
            ]);
        }

        return Stub::create('/migration/plain.stub', [
            'class' => $this->getClass(),
        ]);
    }

    /**
     * @return mixed
     */
    protected function getDestinationFilePath()
    {
        $path = $this->laravel['builder-application']->getModulePath($this->getModuleName());

        $generatorPath = GenerateConfigReader::read('migration');

        return $path . $generatorPath->getPath() . '/' . $this->getFileName() . '.php';
    }

    /**
     * @return string
     */
    private function getFileName()
    {
        return date('Y_m_d_His_') . $this->getSchemaName();
    }

    /**
     * @return array|string
     */
    private function getSchemaName()
    {
        return $this->argument('name');
    }

    /**
     * @return string
     */
    private function getClassName()
    {
        return Str::studly($this->argument('name'));
    }

    public function getClass()
    {
        return $this->getClassName();
    }

    /**
     * Run the command.
     */
    public function handle()
    {
        parent::handle();

        if (app()->environment() === 'testing') {
            return;
        }
    }
}
