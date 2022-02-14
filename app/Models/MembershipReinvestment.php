<?php

namespace App\Models;

use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\MembershipReinvestment
 *
 * @property int $id
 * @property int $membership_id
 * @property int $users_id
 * @property float $amount
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Membership|null $membership
 * @method static \Illuminate\Database\Eloquent\Builder|MembershipReinvestment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MembershipReinvestment newQuery()
 * @method static \Illuminate\Database\Query\Builder|MembershipReinvestment onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|MembershipReinvestment query()
 * @method static \Illuminate\Database\Eloquent\Builder|MembershipReinvestment whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MembershipReinvestment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MembershipReinvestment whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MembershipReinvestment whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MembershipReinvestment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MembershipReinvestment whereMembershipId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MembershipReinvestment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MembershipReinvestment whereUsersId($value)
 * @method static \Illuminate\Database\Query\Builder|MembershipReinvestment withTrashed()
 * @method static \Illuminate\Database\Query\Builder|MembershipReinvestment withoutTrashed()
 * @mixin \Eloquent
 */
class MembershipReinvestment extends Model
{
    use SoftDeletes, Loggable;

    protected $fillable = [
        'membership_id',
        'users_id',
        'amount',
        'description',
    ];
    protected static $logAttributes = [
        'membership_id',
        'users_id',
        'amount',
        'description',
    ];

    public function membership()
    {

        return $this->hasOne('App\Models\Membership','id','membership_id');

    }


}
