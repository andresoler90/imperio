<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserComunicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_comunications', function (Blueprint $table) {
            $table->id();
            $table->string('subject')->comment('Asunto del email');
            $table->text('message')->comment('Mensaje del email');
            $table->bigInteger('from_users_id')->comment('Id del usuario que envia el email')->unsigned();
            $table->foreign('from_users_id')->references('id')->on('users');
            $table->bigInteger('to_users_id')->comment('Id del usuario al que se le envia el email')->unsigned();
            $table->foreign('to_users_id')->references('id')->on('users');
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
        Schema::dropIfExists('user_comunications');
    }
}
