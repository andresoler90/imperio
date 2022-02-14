<?php

namespace App\Http\Controllers\Libs;

use App\Http\Controllers\Controller;
use App\Models\Bonus;
use App\Models\BonusWeakLeg;
use App\Models\System;
use App\Models\UserBalance;
use App\Models\UserBalanceRoi;
use App\Models\UserBonusRetained;
use App\Models\UserMembership;
use App\Models\UserMultilevel;
use App\Models\PaymentCoinbase;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BonusMethods extends Controller
{

    /**
     * @var \App\Models\Membership|null
     */
    private $membership;

    /**
     * @var UserMembership
     */
    private $userMembership;

    /**
     * @var User|null
     */
    private $user;
    /**
     * @var mixed|null
     */
    private $userBonus;
    /**
     * @var \Illuminate\Database\Eloquent\HigherOrderBuilderProxy|mixed|string
     */
    private $percentageDelivered;
    /**
     * @var \Illuminate\Database\Eloquent\HigherOrderBuilderProxy|mixed|string
     */
    private $percentageRetained;

    public function __construct($userMembership = null)
    {
        if ($userMembership) {
            $this->user = $userMembership->user;
            $this->membership = $userMembership->membership;
            $this->userMembership = $userMembership;
            $this->userBonus = $userMembership->userBonus;
            $this->percentageDelivered = System::where('parameter', 'percentage_delivered_bonus')->first()->value;
            $this->percentageRetained = System::where('parameter', 'percentage_retained_bonus')->first()->value;
        }
    }


    /**
     * Bono de inicio rapido, da
     * @param User $user
     * @param $amount
     * @return bool
     */
    public function quick_start($amount, $percentage)
    {
        $sponsor = $this->user->sponsor;

        if ($differenceBonus = $this->validateCap($this->user)) {

            if (count($this->validateDirectPositions($sponsor)) > 1) {//Verificamos si el usuario tiene ambas posiciones en sus referidos
                $commision = 7;
            } else {
                $commision = 0;
            }

            $balance = new UserBalance();
            $totalAmount = ($amount * $commision) / 100;
            $balance->users_id = $sponsor->id;
            // El monto total del bono se le saca el porcentaje configurado
            $balance->amount = ($totalAmount) * 0.85;
//            $balance->amount = ($totalAmount * $this->percentageDelivered) / 100;
            if ($balance->amount > $differenceBonus) {
                $balance->amount = $differenceBonus;
            }
            $balance->type = "quick_start";
            $balance->created_user = $this->user->id;
            if ($balance->save()) {
                $this->saveBonusRetained($totalAmount, $balance->id, $sponsor->id);
            }
        }
    }

    public function quick_start_subscription()
    {
        $sponsor = $this->user->sponsor;
        if ($sponsor) {
            for ($i = 1; $i <= 3; $i++) {
                switch ($i) {
                    case 1:
                        $percentage = 7;
                        break;
                    case 2:
                        $percentage = 2;
                        break;
                    case 3:
                        $percentage = 1;
                        break;
                    default:
                        $percentage = 0;
                }

                $balance = new UserBalance();
                $balance->users_id = $sponsor->id;
                $balance->amount = ($this->userMembership->price * $percentage) / 100;;
                $balance->type = "quick_start_suscription";
                $balance->created_user = $this->user->id;
                if ($balance->save()) {
                    $sponsor = $sponsor->sponsor;
                }
            }
            return true;
        }

        return false;
    }

    /**
     * Se encarga de executar el bono
     * @param $bonusName
     */
    public function execute($bonusName)
    {

        if (method_exists($this, $bonusName)) {

            $dbBonus = Bonus::where('name', $bonusName)->first();
            $func = $dbBonus->name;
            $this->$func($this->userMembership->price, $dbBonus->percentage);

        } else {
            echo "El metodo $bonusName no existe";
            return false;
        }

    }

    public function profitability($amount, $percentage)
    {

        //Se valida que el monto recibido en bonos no supere el cap definido por la membresia
        if ($differenceBonus = $this->validateCap($this->user)) {

            $total = $amount + $this->userMembership->amount_additional;
            $amount = ($total * $percentage) / 100;
            $balance = new UserBalance();
            $balance->users_id = $this->user->id;
            $balance->amount = ($amount * $this->percentageDelivered) / 100;
            if ($balance->amount > $differenceBonus) {
                $balance->amount = $differenceBonus;
            }
            $balance->type = "profitability";
            $balance->created_user = $this->user->id;
            if ($balance->save()) {
                $this->saveBonusRetained($amount, $balance->id, $this->user->id);
            }

            return true;
        }
        return false;
    }


    public function leader()
    {
        //Se valida que el monto recibido en bonos no supere el cap definido por la membresia

        $totalCompany = UserMembership::where('status', 'A')->sum('price');
        $usersFour = User::where('ranks_id', 5)->get();
        if (count($usersFour)) {
            $rankFour = ($totalCompany * 0.01) / User::where('ranks_id', 5)->count();
            foreach (User::where('ranks_id', 5)->get() as $user) {
                if ($differenceBonus = $this->validateCap($user)) {
                    $userBalance = new UserBalance();
                    $userBalance->users_id = $user->id;
                    $userBalance->amount = $rankFour;
                    if ($userBalance->amount > $differenceBonus) {
                        $userBalance->amount = $differenceBonus;
                    }
                    $userBalance->type = 'leader_bonus_4';
                    $userBalance->created_user = '1';
                    $userBalance->save();
                }
            }

            $usersSix = User::where('ranks_id', 5)->get();
            if (count($usersSix)) {
                $rankSix = ($totalCompany * 0.02) / User::where('ranks_id', 7)->count();
                foreach (User::where('ranks_id', 7)->get() as $user) {
                    if ($differenceBonus = $this->validateCap($user)) {
                        $userBalance = new UserBalance();
                        $userBalance->users_id = $user->id;
                        $userBalance->amount = $rankSix;
                        if ($userBalance->amount > $differenceBonus) {
                            $userBalance->amount = $differenceBonus;
                        }
                        $userBalance->type = 'leader_bonus_6';
                        $userBalance->created_user = '1';
                        $userBalance->save();
                    }
                }
            }

            $usersEight = User::where('ranks_id', 5)->get();
            if (count($usersEight)) {
                $rankEight = ($totalCompany * 0.03) / User::where('ranks_id', 9)->count();
                foreach (User::where('ranks_id', 9)->get() as $user) {
                    if ($differenceBonus = $this->validateCap($user)) {
                        $userBalance = new UserBalance();
                        $userBalance->users_id = $user->id;
                        $userBalance->amount = $rankEight;
                        if ($userBalance->amount > $differenceBonus) {
                            $userBalance->amount = $differenceBonus;
                        }
                        $userBalance->type = 'leader_bonus_8';
                        $userBalance->created_user = '1';
                        $userBalance->save();
                    }
                }
            }
        }
        return false;
    }

    /**
     * Ejecuta el bono de pierna debil
     * Se parte de la idea de que el multinivel empieza desde el administrador
     */
    public function weakLeg()
    {

        $userMultilevels = UserMultilevel::all();
        foreach ($userMultilevels as $um) {
            $user = $um->user;
            if (count($this->validateDirectPositions($user)) > 1) {//Verificamos si el usuario tiene ambas posiciones en sus referidos

                //Se valida que el monto recibido en bonos no supere el cap definido por la membresia
                $differenceBonus = $this->validateCap($user);
                if ($differenceBonus) {
                    if ($user) {
                        $multilevel = new Multilevel($user);
                        $volumeRight = $multilevel->volumeNode('D');
                        $volumeLeft = $multilevel->volumeNode('I');

                        if ($volumeRight > $volumeLeft) {
                            $pf = $volumeRight;
                            $pd = $volumeLeft;
                        } else {
                            $pf = $volumeLeft;
                            $pd = $volumeRight;
                        }

                        $beforeBonus = BonusWeakLeg::where('users_id', $um->users_id)->sum('difference');
                        if ($beforeBonus) {
                            $difference = abs($pd - $beforeBonus);
                        } else {
                            $difference = $pd;
                        }

                        $bonusWeak = new BonusWeakLeg();
                        $bonusWeak->users_id = $um->users_id;
                        $bonusWeak->pf = $pf;
                        $bonusWeak->pd = $pd;
                        $bonusWeak->difference = $difference;
                        $bonusWeak->save();

                        $userMembership = $um->user->membership;
                        if ($userMembership) {
                            //TODO Revisar estos rangos con robert luego
                            if ($userMembership->price >= 100 & $userMembership->price <= 1000) {
                                $amount = $difference * 0.07;
                            } elseif ($userMembership->price >= 3000 & $userMembership->price <= 10000) {
                                $amount = $difference * 0.08;
                            } elseif ($userMembership->price >= 15000 & $userMembership->price <= 50000) {
                                $amount = $difference * 0.10;
                            } else {
                                $amount = 0;
                            }

                            if ($amount) {

                                $userBalance = new UserBalance();
                                $userBalance->users_id = $um->users_id;
                                $userBalance->amount = $amount * 0.85;
                                if ($userBalance->amount > $differenceBonus) {
                                    $userBalance->amount = $differenceBonus;
                                }
                                $userBalance->type = 'bonus_weak_leg';
                                $userBalance->created_user = '1';
                                if ($userBalance->save()) {
                                    $this->saveBonusRetained($amount, $userBalance->id, $um->users_id);
                                }
                            }
                        }
                    }
                }
            }
        }
        return false;
    }

    public function saveBonusRetained($totalAmount, $balance_id, $user_id)
    {
        $bonusRetained = new UserBonusRetained();
        $bonusRetained->users_id = $user_id;
        $bonusRetained->user_balances_id = $balance_id;
        $bonusRetained->total = $totalAmount;
        // El porcentaje retenido del monto total
        $bonusRetained->amount = ($totalAmount * $this->percentageRetained) / 100;
        $bonusRetained->percentage_balance = $this->percentageDelivered;
        $bonusRetained->percentage_retained = $this->percentageRetained;
        $bonusRetained->save();
    }

    public function roi($memberships)
    {
        foreach ($memberships as $membershipId => $porcentage) {
            if ($porcentage) {
                //Buscamos todos los usuarios que tengan la misma membresia
                $userMembership = UserMembership::where('memberships_id', $membershipId)->where('status', 'A')->get();
                //dd($userMembership);
                foreach ($userMembership as $um) {
                    if (!$um->user->has_vip) {
                        $balanceRoi = new UserBalanceRoi();
                        $balanceRoi->users_id = $um->users_id;
                        $balanceRoi->amount = ($um->membership->amount * $porcentage) / 100; // se agrega monto de mebresia, ya que de usermembresip usuarios anteriores no guardo el upgrade y no quedo registrado el monto de la nueva membresia
                        $balanceRoi->type = 'bonus_roi';
                        $balanceRoi->created_user = Auth::id();
                        $balanceRoi->save();

                        //Verificamos si al usuario ya se le realizo el pago del doble de su inversion
                        $totalUserBalance = UserBalanceRoi::where('type', 'bonus_roi')->where('users_id', $um->users_id)->sum('amount');
                        if ($totalUserBalance >= ($um->membership->amount)) { //($um->price * 2)) {
                            $um->expiration_description = 'bonus_roi';
                            $um->expiration_date = date('Y-m-d H:i:s');
                            $um->save();
                            $um->delete();
                        }
                    }
                }
            }
        }

        return true;
    }

    /**
     * Valida si el usuario a alcanzo el cap de bonos permitidos para la membresia
     * @param User $user
     */
    public function validateCap(User $user)
    {
        $balanceBonus = UserBalance::whereIn('type', config('bonus'))->where('users_id', $user->id)->sum('amount');

        if ($user->membership) {
            $membership = $user->membership->membership;
            if ($membership->cap > 0) {
                if ($balanceBonus < $membership->cap) {
                    return $membership->cap - floatval($balanceBonus);
                }
            }
        }
        return false;
    }

    /**
     * @param User $user
     */
    public function validateDirectPositions(User $user)
    {
        $referreds = User::where('sponsor_id', $user->id)
            ->join('user_multilevels', 'users.id', 'user_multilevels.users_id')
            ->groupBy('position')
            ->get();

        if ($referreds) {
            return $referreds;
        } else {
            return [];
        }
    }

}
