<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('users_id')->comment('Usuario creador');
            $table->foreign('users_id')->references('id')->on('users');

            $table->unsignedInteger('languages_id');
            $table->foreign('languages_id')->references('id')->on('languages');

            $table->string('title');
            $table->text('body');
            $table->text('iframe')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news');
    }
}
