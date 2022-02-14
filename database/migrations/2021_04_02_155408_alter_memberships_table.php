<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterMembershipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('memberships', function ($table) {
            $table->enum('amount_type', [
                'USD',
                'BTC',
                'ETH',
                'XAU',
                'TRX'
            ])->after('amount')->comment('Tipo de moneda en la que se genera la membresia');
            $table->dropColumn('access_product');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('memberships', function ($table) {
            $table->boolean('access_product')->comment('Indica si la membresia tiene acceso al producto')->after('amount')->default(0);
            $table->dropColumn('amount_type');
        });
    }
}
