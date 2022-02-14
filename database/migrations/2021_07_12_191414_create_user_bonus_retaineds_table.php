<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserBonusRetainedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_bonus_retaineds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('users_id')->comment('Usuario');
            $table->foreign('users_id')->references('id')->on('users');
            $table->unsignedBigInteger('user_balances_id')->comment('Balance');
            $table->foreign('user_balances_id')->references('id')->on('user_balances');
            $table->float('total')->comment('monto retenido + monto balance');
            $table->float('amount')->comment('monto retenido');
            $table->float('percentage_balance')->comment('Porcentaje del monto en el balance de usuario');
            $table->float('percentage_retained')->comment('Porcentaje del monto retenido');
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
        Schema::dropIfExists('user_bonus_retaineds');
    }
}
