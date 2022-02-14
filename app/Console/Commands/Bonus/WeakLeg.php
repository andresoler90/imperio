<?php

namespace App\Console\Commands\Bonus;

use App\Http\Controllers\Libs\BonusMethods;
use App\Models\UserMembership;
use Illuminate\Console\Command;

class WeakLeg extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bonus:weakleg';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $userMembership = UserMembership::where('status', "A")->first(); //Solo se usa para inicializar la clase de los bonos, punto a mejorar en un futuro
        $bonusMethod = new BonusMethods($userMembership);
        $bonusMethod->weakLeg();
    }
}
