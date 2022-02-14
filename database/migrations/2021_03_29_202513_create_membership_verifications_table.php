<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembershipVerificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('membership_verifications', function (Blueprint $table) {
            $table->id();
            $table->text('support_document')->comment('nombre del documento');

            $table->unsignedBigInteger('user_memberships_id')->comment('Datos de la membresia');
            $table->foreign('user_memberships_id')->references('id')->on('user_memberships');
            $table->text('comment')->nullable();

            $table->unsignedBigInteger('confirm_user')->nullable();
            $table->foreign('confirm_user')->references('id')->on('users');

            $table->enum('status', ['P', 'A', 'R'])->default('P')->comment('P: Pendiente / A: Activo / R: Rechazado');
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
        Schema::dropIfExists('membership_verifications');
    }
}
