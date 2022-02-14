<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KycTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kyc_types')->insert([
            'name'=>'Pasaporte delantero',
        ]);
        DB::table('kyc_types')->insert([
            'name'=>'Pasaporte reverso',
        ]);
        DB::table('kyc_types')->insert([
            'name'=>'Pasaporte selfie',
        ]);
        DB::table('kyc_types')->insert([
            'name'=>'Factura de servicio',
        ]);
    }
}
