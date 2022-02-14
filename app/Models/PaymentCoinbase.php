<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

/**
 * App\Models\PaymentCoinbase
 *
 * @property int $id
 * @property int $users_id
 * @property int $user_memberships_id
 * @property string $serial
 * @property string $transaction_id
 * @property string $amount
 * @property string|null $identification_document documento de identidad
 * @property string|null $cellphone Numero telefonico
 * @property string $status P =>Pendiente / V => Verificado / C => cancelado
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\User|null $user
 * @property-read \App\Models\UserMembership|null $userMembership
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentCoinbase newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentCoinbase newQuery()
 * @method static \Illuminate\Database\Query\Builder|PaymentCoinbase onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentCoinbase query()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentCoinbase whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentCoinbase whereCellphone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentCoinbase whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentCoinbase whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentCoinbase whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentCoinbase whereIdentificationDocument($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentCoinbase whereSerial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentCoinbase whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentCoinbase whereTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentCoinbase whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentCoinbase whereUserMembershipsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentCoinbase whereUsersId($value)
 * @method static \Illuminate\Database\Query\Builder|PaymentCoinbase withTrashed()
 * @method static \Illuminate\Database\Query\Builder|PaymentCoinbase withoutTrashed()
 * @mixin \Eloquent
 */
class PaymentCoinbase extends Model
{
    use  SoftDeletes, Loggable;

    protected $table = 'payment_coinbase';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'users_id', 'user_memberships_id', 'serial','transaction_id','amount','status'
    ];
    public $sortable = ['id'];

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'users_id');
    }

    public function userMembership()
    {
        return $this->hasOne('App\Models\UserMembership', 'id', 'user_memberships_id')
        ->with('membership');
    }

    public function membership()
    {
        return $this->hasOne('App\Models\Membership', 'id', 'memberships_id');
    }

    public function scopeAddUser($query)
    {
        return $query->join('users', 'users.id', '=', 'payment_coinbase.users_id');
    }

    public function scopeFilterByUser($query, $user)
    {
        if ($user)
            return $query->where('name', 'like', '%' . $user . '%');
    }

    public function ScopeFilterByDates($query, $dateIn, $dateEnd)
    {
        if ($dateIn != null && $dateEnd != null)
            return $query->whereBetween('payment_coinbase.created_at', [$dateIn, $dateEnd]);

        if ($dateIn)
            return $query->where('payment_coinbase.created_at', '>=', $dateIn);

        if ($dateEnd)
            return $query->where('payment_coinbase.created_at', '<=', $dateEnd);
    }

    public function scopeDateRangeForMonthAndStatus($query,$status = null)
    {
        $firstDayPreviousMonth = Carbon::now()->startOfMonth();
        $lastDayPreviousMonth = Carbon::now()->endOfMonth();

        $query->whereBetween('created_at',[$firstDayPreviousMonth,$lastDayPreviousMonth]);

        if ($status == 'V')
            $query->where('status',$status);
        if ($status == 'C')
            $query->where('status',$status);

        return $query;

    }

    public function scopeFactureForMonthOrTotal($query, $type)
    {
        $firstDayPreviousMonth = Carbon::now()->startOfMonth();
        $lastDayPreviousMonth = Carbon::now()->endOfMonth();

        $query->where('status', 'V');

        if ($type == 'Month')
            return $query->whereBetween('created_at', [$firstDayPreviousMonth, $lastDayPreviousMonth]);
        elseif ($type == 'Total')
            return $query;
    }

}

