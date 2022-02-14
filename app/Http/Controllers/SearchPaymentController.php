<?php

namespace App\Http\Controllers;

use App\Http\Coinpayments\CoinpaymentsAPI;
use App\Models\MembershipPaymentStatus;
use App\Models\UserMembership;
use http\Exception;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class SearchPaymentController extends Controller
{
    private $private_key = 'C297f8834b75dC5Aee32FDa67dB1D9345F1bf80BA9a4Ac7433ea4d6D9D6466c5';
    private $public_key = 'b3ee39afdcfe771ec0763347a7f6a9c2da17d9456861bb8b00600e23f8f5bd73';
    private $format = 'json';

    public function get_tx_ids()
    {
        /** Scenario: Get all transactions. **/

        $transaction_id = UserMembership::all()->pluck('transaction_id')->toArray();

        foreach ($transaction_id as $tx_id){
            // El número máximo de IDs de transacciones a devolver de 1 a 100. (por defecto: 25)
            $txid = implode('|',$transaction_id);
        }

        // Create a new API wrapper instance
        $cps_api = new CoinpaymentsAPI($this->private_key, $this->public_key, $this->format);

        // Desde qué transacción # comenzar (para la iteración/paginación.) (por defecto: 0, comienza con sus transacciones más recientes.)
        $full = 1;

        // Make call to API to create the transaction
        try {
            $transaction_response = $cps_api->SearchAllTransaction($txid, $full);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
            exit();
        }

        if ($transaction_response['error'] == 'ok') {
            // Success!
            $i=0;
            $j=0;
            foreach ($transaction_response['result'] as $key=>$id_transaction) {

                $update_status = UserMembership::where('transaction_id', $key)->first();
                if ($id_transaction['status'] == 100){
                    $update_status->status = 'A';

                    if ($update_status->save()) {
                        $i++;
                    }

                }else {
                    $j++;
                }

                $status_payment = new MembershipPaymentStatus();
                $status_payment->id_user_membership = $update_status->id;
                $status_payment->id_transaction = $key;
                $status_payment->status = $id_transaction['status'];
                $status_payment->status_description = $id_transaction['status_text'];
                $status_payment->type_coin = $id_transaction['coin'];
                $status_payment->payment_received = $id_transaction['amount'];
                $status_payment->save();
            }

            echo 'Pagos confirmados : '.$i.' Pagos por confirmar : '.$j;
        } else {
            // Something went wrong!
            echo 'Error: ' . $transaction_response['error'];

            return back();
        }
    }
}
