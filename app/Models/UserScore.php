<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserScore
 *
 * @property int $id
 * @property float $amount Cantidad de puntos
 * @property string $side Lado del binario D: Derecha / I: Izquierda
 * @property int $users_id Usuario
 * @property int|null $created_user Id del usuario que creo el registro
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|UserScore newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserScore newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserScore query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserScore whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserScore whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserScore whereCreatedUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserScore whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserScore whereSide($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserScore whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserScore whereUsersId($value)
 * @mixin \Eloquent
 */
class UserScore extends Model
{
    //
}
