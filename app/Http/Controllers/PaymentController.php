<?php

namespace App\Http\Controllers;


use App\Http\Coinpayments\CoinpaymentsAPI;
use App\Http\Controllers\Libs\Multilevel;
use App\Models\System;
use App\Models\UserMembership;
use http\Exception;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class PaymentController extends Controller
{
    private $private_key = 'C297f8834b75dC5Aee32FDa67dB1D9345F1bf80BA9a4Ac7433ea4d6D9D6466c5';
    private $public_key = 'b3ee39afdcfe771ec0763347a7f6a9c2da17d9456861bb8b00600e23f8f5bd73';
    private $format = 'json';

    public function createPayment()
    {
        $id_user = Auth::user()->id;
        $membership = UserMembership::where('users_id', $id_user)->first();
        $user = User::where('id', $id_user)->first();

        /** Scenario: Create a simple transaction. **/

        // Create a new API wrapper instance
        $cps_api = new CoinpaymentsAPI($this->private_key, $this->public_key, $this->format);

        // Enter amount for the transaction
        $payment_membership_fee = System::where("parameter", "payment_membership_fee")->first();//Fee
        $amount = $membership->price + $payment_membership_fee->value;

        // Litecoin Testnet is a no value currency for testing
        $currency = 'LTCT';

        // Enter buyer email below
        $buyer_email = $user->email;

        // Enter buyer name
        $buyer_name = $user->name;

        // Enter item name
        $item_name = $membership->membership->name;

        // Enter item number
        $item_number = strval($membership->memberships_id);

        // Make call to API to create the transaction
        try {
            $transaction_response = $cps_api->CreateSimpleTransaction($amount, $currency, $buyer_email, $buyer_name, $item_name, $item_number);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
            exit();
        }

        if ($transaction_response['error'] == 'ok') {
            // Success!
            $date = new \DateTime();
            $date->format('d-m-Y H:i:s');
            $user_memberships = UserMembership::where('users_id', Auth::id())->first();
            $user_memberships->transaction_id = $transaction_response['result']['txn_id'];
            $user_memberships->transaction_address = $transaction_response['result']['address'];
            $user_memberships->transaction_url = $transaction_response['result']['status_url'];
            $user_memberships->transaction_amount = $transaction_response['result']['amount'];
            $user_memberships->transaction_date = $date;
            $user_memberships->save();

            if ($user_memberships->save()) {
                //Procedemos a cobrar el fee
                $userFee = new UserBalance();
                $userFee->users_id = Auth::id();
                $userFee->amount = $payment_membership_fee->value * -1;
                $userFee->type = "pay_membership_fee";
                $userFee->created_user = Auth::id();
                if ($userFee->save()) {
                    $multilevel = new Multilevel(Auth::user());
                    $multilevel->startBonus($user_memberships->price);
                    $multilevel->tripleBonus();
                    return redirect($transaction_response['result']['status_url']);
                }
            }
        } else {
            // Something went wrong!
            Alert::error('Error: ' . $transaction_response['error']);

            return back();
        }
    }
}
