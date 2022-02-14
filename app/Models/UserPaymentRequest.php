<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

/**
 * App\Models\UserPaymentRequest
 *
 * @property int $id
 * @property int $users_id
 * @property float $amount_remove
 * @property int $type 0 => BITCOIN / 1 => ETHER
 * @property string $address_wallet
 * @property int $status 0 => Pendiente / 1 => Pagado / 2 => Rechazado
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserPaymentRequest approve()
 * @method static \Illuminate\Database\Eloquent\Builder|UserPaymentRequest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserPaymentRequest newQuery()
 * @method static \Illuminate\Database\Query\Builder|UserPaymentRequest onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|UserPaymentRequest pending()
 * @method static \Illuminate\Database\Eloquent\Builder|UserPaymentRequest query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserPaymentRequest refuse()
 * @method static \Illuminate\Database\Eloquent\Builder|UserPaymentRequest whereAddressWallet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPaymentRequest whereAmountRemove($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPaymentRequest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPaymentRequest whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPaymentRequest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPaymentRequest whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPaymentRequest whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPaymentRequest whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPaymentRequest whereUsersId($value)
 * @method static \Illuminate\Database\Query\Builder|UserPaymentRequest withTrashed()
 * @method static \Illuminate\Database\Query\Builder|UserPaymentRequest withoutTrashed()
 * @mixin \Eloquent
 * @property float|null $remove_commission Comision por retiro
 * @method static \Illuminate\Database\Eloquent\Builder|UserPaymentRequest whereRemoveCommission($value)
 */
class UserPaymentRequest extends Model
{

    use SoftDeletes, Loggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'users_id',
        'amount_remove',
        'type',
        'remove_commission',
        'address_wallet',
        'status',
    ];

    protected static $logAttributes = [
        'users_id',
        'amount_remove',
        'type',
        'remove_commission',
        'address_wallet',
        'status',
    ];

    public function scopePending($query)
    {
        return $query->where('status', 0);
    }

    public function scopeApprove($query)
    {
        return $query->where('status', 1);
    }

    public function scopeRefuse($query)
    {
        return $query->where('status', 2);
    }

    public function user()
    {
        return $this->hasOne('App\User','id','users_id');
    }

    public function balanceTotalById($id)
    {
        return UserBalance::where('users_id', $id)->sum('amount');
    }

}
