<?php

namespace App\Console\Commands\Multilevel;

use App\Http\Controllers\Libs\Multilevel;
use App\User;
use Illuminate\Console\Command;
use function React\Promise\all;

class RegenerateRanks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'multilevel:regenerateranks';

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
        $users = User::where('ranks_id', '')->get();
        foreach ($users as $user) {
            $multilevel = new Multilevel($user);
            $rank = $multilevel->rank();
            $user->ranks_id = $rank;
            $user->save();
        }

        $users=User::all()->sortByDesc("id");
        foreach ($users as $user) {
            $multilevel = new Multilevel($user);
            $rank = $multilevel->rank();
            $user->ranks_id = $rank;
            $user->save();
        }

        return 0;
    }
}
