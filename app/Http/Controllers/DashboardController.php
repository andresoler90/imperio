<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Libs\Multilevel;
use App\Models\BonusWeakLeg;
use App\Models\Coinmarketcap;
use App\Models\Membership;
use App\Models\News;
use App\Models\Rank;
use App\Models\UserMembership;
use App\User;
use Illuminate\Http\Request;
use Auth;
use phpDocumentor\Reflection\Types\Object_;
use App\Models\UserBalanceRoi;

class DashboardController extends Controller
{
    function index()
    {

        $news = News::query()->orderByDesc('id')->limit(4)->get();
        $membership = UserMembership::where('users_id', \Auth::id())->where('status', "A")->first();
        $mapCountry = $this->generateMapSubscription();
        $rankUser = Auth::user()->rank;
        $ranks = Rank::all();
        //dd($membership->membership);

        $coin = new \stdClass();
        $coin->btc = Coinmarketcap::where('symbol', 'BTC')->orderByDesc('created_at')->first();
        $coin->eth = Coinmarketcap::where('symbol', 'ETH')->orderByDesc('created_at')->first();
        $coin->tron = Coinmarketcap::where('symbol', 'TRX')->orderByDesc('created_at')->first();

        $UserBalanceRoi = UserBalanceRoi::where('users_id', Auth::id())->sum('amount');
        if ($membership) {
            $beforeBonus = BonusWeakLeg::where('users_id', $membership->users_id)->sum('difference');
        } else {
            $beforeBonus = 0;
        }

        $multilevel = new Multilevel(Auth::user());
        $widgets = $this->widgets();

        return view('Dashboard.index', compact("membership", 'coin', "news", 'multilevel', 'mapCountry', 'rankUser', 'ranks', 'widgets', 'UserBalanceRoi', 'beforeBonus'));
    }

    function dashboardTwo()
    {
        return view('Dashboard.dashboard_two');
    }

    function analytics()
    {
        return view('Dashboard.analytics');
    }

    function tracking()
    {
        return view('Dashboard.tracking');
    }

    function webAnalytics()
    {
        return view('Dashboard.web-analytics');
    }

    function patientDashboard()
    {
        return view('Dashboard.patient-dashboard');
    }

    function ticketBooking()
    {
        return view('Dashboard.ticket-booking');
    }

    /**
     * @return array
     */
    public function generateMapSubscription()
    {
        $memberships = User::select('countries.name', 'countries.code')
            ->join('user_memberships', 'user_memberships.users_id', '=', 'users.id')
            ->join('countries', 'countries.id', 'users.countries_id')
            ->where('user_memberships.status', "A")
            ->where('sponsor_id', Auth::user()->id)
            ->get()->toArray();
        $totalMemberships = count($memberships);
        $map = [];
        $code = [];
        foreach ($memberships as $membership) {
            $map[] = $membership['name'];
            $code[$membership['name']] = strtolower($membership['code']);
        }
        $mapCount = array_count_values($map);

        return (object)['mapCount' => $mapCount, 'totalMemberships' => $totalMemberships, 'code' => $code];
    }

    public function widgets(): Object_
    {

        $data = new Object_();
        //Comisiones pagadas en quick start - al referido: monto global
        $data->balanceCommissionsPaidSponsor = User::AddSponsorBalances()->where('type', 'quick_start')->get()->sum('amount');
        //Comisiones pagadas en quick start - al que refiere: monto global
        $data->balanceCommissionsPaidUser = User::AddUserBalances()->where('type', 'quick_start')->get()->sum('amount');
        //Rentabilidades pagadas en membresias .

        // Se comnenta para que muestre en el dasboard
        //$data->balanceCommissionsPaidUserId = User::AddUserBalancesById()->where('type', 'quick_start')->get()->sum('amount');
        $data->balanceCommissionsPaidUserId = User::AddUserBalancesById()->get()->sum('amount');
        //dd($data->balanceCommissionsPaidUserId);
        $data->balanceRentability = User::AddUserBalances()->where('type', 'daily_subsidy')->get()->sum('amount');
        //Cantidad de membresias activas.
        $data->balanceMembershipActives = UserMembership::where('status', 'A')->count();

        return $data;

    }
}
