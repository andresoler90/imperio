<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterMembershipsFieldTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('memberships', function (Blueprint $table) {
            $table->enum('type',["subscription","membership"])->default("membership")->comment("Indica que tipo de membresia es")->after("amount_type");
            $table->float('cap')->default(0)->comment("Indica el maximo margen de ganancia que pudiese tener esta membresia")->after("amount_type");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('memberships', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->dropColumn('cap');
        });
    }
}
