<?php

namespace App\Console\Commands\Coinmarketcap;

use App\Http\Controllers\Libs\CoinMarket;
use App\Models\Coinmarketcap;
use Illuminate\Console\Command;

class GetLatestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'coinmarketcap:latest';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Realiza la consulta de las ultimas monedas';

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
        $coinmarket = new CoinMarket();
        $response = $coinmarket->getLatest();

        foreach ($response->data as $symbol) {
            foreach ($symbol->quote as $key => $currency) {
                $register = new Coinmarketcap();
                $register->fill((array)$currency);
                $register->currency = $key;
                $register->symbol = $symbol->symbol;
                $register->save();
            }
        }
        return 0;
    }
}
