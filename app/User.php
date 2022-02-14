<?php

namespace App;

use App\Http\Controllers\Libs\Multilevel;
use App\Http\Controllers\UserPublicController;
use App\Models\KycDocument;
use App\Models\KycType;
use App\Models\Membership;
use App\Models\System;
use App\Models\UserBalance;
use App\Models\UserBalanceRoi;
use App\Models\UserBonusRetained;
use App\Models\UserPaymentRequest;
use App\Models\UserTask;
use Carbon\Carbon;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Lab404\Impersonate\Models\Impersonate;
use Laravel\Passport\HasApiTokens;
use Auth;

/**
 * App\User
 *
 * @property int $id
 * @property string $name
 * @property string|null $lastname Apellido de la persona
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string|null $username Usuario
 * @property string $password
 * @property string|null $api_token
 * @property int|null $roles_id Id del role asociado al usuario
 * @property int|null $sponsor_id Id del usuario que lo refirio
 * @property int|null $countries_id Id del pais
 * @property string|null $token_login
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property int|null $created_user Id del usuario que creo el registro
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $updated_user Id del usuario que actualizo el registro
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Client[] $clients
 * @property-read int|null $clients_count
 * @property-read \App\Models\UserContactInformation|null $contactInformation
 * @property-read \App\Models\Country|null $country
 * @property-read mixed $full_name
 * @property-read \App\Models\UserMembership|null $membership
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|UserPaymentRequest[] $payments
 * @property-read int|null $payments_count
 * @property-read \App\Models\Role|null $role
 * @property-read User|null $sponsor
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Token[] $tokens
 * @property-read int|null $tokens_count
 * @property-read \App\Models\UserMembership|null $userMembership
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Query\Builder|User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereApiToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCountriesId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRolesId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSponsorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTokenLogin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUsername($value)
 * @method static \Illuminate\Database\Query\Builder|User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|User withoutTrashed()
 * @mixin \Eloquent
 * @property int|null $ranks_id Rango del usuario
 * @property string|null $position_preference Indica en que posicion del binario desea que queden sus referidos D: Derecha / I:Izquierda
 * @property-read \App\Models\UserMembership|null $membershipActive
 * @property-read \App\Models\UserMultilevel|null $userMultilevel
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePositionPreference($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRanksId($value)
 * @property-read \App\Models\Rank|null $rank
 * @property int $vip 0 no se genera pago legacy / 1 Se genera pago legacy
 * @method static \Illuminate\Database\Eloquent\Builder|User whereVip($value)
 * @property-read \App\Models\UserContactInformation|null $userContacInformacion
 */
class User extends Authenticatable
{
    use Notifiable, SoftDeletes, Loggable, HasApiTokens, Impersonate;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'lastname',
        'countries_id',
        'username',
        'sponsor_id',
        'email',
        'roles_id',
        'password',
        'token_login'
    ];

    protected static $logAttributes = [
        'name',
        'email',
        'roles_id',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @var string
     */
    protected $primaryKey = 'id';

    public function role()
    {
        return $this->hasOne('App\Models\Role', 'id', 'roles_id');
    }

    public function country()
    {
        return $this->hasOne('App\Models\Country', 'id', 'countries_id');
    }

    public function sponsor()
    {
        return $this->hasOne('App\User', 'id', 'sponsor_id');
    }

    public function contactInformation()
    {
        return $this->hasOne('App\Models\UserContactInformation', 'users_id', 'id');
    }

    public function getFullNameAttribute()
    {
        return $this->name . " " . $this->lastname;
    }

    public function UserName()
    {
        return $this->username;
    }

    public function payments()
    {
        return $this->hasMany('App\Models\UserPaymentRequest', 'id', 'users_id');
    }

    public function balanceTotal()
    {
        $wallet = UserBalance::where('users_id', $this->id)->sum('amount');
        $userPayment = UserPaymentRequest::where("users_id", $this->id)->Pending()->get()->sum("amount_remove");
        return $wallet - $userPayment;
    }

    public function balanceRoiTotal()
    {
        $wallet = UserBalanceRoi::where('users_id', $this->id)->sum('amount');
        $userPayment = UserPaymentRequest::where("users_id", $this->id)->Pending()->get()->sum("amount_remove");
        return $wallet - $userPayment;
    }

    public function balance()
    {
        return UserBalance::where('users_id', Auth::id())->get();
    }

    public function referreds()
    {
        return User::where('sponsor_id', $this->id)->get();
    }

    public function membership()
    {
        return $this->hasOne('App\Models\UserMembership', 'users_id', 'id')
            ->join('memberships', 'memberships.id', 'user_memberships.memberships_id')
            ->where('memberships.type', 'membership')
            ->select('user_memberships.*');
    }

    public function membershipActive()
    {
        return $this->hasOne('App\Models\UserMembership', 'users_id', 'id')
            ->where('status', 'A')
            ->join('memberships', 'memberships.id', 'user_memberships.memberships_id')
            ->where('memberships.type', 'membership')
            ->select('user_memberships.*');
    }

    public function referralsTotal()
    {
        $multilevel = new Multilevel($this);
        return $multilevel->total();
    }

    public function activeReferralsTotal()
    {
        $multilevel = new Multilevel($this);
        return $multilevel->total("actives");
    }

    public function expiredReferralsTotal()
    {
        $multilevel = new Multilevel($this);
        return $multilevel->total("expired");
    }

    public function totalWithdrawn()
    {
        return abs(UserBalance::where('amount', "<", 0)->where("users_id", Auth::id())->get()->sum("amount"));
    }

    public function userMembership()
    {
        return $this->hasOne('App\Models\UserMembership', 'users_id', 'id');

    }

    public function investment()
    {
        if ($this->membership) {
            $total = $this->membership->price + $this->reinvestment();
        } else {
            $total = 0;
        }

        return $total;
    }

    public function reinvestment()
    {
        $membership = $this->membership()->orderByDesc('id')->first();
        $reinvestment = $this->hasMany('App\Models\MembershipReinvestment', 'users_id', 'id');
        if ($membership)
            $reinvestment = $reinvestment->where('membership_id', $membership->memberships_id);

        $reinvestment = $reinvestment->get()->sum('amount');

        return $reinvestment;
    }

    public function nextMembership()
    {
        $membershipUser = $this->membership;
        if ($membershipUser) {
            $totalReinvestment = $this->investment();
            if ($totalReinvestment) {
                $membership = Membership::orderBy('amount', 'asc')->where('amount', '>', $totalReinvestment)->first();
                $membership->totalReinvesment = $totalReinvestment;
            }
            return isset($membership) ? $membership : null;
        } else {
            return null;
        }
    }

    public function upgradeMembership()
    {
        $totalReinvestment = $this->investment();

        if ($totalReinvestment) {
            $membership = Membership::orderBy('amount', 'desc')->where('amount', '<=', $totalReinvestment)->first();
            $membership->totalReinvesment = $totalReinvestment;
        }

        return isset($membership) ? $membership : null;

    }

    public function userMultilevel()
    {
        return $this->hasOne('App\Models\UserMultilevel', 'users_id', 'id');

    }

    public function hasValidKyc()
    {
        $kycTypes = KycType::all();
        $kycDocuments = KycDocument::where('users_id', $this->id)->where('status', "1")->get();

        if (count($kycTypes) <= count($kycDocuments)) {
            return true;
        }

        return false;
    }

    public function rank()
    {
        return $this->hasOne('App\Models\Rank', 'id', 'ranks_id');
    }

    public function bonusRetained()
    {
        $addBonusRetained = new UserPublicController;
        return $addBonusRetained->addBonusRetained($this->id);
    }

    public function userContacInformacion()
    {
        return $this->hasOne('App\Models\UserContactInformation', 'users_id', 'id');
    }

    /**
     * Ingresos totales
     */
    public function totalRevenue()
    {
        return $this->balanceRoi->sum('amount') + $this->bonus->sum('amount');
    }

    public function balanceRoi()
    {
        return $this->hasMany('App\Models\UserBalanceRoi', 'id', 'users_id');
    }

    public function bonus()
    {
        return $this->hasMany('App\Models\UserBalance', 'id', 'users_id')->whereIn('type', config('bonus'));
    }

    public function hasSuscription()
    {
        return $this->hasMany('App\Models\UserMembership', 'users_id', 'id')
            ->join('memberships', 'memberships.id', 'user_memberships.memberships_id')
            ->where('memberships.type', 'subscription')
            ->select('user_memberships.*');

    }

    public function scopeAddUserBalances($query)
    {
        return $query->join('user_balances','user_balances.users_id','users.id');

    }

    public function scopeAddUserBalancesById($query)
    {
        return $query->join('user_balances','user_balances.users_id','users.id')->where('users.id', Auth::id());
    }


    public function scopeAddSponsorBalances($query)
    {
        return $query->join('user_balances','user_balances.users_id','users.sponsor_id');

    }
}
