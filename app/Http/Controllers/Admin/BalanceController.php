<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserBalance;
use App\Models\UserMembership;
use App\User;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Object_;

class BalanceController extends Controller
{
    public function index()
    {
        $balances = UserBalance::paginate(15);
        $type = UserBalance::pluck('type','type')->toArray();
        $widgets = $this->widgets();

        return view('reports.balance.index',compact('balances','type','widgets'));

    }

    public function filters(Request $request)
    {
        $balances = UserBalance::select('user_balances.*', 'users.name')
            ->addUser()
            ->filterByUser($request->username)
            ->filterByDates($request->dateIn, $request->dateEnd)
            ->filterByType($request->type)
            ->get();

        $widgets = $this->widgets();
        $type = UserBalance::pluck('type', 'type')->toArray();
        $filters = $request;

        return view('reports.balance.index', compact('balances', 'type', 'filters','widgets'));
    }

    public function widgets(): Object_
    {

        $data = new Object_();
        //Comisiones pagadas en quick start - al referido: monto global
        $data->balanceCommissionsPaidSponsor = User::AddSponsorBalances()->where('type','quick_start')->get()->sum('amount');
        //Comisiones pagadas en quick start - al que refiere: monto global
        $data->balanceCommissionsPaidUser = User::AddUserBalances()->where('type','quick_start')->get()->sum('amount');
        //Rentabilidades pagadas en membresias .
        $data->balanceRentability = User::AddUserBalances()->where('type','daily_subsidy')->get()->sum('amount');
        //Cantidad de membresias activas.
        $data->balanceMembershipActives = UserMembership::where('status','A')->count();

        return $data;

    }

}
