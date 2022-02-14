<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

/**
 * App\Models\UserBalance
 *
 * @property int $id
 * @property int $users_id Id del usuario al que se le cargo el registro
 * @property float $amount Monto abonado
 * @property string $type Tipo de registro
 * @property int|null $created_user Id del usuario que creo el registro
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\User|null $createdUser
 * @property-read \App\Models\UserTransfer|null $transfer
 * @property-read \App\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserBalance newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserBalance newQuery()
 * @method static \Illuminate\Database\Query\Builder|UserBalance onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|UserBalance query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserBalance whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserBalance whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserBalance whereCreatedUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserBalance whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserBalance whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserBalance whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserBalance whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserBalance whereUsersId($value)
 * @method static \Illuminate\Database\Query\Builder|UserBalance withTrashed()
 * @method static \Illuminate\Database\Query\Builder|UserBalance withoutTrashed()
 * @mixin \Eloquent
 */
class UserBalance extends Model
{
    use SoftDeletes, Loggable;

    public function createdUser()
    {
        return $this->hasOne('App\User', 'id', 'created_user');
    }

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'users_id');
    }

    public function transfer()
    {
        return $this->hasOne('App\Models\UserTransfer', 'from_balance_id', 'id');
    }

    public function scopeAddUser($query)
    {
        return $query->join('users', 'users.id', '=', 'user_balances.users_id');
    }

    public function scopeFilterByUser($query, $user)
    {

        if ($user)
            return $query->where('name', 'like', '%' . $user . '%');
    }

    public function ScopeFilterByDates($query, $dateIn, $dateEnd)
    {
        if ($dateIn != null && $dateEnd != null)
            return $query->whereBetween('user_balances.created_at', [$dateIn.' 00:00:00', $dateEnd.' 23:59:59']);

        if ($dateIn)
            return $query->where('user_balances.created_at', '>=', $dateIn.' 00:00:00');

        if ($dateEnd)
            return $query->where('user_balances.created_at', '<=', $dateEnd.' 23:59:59');
    }

    public function scopeFilterByType($query, $type)
    {
        if ($type)
            return $query->where('type', $type);
    }

    public function scopeCommissionsPaidByReferred($query)
    {
        return $query->where('type','quick_start')->get()->sum('amount');

    }
    public function scopeCommissionsPaidToReferred($query)
    {
        return $query->where('type','quick_start')->get()->sum('amount');

    }

}
