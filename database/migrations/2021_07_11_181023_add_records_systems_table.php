<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRecordsSystemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('systems')->insert([
            ['parameter' => 'percentage_delivered_bonus', 'value' => 85, 'comment' => 'Porcentaje del valor entregado del total del bono'],
            ['parameter' => 'percentage_retained_bonus', 'value' => 15, 'comment' => 'Porcentaje retenido en el bono, que se entregara despues de un tiempo definido'],
            ['parameter' => 'time_months_delivery', 'value' => 14, 'comment' => 'Tiempo definido en meses para entrega del valor retenido en el bono'],
            ['parameter' => 'multiplier_retained_bonus', 'value' => 1, 'comment' => 'Multiplicador del monto retenido'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('systems')->where('parameter', '=', 'percentage_delivered_bonus')->delete();
        DB::table('systems')->where('parameter', '=', 'percentage_retained_bonus')->delete();
        DB::table('systems')->where('parameter', '=', 'time_months_delivery')->delete();
        DB::table('systems')->where('parameter', '=', 'multiplier_retained_bonus')->delete();
    }
}
