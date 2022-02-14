<?php

namespace App\Console\Commands\Bonus;

use App\Http\Controllers\Libs\BonusMethods;
use App\User;
use Illuminate\Console\Command;

class Profitability extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bonus:profitability';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ejecuta el pago del bono de rentabilidad';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::all();
        foreach ($users as $user) {
            if ($user->membership) {
                $bonusmethod = new BonusMethods($user->membership);
                $bonusmethod->execute('profitability');
            }
        }
    }
}
