<?php

use Illuminate\Database\Seeder;

class RanksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ranks')->insert([
            "id"         => "1",
            "name"         => "UNRANKED",
            "pf"           => "0",
            "pd"           => "0",
            "min_ranks_id" => "",
            "image"        => "assets/images/rank/1.png",
            "requirements" => '',
            ]);
        DB::table('ranks')->insert([
            "id"         => "2",
            "name"         => "RANGO 1 PLATA",
            "pf"           => "3000",
            "pd"           => "1000",
            "min_ranks_id" => "1",
            "image"        => "assets/images/rank/2.png",
            "requirements" => 'Binario activo',
            ]);
        DB::table('ranks')->insert([
            "id"         => "3",
            "name"         => "RANGO 2 ORO",
            "pf"           => "9000",
            "pd"           => "6000",
            "min_ranks_id" => "2",
            "image"        => "assets/images/rank/3.png",
            "requirements" => 'Rango Plata directo a cada lado',
        ]);
        DB::table('ranks')->insert([
            "id"         => "4",
            "name"         => "RANGO 3 ZAFIRO",
            "pf"           => "24000",
            "pd"           => "16000",
            "min_ranks_id" => "3",
            "image"        => "assets/images/rank/4.png",
            "requirements" => 'Rango Oro directo a cada lado',
        ]);
        DB::table('ranks')->insert([
            "id"         => "5",
            "name"         => "RANGO 4 RUBI",
            "pf"           => "45000",
            "pd"           => "35000",
            "min_ranks_id" => "4",
            "image"        => "assets/images/rank/5.png",
            "requirements" => 'Rango Zafiro directo a cada lado',
        ]);
        DB::table('ranks')->insert([
            "id"         => "6",
            "name"         => "RANGO 5 ESMERALDA",
            "pf"           => "95000",
            "pd"           => "65000",
            "min_ranks_id" => "5",
            "image"        => "assets/images/rank/6.png",
            "requirements" => 'Rango Rubí directo a cada lado',
        ]);
        DB::table('ranks')->insert([
            "id"         => "7",
            "name"         => "RANGO 6 PLATINO",
            "pf"           => "145000",
            "pd"           => "95000",
            "min_ranks_id" => "6",
            "image"        => "assets/images/rank/7.png",
            "requirements" => 'Rango Esmeralda directo a cada lado',
        ]);
        DB::table('ranks')->insert([
            "id"         => "8",
            "name"         => "RANGO 7 DIAMANTE",
            "pf"           => "240000",
            "pd"           => "16000",
            "min_ranks_id" => "7",
            "image"        => "assets/images/rank/8.png",
            "requirements" => 'Rango Platino directo a cada lado',
        ]);
        DB::table('ranks')->insert([
            "id"         => "9",
            "name"         => "RANGO 8 DIAMANTE AZUL",
            "pf"           => "600000",
            "pd"           => "400000",
            "min_ranks_id" => "8",
            "image"        => "assets/images/rank/9.png",
            "requirements" => 'Rango Diamante directo a cada lado',
        ]);
        DB::table('ranks')->insert([
            "id"         => "10",
            "name"         => "RANGO 9 DIAMANTE NEGRO",
            "pf"           => "1500000",
            "pd"           => "1000000",
            "min_ranks_id" => "9",
            "image"        => "assets/images/rank/10.png",
            "requirements" => 'Rango Diamante azul directo a cada lado',
        ]);
        DB::table('ranks')->insert([
            "id"         => "11",
            "name"         => "RANGO 10 DIAMANTE CORONA",
            "pf"           => "3500000",
            "pd"           => "2400000",
            "min_ranks_id" => "10",
            "image"        => "assets/images/rank/11.png",
            "requirements" => 'Rango Diamante Negro directo a cada lado',
        ]);

    }
}
