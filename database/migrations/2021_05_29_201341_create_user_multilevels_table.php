<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserMultilevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_multilevels', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('users_id')->comment('Usuario');
            $table->foreign('users_id')->references('id')->on('users');
            $table->unsignedBigInteger('parent_users_id')->comment('Padre dentro del multinivel');
            $table->foreign('parent_users_id')->references('id')->on('users');
            $table->enum('position', ['D', 'I'])->comment('Posicion dentro del nivel D: Derecha / I: Izquierda');
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
        Schema::dropIfExists('user_multilevels');
    }
}
