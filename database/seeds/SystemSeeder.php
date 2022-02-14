<?php

use Illuminate\Database\Seeder;

class SystemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('systems')->insert([
            'parameter' => 'transfer_percentage',
            'comment'=>'Comisión por transferencia',
            'value'     => '5',
        ]);
        DB::table('systems')->insert([
            'parameter' => 'registration_value',
            'comment'=>'Valor de inscripción por paquete (Registro)',
            'value'     => '0',
        ]);
        DB::table('systems')->insert([
            'parameter' => 'remove_minimum',
            'comment'=>'Retiro mínimo para el sistema (Pagos)',
            'value'     => '50',
        ]);
        DB::table('systems')->insert([
            'parameter' => 'remove_commission',
            'comment'=>'Comisión por retiro (Pagos)',
            'value'     => '10',
        ]);
        DB::table('systems')->insert([
            'parameter' => 'percentage_delivered_bonus',
            'comment'=>'Porcentaje del valor entregado del total del bono',
            'value'     => '85',
        ]);
        DB::table('systems')->insert([
            'parameter' => 'percentage_retained_bonus',
            'comment'=>'Porcentaje retenido en el bono, que se entregara despues de un tiempo definido',
            'value'     => '15',
        ]);
        DB::table('systems')->insert([
            'parameter' => 'time_months_delivery',
            'comment'=>'Tiempo definido en meses para entrega del valor retenido en el bono',
            'value'     => '14',
        ]);
        DB::table('systems')->insert([
            'parameter' => 'multiplier_retained_bonus',
            'comment'=>'Multiplicador del monto retenido',
            'value'     => '1',
        ]);
        DB::table('systems')->insert([
            'parameter' => 'kyc_for_buy',
            'comment'=>'Indica si se debe solicitar el kyc en la compra membresias 1: Activo / 0: Desactivado',
            'value'     => '1',
        ]);
    }
}
