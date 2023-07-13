<?php

namespace Builder\Application\Commands;

use Illuminate\Console\Command;

class UnUseCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'builder-application:unuse';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '丢弃正在使用的模块 builder-application:use';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->laravel['builder-application']->forgetUsed();

        $this->info('Previous module used successfully forgotten.');
    }
}
