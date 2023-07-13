<?php

namespace Builder\Application\Commands;

use Illuminate\Console\Command;

class SetupCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'builder-application:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '设置首次使用的模块文件夹.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->generateModulesFolder();

        $this->generateAssetsFolder();
    }

    /**
     * Generate the modules folder.
     */
    public function generateModulesFolder()
    {
        $this->generateDirectory(
            $this->laravel['builder-application']->config('paths.modules'),
            '应用源码模块的文件夹创建成功',
            '应用源码模块的文件夹已经存在'
        );
    }

    /**
     * Generate the assets folder.
     */
    public function generateAssetsFolder()
    {
        $this->generateDirectory(
            $this->laravel['builder-application']->config('paths.assets'),
            '已成功创建资产目录',
            '资产目录已存在'
        );
    }

    /**
     * Generate the specified directory by given $dir.
     *
     * @param $dir
     * @param $success
     * @param $error
     */
    protected function generateDirectory($dir, $success, $error)
    {
        if (!$this->laravel['files']->isDirectory($dir)) {
            $this->laravel['files']->makeDirectory($dir, 0755, true, true);

            $this->info($success);

            return;
        }

        $this->error($error);
    }
}
