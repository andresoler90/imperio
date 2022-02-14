<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterRanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('ranks', function (Blueprint $table) {
            $table->string('requirements')->after('image')->nullable()->comment('Requisitos minimos de rango');
        });

//        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
//        DB::table('ranks')->truncate();
//        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
//        //Artisan::call('db:seed', array('--class' => 'RanksSeeder'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ranks', function (Blueprint $table) {
            $table->dropColumn('requirements');
        });
    }
}
