<?php

namespace App\Console\Commands\Bonus;

use App\Http\Controllers\UserPublicController;
use App\User;
use Illuminate\Console\Command;

class Retained extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bonus:retained';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ejecuta el pago de bono retenido';

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
        $users = User::query();

        foreach ($users->cursor() as $user){
            // verificacion bono retenido, en caso de existir bono se agrega al balance
            $addBonusRetained = new UserPublicController;
            $addBonusRetained->addBonusRetained($user->id);
        }
        echo "Comando ejecutado";
    }
}
