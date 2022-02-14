<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('code')->comment('codigo unico del ticket');
            $table->unsignedBigInteger('users_id');
            $table->foreign('users_id')->references('id')->on('users');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('ticket_categories');
            $table->unsignedBigInteger('priority_id');
            $table->foreign('priority_id')->references('id')->on('ticket_priorities');
            $table->string('message')->comment('Descripcion del ticket');
            $table->string('subject')->comment('Asunto del ticket');
            $table->string('file_path')->comment('Archivo adjunto del ticket');
            $table->foreign('status_id')->references('id')->on('ticket_statuses');
            $table->unsignedBigInteger('status_id');
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
        Schema::dropIfExists('tickets');
    }
}
