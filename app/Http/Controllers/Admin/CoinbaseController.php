<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentCoinbase;
use App\Models\UserMembership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\Types\Object_;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Config;
use App\User;


class CoinbaseController extends Controller
{
    public function index()
    {
        $listas = ['user', 'userMembership'];
        $reporteCoinbase = PaymentCoinbase::with($listas)->paginate(15);
        $widgets = $this->widgets();

        return view('cruds.CoinbaseReports.index', compact('reporteCoinbase', 'widgets'));
    }

    public function filtersCoinbase(Request $request)
    {
        $reporteCoinbase = PaymentCoinbase::select('payment_coinbase.*', 'users.name')
            ->addUser()
            ->filterByUser($request->username)
            ->filterByDates($request->dateIn, $request->dateEnd)
            ->get();

        $filters = $request;
        $widgets = $this->widgets();

        return view('cruds.CoinbaseReports.index', compact('reporteCoinbase', 'filters', 'widgets'));

    }

    public function widgets(): Object_
    {
        $data = new Object_();
        //Cuantas membresías se han solicitado en el mes
        $data->coinbaseSoliciteForMonth = PaymentCoinbase::dateRangeForMonthAndStatus()->count();
        // Cantas se han activado en el mes
        $data->coinbaseActiveForMonth = PaymentCoinbase::dateRangeForMonthAndStatus('V')->count();
        //Cuantas se han rechazado o cancelado
        $data->coinbaseCancelForMonth = PaymentCoinbase::dateRangeForMonthAndStatus('C')->count();
        //Facturación del mes
        $data->coinbaseFactureForMonth = PaymentCoinbase::factureForMonthOrTotal('Month')->get()->sum('amount');
        //Facturación total
        $data->coinbaseFactureForTotal = PaymentCoinbase::factureForMonthOrTotal('Total')->get()->sum('amount');

        return $data;

    }

}
