<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->comment('Descripcion del paquete')->nullable();
            $table->integer('commission')->comment('Comision por clicks realizados')->default(0);
            $table->integer('commission_referred')->comment('Comision por referidos a la plataforma')->default(0);
            $table->string('image')->comment('Imagen asociada al paquete')->nullable();
            $table->integer('expiration_days')->comment('Dias por el cual se encuentra habilitado el paquete');
            $table->integer('clicks')->comment('Cantidad de cliks habilitados');
            $table->integer('price')->comment('Precio');
            $table->string('pair_price')->nullable();

            $table->bigInteger('created_user')->unsigned();
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
        Schema::dropIfExists('products');
    }
}
