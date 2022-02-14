<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKycDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kyc_documents', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('users_id')->comment('Id del usuario que es dueño del documento')->unsigned();
            $table->bigInteger('kyc_types_id')->comment('Tipo de documento que sube el usuario')->unsigned();
            $table->bigInteger('approved_id')->comment('Id del usuario administrador que aprueba o rechaza el documento')->unsigned()->nullable();
            $table->text('comment')->comment('Comentarios asociados al documento')->nullable();
            $table->string('file')->comment('Nombre del documento dentro del sistema');
            $table->enum('status',[0,1,2])->comment('Estado de la subida del documento 0=esperando, 1=aprobacion, 2=cancelado')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('users_id')->references('id')->on('users');
            $table->foreign('kyc_types_id')->references('id')->on('kyc_types');
            $table->foreign('approved_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kyc_documents');
    }
}
