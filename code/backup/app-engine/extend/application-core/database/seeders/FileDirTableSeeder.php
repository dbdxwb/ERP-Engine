<?php

namespace DevEngine\Database\Core\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FileDirTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::table('file_dir')->insert([
            [
                'name' => '默认',
                'has_type' => 'admin',
            ],
            [
                'name' => '图片',
                'has_type' => 'admin',
            ],
            [
                'name' => '视频',
                'has_type' => 'admin',
            ],
            [
                'name' => '其他',
                'has_type' => 'admin',
            ],
        ]);


    }
}
