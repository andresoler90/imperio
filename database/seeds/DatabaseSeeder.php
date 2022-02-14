<?php

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
        $this->call([
            RanksSeeder::class,
            CountriesSeeder::class,
            MembershipsSeeder::class,
            KycTypesSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            SystemSeeder::class,
            BonusSeeder::class,
        ]);
    }
}
