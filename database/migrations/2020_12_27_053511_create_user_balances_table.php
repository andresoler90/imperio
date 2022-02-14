<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserBalancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_balances', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('users_id')->comment('Id del usuario al que se le cargo el registro')->unsigned();
            $table->foreign('users_id')->references('id')->on('users');
            $table->float('amount')->comment('Monto abonado');
            $table->string('type')->comment('Tipo de registro');
            $table->bigInteger('created_user')->comment('Id del usuario que creo el registro')->unsigned()->nullable();
            $table->foreign('created_user')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_balances');
    }
}
