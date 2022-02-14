<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterPaymentCoinbaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payment_coinbase', function ($table) {
            $table->string('memberships_id')->nullable()->comment('Membresia que se esta pagando')->after('users_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payment_coinbase', function ($table) {
            $table->dropColumn('memberships_id');
        });
    }
}
