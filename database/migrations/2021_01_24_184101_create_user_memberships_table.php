<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserMembershipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_memberships', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('memberships_id')->unsigned()->comment('Id de la membresia');
            $table->foreign('memberships_id')->references('id')->on('memberships');

            $table->bigInteger('users_id')->unsigned()->comment('id del usuario');
            $table->foreign('users_id')->references('id')->on('users');

            $table->float('price')->comment('Monto que pago el usuario al momento de adquirir la membresia')->default(0);
            $table->date('expiration_date')->comment('Fecha en el que vence el producto para el usuario');
            $table->enum('status', [
                'P',
                'R',
                'A',
                'V'
            ])->comment('Estatus de la membresia P: Pendiente / R: Rechazado / A: Aprobado / V: Vencido')->default('P');
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
        Schema::dropIfExists('user_memberships');
    }
}

