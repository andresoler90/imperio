<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

/**
 * App\Models\MembershipPaymentStatus
 *
 * @property-read \App\Models\UserMembership|null $userMembership
 * @method static \Illuminate\Database\Eloquent\Builder|MembershipPaymentStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MembershipPaymentStatus newQuery()
 * @method static \Illuminate\Database\Query\Builder|MembershipPaymentStatus onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|MembershipPaymentStatus query()
 * @method static \Illuminate\Database\Query\Builder|MembershipPaymentStatus withTrashed()
 * @method static \Illuminate\Database\Query\Builder|MembershipPaymentStatus withoutTrashed()
 * @mixin \Eloquent
 */
class MembershipPaymentStatus extends Model
{
    use SoftDeletes, Loggable;

    protected $fillable = [
        "id_user_membership",
        "id_transaction",
        "status",
        "status_description",
        "type_coin",
        "payment_received"
    ];

    protected static $logAttributes = [
        "id_user_membership",
        "id_transaction",
        "status",
        "status_description",
        "type_coin",
        "payment_received"
    ];

    public function userMembership()
    {
        return $this->hasOne('App\Models\userMembership', 'id', 'id_user_membership');
    }
}
