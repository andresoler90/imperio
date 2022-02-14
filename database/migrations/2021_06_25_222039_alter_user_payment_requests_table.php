<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUserPaymentRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_payment_requests', function ($table) {
            $table->float('remove_commission', 8, 2)->after('amount_remove')
                ->comment('Comision por retiro')
                ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_payment_requests', function (Blueprint $table) {
            $table->dropColumn('remove_commission');
        });
    }
}
