<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_transfers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('from_users_id')->comment('Id del usuario que hace la transferencia')->unsigned();
            $table->foreign('from_users_id')->references('id')->on('users');
            $table->bigInteger('from_balance_id')->comment('Id de del balance que se transfirio')->unsigned();
            $table->foreign('from_balance_id')->references('id')->on('user_balances');
            $table->bigInteger('to_users_id')->comment('Id del usuario al que se le hace la transferencia')->unsigned();
            $table->foreign('to_users_id')->references('id')->on('users');
            $table->bigInteger('to_balance_id')->comment('Id de del balance que se recibio')->unsigned();
            $table->foreign('to_balance_id')->references('id')->on('user_balances');
            $table->string('comment')->comment('Es la nota por la cual se transfiere');
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
        Schema::dropIfExists('user_transfers');
    }
}
