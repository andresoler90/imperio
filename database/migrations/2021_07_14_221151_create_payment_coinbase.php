<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentCoinbase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_coinbase', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('users_id');
            $table->unsignedBigInteger('user_memberships_id');
            $table->foreign('users_id')->references('id')->on('users');
            $table->foreign('user_memberships_id')->references('id')->on('user_memberships');
            $table->string('serial');
            $table->string('transaction_id');
            $table->string('amount');
            $table->string('identification_document')->nullable()->comment('documento de identidad');
            $table->string('cellphone')->nullable()->comment('Numero telefonico');
            $table->enum('status' ,[
                'P',
                'V',
                'C'
            ]) ->comment('P =>Pendiente / V => Verificado / C => cancelado');
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
        Schema::dropIfExists('payment_coinbase');
    }
}

