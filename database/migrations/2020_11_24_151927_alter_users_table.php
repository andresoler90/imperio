<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('lastname')->after('name')->comment('Apellido de la persona')->nullable();
            $table->string('username')->after('email_verified_at')->comment('Usuario')->nullable();

            $table->bigInteger('roles_id')->after('password')->comment('Id del role asociado al usuario')->unsigned()->nullable()->default(2);
            $table->foreign('roles_id')->references('id')->on('roles');
            $table->bigInteger('sponsor_id')->after('roles_id')->comment('Id del usuario que lo refirio')->unsigned()->nullable();
            $table->bigInteger('countries_id')->after('sponsor_id')->comment('Id del pais')->unsigned()->nullable();
            $table->foreign('countries_id')->references('id')->on('countries');

            $table->bigInteger('created_user')->after('created_at')->comment('Id del usuario que creo el registro')->unsigned()->nullable();
            $table->bigInteger('updated_user')->after('updated_at')->comment('Id del usuario que actualizo el registro')->unsigned()->nullable();
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
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('roles_id');
            $table->dropColumn('created_user');
            $table->dropColumn('updated_user');
        });
    }
}
