<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableUserContactInformation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_contact_information', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('users_id')->unsigned();
            $table->foreign('users_id')->references('id')->on('users');

            $table->string('address1')->nullable();
            $table->string('address2')->nullable();
            $table->string('city')->nullable();
            $table->integer('gender')->nullable()->comment('0 => Masculino / 1 => Femenino');
            $table->date('birth_date')->nullable();
            $table->integer('code_postal')->nullable();
            $table->string('prefix_cellphone')->nullable();
            $table->string('cellphone1')->nullable();
            $table->string('cellphone2')->nullable();
            $table->integer('language')->default(0);
            $table->string('web_page')->nullable();
            $table->string('url_image')->nullable();
            $table->string('name_image')->nullable();


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
        Schema::dropIfExists('user_contact_information');
    }
}
