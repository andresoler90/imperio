<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable()->comment('texto que se muestra');
            $table->string('url')->nullable()->comment('Dirección al que debe apuntar el link');
            $table->string('route')->nullable()->comment('Ruta a la que debe apuntar el link');
            $table->string('icon')->nullable()->comment('Clase del fontawesome que se muestra junto al link');
            $table->string('class')->nullable()->comment('Clase css que se debe aplicar al campo');
            $table->string('menus_id')->nullable()->comment('Menu padre');

            $table->bigInteger('roles_id')->comment('Id del role que puede ver la opcion')->unsigned();
            $table->foreign('roles_id')->references('id')->on('roles');
            $table->bigInteger('created_user')->comment('Id del usuario que creo el registro')->unsigned();
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
        Schema::dropIfExists('menus');
    }
}
