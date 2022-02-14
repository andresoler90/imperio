<?php

use Illuminate\Database\Seeder;
use \App\Models\UserBalance;
class UserBalanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(UserBalance::class,500)->create();
    }
}
