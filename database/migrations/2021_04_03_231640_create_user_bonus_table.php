<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserBonusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_bonus', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('users_id')->comment('Usuario');
            $table->foreign('users_id')->references('id')->on('users');

            $table->unsignedBigInteger('user_memberships_id')->comment('Membresia');
            $table->foreign('user_memberships_id')->references('id')->on('user_memberships');

            $table->unsignedBigInteger('bonus_id')->comment('Bono');
            $table->foreign('bonus_id')->references('id')->on('bonus');

            $table->float('percentage')->comment('Porcentaje sobre el cual se ejecuta el bono');

            $table->unsignedBigInteger('created_user')->comment('Usuario que realizo el registro');
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
        Schema::dropIfExists('user_bonus');
    }
}
