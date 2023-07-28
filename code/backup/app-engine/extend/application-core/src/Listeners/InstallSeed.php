<?php

namespace DevEngine\Core\Listeners;

use DevEngine\Database\Core\Seeders\DatabaseSeeder;
/**
 * 数据安装接口
 */
class InstallSeed
{

    /**
     * @param $event
     * @return string
     */
    public function handle($event)
    {
        return DatabaseSeeder::class;
    }
}

