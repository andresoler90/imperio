<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_scores', function (Blueprint $table) {
            $table->id();
            $table->float('amount',null)->comment('Cantidad de puntos');
            $table->enum('side',['D','I'])->comment('Lado del binario D: Derecha / I: Izquierda');
            $table->unsignedBigInteger('users_id')->comment('Usuario');
            $table->foreign('users_id')->references('id')->on('users');
            $table->bigInteger('created_user')->comment('Id del usuario que creo el registro')->unsigned()->nullable();
            $table->foreign('created_user')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_scores');
    }
}
