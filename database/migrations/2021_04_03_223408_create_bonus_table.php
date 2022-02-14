<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBonusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bonus', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->float('percentage')->comment('Porcentaje que se le asociara al bono el usuario');
            $table->boolean('required')->default(0)->nullable()->comment('Indica si es un bono que debe ser aplicado a todas las membresias');
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
        Schema::dropIfExists('bonus');
    }
}
