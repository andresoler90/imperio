<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('users_id')->comment('Id del usuario')->unsigned();
            $table->foreign('users_id')->references('id')->on('users');

            $table->bigInteger('products_id')->comment('Id del producto')->unsigned();
            $table->foreign('products_id')->references('id')->on('products');

            $table->bigInteger('created_user')->unsigned();
            $table->foreign('created_user')->references('id')->on('users');

            $table->date('expiration_date')->comment('Fecha en el que vence el producto para el usuario');
            $table->integer('price')->comment('Monto por el que pago el usuario al momento de la compra');
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
        Schema::dropIfExists('user_products');
    }
}
