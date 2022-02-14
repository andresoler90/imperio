<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserMultilevel
 *
 * @property int $id
 * @property int $users_id Usuario
 * @property int $parent_users_id Padre dentro del multinivel
 * @property string $position Posicion dentro del nivel D: Derecha / I: Izquierda
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read mixed $position_label
 * @property-read \Illuminate\Database\Eloquent\Collection|UserMultilevel[] $hasChilds
 * @property-read int|null $has_childs_count
 * @property-read \App\Models\UserMembership|null $membership
 * @property-read \App\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserMultilevel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserMultilevel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserMultilevel query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserMultilevel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMultilevel whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMultilevel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMultilevel whereParentUsersId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMultilevel wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMultilevel whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMultilevel whereUsersId($value)
 * @mixin \Eloquent
 * @property-read UserMultilevel|null $parent
 */
class UserMultilevel extends Model
{
    //
    public function hasChilds()
    {
        return $this->hasMany('App\Models\UserMultilevel', 'parent_users_id', 'users_id');

    }

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'users_id');
    }

    public function getPositionLabelAttribute()
    {
        switch ($this->position) {
            case "D":
                return "Derecha";
                break;

            case "I":
                return "Izquierda";
        }
    }

    public function membership()
    {
        return $this->hasOne('App\Models\UserMembership', 'users_id', 'users_id');
    }

    public function parent()
    {
        return $this->hasOne('App\Models\UserMultilevel', 'users_id', 'parent_users_id');
    }
}
