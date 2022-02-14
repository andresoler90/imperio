<?php

namespace App\Models;

use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\UserBonusRetained
 *
 * @property int $id
 * @property int $users_id Usuario
 * @property int $user_balances_id Balance
 * @property float $total monto retenido + monto balance
 * @property float $amount monto retenido
 * @property float $percentage_balance Porcentaje del monto en el balance de usuario
 * @property float $percentage_retained Porcentaje del monto retenido
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\UserBalance|null $UserBalance
 * @property-read \App\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserBonusRetained newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserBonusRetained newQuery()
 * @method static \Illuminate\Database\Query\Builder|UserBonusRetained onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|UserBonusRetained query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserBonusRetained whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserBonusRetained whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserBonusRetained whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserBonusRetained whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserBonusRetained wherePercentageBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserBonusRetained wherePercentageRetained($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserBonusRetained whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserBonusRetained whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserBonusRetained whereUserBalancesId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserBonusRetained whereUsersId($value)
 * @method static \Illuminate\Database\Query\Builder|UserBonusRetained withTrashed()
 * @method static \Illuminate\Database\Query\Builder|UserBonusRetained withoutTrashed()
 * @mixin \Eloquent
 */
class UserBonusRetained extends Model
{
    use SoftDeletes, Loggable;

    protected $fillable = [
        "users_id",
        "user_balances_id",
        "total",
        "amount",
        "percentage_balance",
        "percentage_retained"
    ];

    public function UserBalance()
    {
        return $this->hasOne('App\Models\UserBalance', 'id', 'user_balances_id');

    }
    public function user()
    {
        return $this->hasOne('App\User', 'id', 'users_id');

    }

    public function dateDelivery()
    {
        $timeForDelivery = \App\Models\System::where('parameter','time_months_delivery')->first()->value;
        $dateCreated = new \Carbon\Carbon($this->created_at);
        // se agregan meses configurados a la fecha de creacion de retencion
        $dateForDelivery = $dateCreated->addMonths($timeForDelivery);
        return $dateForDelivery;

    }
    public function statusDelivery()
    {
        // Si el registro esta eliminado es porque se entrego el bono
        if ($this->deleted_at){
            $status = "<span class='badge badge-success'>Entregado</span>";
        }else{
            $status = "<span class='badge badge-warning'>Pendiente</span>";
        }
        return $status;

    }

}
