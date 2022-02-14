<?php

use Illuminate\Database\Seeder;

class BonusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bonus')->insert([
            'name'        => 'quick_start',
            'description' => 'Bono de inicio rapido',
            'percentage'  => '20',
            'required'    => 1,
        ]);
    }
}
