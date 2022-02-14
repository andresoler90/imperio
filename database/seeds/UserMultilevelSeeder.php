<?php

use Illuminate\Database\Seeder;

class UserMultilevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\UserMultilevel::class,50)->create();

    }
}
