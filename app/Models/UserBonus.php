<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

/**
 * App\Models\UserBonus
 *
 * @property int $id
 * @property int $users_id Usuario
 * @property int $user_memberships_id Membresia
 * @property int $bonus_id Bono
 * @property float $percentage Porcentaje sobre el cual se ejecuta el bono
 * @property int $created_user Usuario que realizo el registro
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Bonus|null $bonus
 * @method static \Illuminate\Database\Eloquent\Builder|UserBonus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserBonus newQuery()
 * @method static \Illuminate\Database\Query\Builder|UserBonus onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|UserBonus query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserBonus whereBonusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserBonus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserBonus whereCreatedUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserBonus whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserBonus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserBonus wherePercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserBonus whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserBonus whereUserMembershipsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserBonus whereUsersId($value)
 * @method static \Illuminate\Database\Query\Builder|UserBonus withTrashed()
 * @method static \Illuminate\Database\Query\Builder|UserBonus withoutTrashed()
 * @mixin \Eloquent
 */
class UserBonus extends Model
{
    use SoftDeletes, Loggable;

    protected $table = "user_bonus";

    protected $fillable = [
        "users_id",
        "user_memberships_id",
        "bonus_id",
        "percentage",
        "created_user",
    ];

    public function bonus()
    {
        return $this->hasOne('App\Models\Bonus', 'id', 'bonus_id');

    }
}
