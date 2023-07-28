<?php

namespace DevEngine\Core\Console;

class AppBuild extends \DevEngine\Core\Console\Common\Stub
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:build';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '编译应用结构';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        app(\DevEngine\Core\Util\Build::class)->build();
        $this->info('编译结构成功');
    }

}
