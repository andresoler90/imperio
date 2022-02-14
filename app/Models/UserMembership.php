<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

/**
 * App\Models\UserMembership
 *
 * @property int $id
 * @property int $memberships_id Id de la membresia
 * @property int $users_id id del usuario
 * @property float $price Monto que pago el usuario al momento de adquirir la membresia
 * @property string $expiration_date Fecha en el que vence el producto para el usuario
 * @property string $status Estatus de la membresia P: Pendiente / R: Rechazado / A: Aprobado / V: Vencido
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserBonus[] $UserBonus
 * @property-read int|null $user_bonus_count
 * @property-read mixed $status_name
 * @property-read \App\Models\Membership|null $membership
 * @property-read \App\User|null $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MembershipVerifications[] $verifications
 * @property-read int|null $verifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|UserMembership newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserMembership newQuery()
 * @method static \Illuminate\Database\Query\Builder|UserMembership onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|UserMembership query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserMembership whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMembership whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMembership whereExpirationDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMembership whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMembership whereMembershipsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMembership wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMembership whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMembership whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMembership whereUsersId($value)
 * @method static \Illuminate\Database\Query\Builder|UserMembership withTrashed()
 * @method static \Illuminate\Database\Query\Builder|UserMembership withoutTrashed()
 * @mixin \Eloquent
 */
class UserMembership extends Model
{
    use SoftDeletes, Loggable;

    protected $fillable = [
        "memberships_id",
        "users_id",
        "price",
        "amount_additional",
        "status",
    ];

    protected static $logAttributes = [
        "memberships_id",
        "users_id",
        "price",
        "status",

    ];

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'users_id');
    }

    public function membership()
    {
        return $this->hasOne('App\Models\Membership', 'id', 'memberships_id');
    }

    public function UserBonus()
    {
        return $this->hasMany('App\Models\UserBonus', 'user_memberships_id', 'id');
    }

    public function getStatusNameAttribute()
    {
        switch ($this->status) {
            case "A":
                return "Activo";
                break;
            case "V":
                return "Vencido";
                break;
            case "P":
                return "Pendiente";
                break;
            default:
                return "";
        }
    }

    public function verifications()
    {
        return $this->hasMany('App\Models\MembershipVerifications', 'user_memberships_id', 'id');
    }

    public function hasPendingVerification()
    {
        //Membership Verification
        $mv = MembershipVerifications::where('user_memberships_id', $this->id)
            ->where('status', 'P')
            ->get();
        return $mv;
    }

    public function hasApprovedVerification()
    {
        //Membership Verification
        $mv = MembershipVerifications::where('user_memberships_id', $this->id)
            ->where('status', 'A')
            ->first();

        if (!$mv) {
            //Si no consigue registro en la tabla de solicitudes verificamos si tiene algun pago por coinbase aprobado

            $pc = PaymentCoinbase::where('user_memberships_id', $this->id)
                ->where('status', 'V')
                ->first();

            if ($pc) {
                return $pc;
            } else {
                return null;
            }

        }
        return $mv;
    }

    public function hasrejectedVerification()
    {
        //Membership Verification
        $mv = MembershipVerifications::where('user_memberships_id', $this->id)
            ->where('status', 'R')
            ->first();

        if (!$mv) {
            //Si no consigue registro en la tabla de solicitudes verificamos si tiene algun pago por coinbase aprobado

            $pc = PaymentCoinbase::where('user_memberships_id', $this->id)
                ->where('status', 'C')
                ->first();

            if ($pc) {
                return $pc;
            } else {
                return null;
            }

        }
        return $mv;
    }
}


