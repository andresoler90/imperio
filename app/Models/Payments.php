<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

/**
 * App\Models\Payments
 *
 * @property int $id
 * @property int $users_id
 * @property int $user_payment_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|Payments newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payments newQuery()
 * @method static \Illuminate\Database\Query\Builder|Payments onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Payments query()
 * @method static \Illuminate\Database\Eloquent\Builder|Payments whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payments whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payments whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payments whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payments whereUserPaymentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payments whereUsersId($value)
 * @method static \Illuminate\Database\Query\Builder|Payments withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Payments withoutTrashed()
 * @mixin \Eloquent
 */
class Payments extends Model
{
    use SoftDeletes, Loggable;

//    protected $table = 'user_contactinformation';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'users_id',
        'user_payment_id'
    ];

    protected static $logAttributes = [
        'users_id',
        'user_payment_id'
    ];
}
