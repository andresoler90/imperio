<?php

namespace App\Console\Commands\Multilevel;

use App\Http\Controllers\Libs\Multilevel;
use App\Models\UserBalance;
use App\Models\UserMembership;
use App\Models\UserMultilevel;
use Illuminate\Console\Command;

class DirectBonus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'multilevel:directbonus';

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
        $userMemberships = UserMembership::where('status', 'A')->get();
        foreach ($userMemberships as $userMembership) {

            $user = $userMembership->user;
            $multilevel = new Multilevel($user);
            if ($user->position_preference == 'I') {
                $nodes = $multilevel->underLeftNode();
            } else {
                $nodes = $multilevel->underRightNode();
            }

            if ($nodes) {
                //Recorremos todos los nodos
                foreach ($nodes as $node) {
                    //Verificamos que el nodo no este por debajo del usuario, es decir, ya que el bono se genera apartir del segundo nivel
                    if ($node->parent_users_id != $userMembership->users_id) {
                        $userBalance = UserBalance::where('users_id', $user->id)->where('created_user', $node->user->id)->get();
                        if (!count($userBalance)) {
                            $membership = $node->user->membership;
                            if ($membership) {
                                $amount = $membership->price;
                                $userBalance = new UserBalance();
                                $userBalance->users_id = $user->id;
                                $userBalance->created_user = $node->user->id;
                                $userBalance->amount = ($amount * 7) / 100;
                                $userBalance->type = 'binary_direct_bonus';
                                $userBalance->save();
                            }
                        }
                    }
                }
            }
        }
    }
}
