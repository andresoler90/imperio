<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserRoiRequest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_roi_request', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('users_id');
            $table->foreign('users_id')->references('id')->on('users');
            $table->double('amount_remove');
            $table->float('remove_commission', 8, 2)->comment('Comision por retiro')->nullable();
            $table->integer('type')->comment('0 => BITCOIN / 1 => ETHER');
            $table->string('address_wallet');
            $table->integer('status')->comment('0 => Pendiente / 1 => Pagado / 2 => Rechazado');
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
        Schema::dropIfExists('user_roi_request');
    }
}
