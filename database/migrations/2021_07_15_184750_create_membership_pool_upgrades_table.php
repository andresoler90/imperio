<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembershipPoolUpgradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('membership_pool_upgrades', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('users_id')->comment('Usuario solicitante');
            $table->foreign('users_id')->references('id')->on('users');

            $table->unsignedBigInteger('memberships_id')->comment('Membresia');
            $table->foreign('memberships_id')->references('id')->on('memberships');

            $table->enum('status', ['P', 'A', 'R'])->default('P')->comment('P: Pendiente / A: Activo / R: Rechazado');

            $table->unsignedBigInteger('confirm_user')->nullable()->comment('Usuario que aprueba upgrade');
            $table->foreign('confirm_user')->references('id')->on('users');

            $table->text('support_document')->comment('nombre del documento');
            $table->string('identification_document')->nullable()->comment('Documento de identidad');
            $table->string('cellphone')->nullable()->comment('Telefono');
            $table->string('type')->nullable()->comment('Tipo');

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
        Schema::dropIfExists('membership_pool_upgrades');
    }
}
