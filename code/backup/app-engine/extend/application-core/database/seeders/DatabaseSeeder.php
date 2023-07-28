<?php

namespace DevEngine\Database\Core\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $this->call(AreaTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(FileDirTableSeeder::class);
    }
}
