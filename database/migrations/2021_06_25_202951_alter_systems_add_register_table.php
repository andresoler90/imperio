<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterSystemsAddRegisterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('systems', function ($table) {
            $table->string('comment')->after('value')->comment('Comentarios')->nullable();
        });

        DB::table('systems')->insert([
            ['parameter' => 'registration_value', 'value' => 29, 'comment' => 'Valor de inscripción por paquete (Registro)'],
            ['parameter' => 'remove_minimum',     'value' => 50, 'comment' => 'Retiro mínimo para el sistema (Pagos)'],
            ['parameter' => 'remove_commission',  'value' => 10, 'comment' => 'Comisión por retiro (Pagos)'],
        ]);

        DB::table('systems')
            ->where('parameter', 'transfer_percentage')
            ->update(['value' => 5,'comment' => 'Comisión por transferencia']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('systems', function (Blueprint $table) {
            $table->dropColumn('comment');
        });
        DB::table('systems')->where('parameter', '=', 'registration_value')->delete();
        DB::table('systems')->where('parameter', '=', 'remove_minimum')->delete();
        DB::table('systems')->where('parameter', '=', 'remove_commission')->delete();
        DB::table('systems')
            ->where('parameter', 'transfer_percentage')
            ->update(['value' => 3]);
    }
}
