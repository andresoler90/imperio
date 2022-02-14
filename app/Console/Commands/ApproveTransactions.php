<?php

namespace App\Console\Commands;

use App\Http\Controllers\SearchPaymentController;
use Illuminate\Console\Command;

class ApproveTransactions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'coinpayment:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Comando para buscar transacciones y aprobarlas';

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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handle()
    {
        $searchPayment = new SearchPaymentController();

        return $searchPayment->get_tx_ids();

    }
}
