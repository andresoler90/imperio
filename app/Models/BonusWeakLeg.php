<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\BonusWeakLeg
 *
 * @property int $id
 * @property int $users_id
 * @property float $pf
 * @property float $pd
 * @property float $difference
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|BonusWeakLeg newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BonusWeakLeg newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BonusWeakLeg query()
 * @method static \Illuminate\Database\Eloquent\Builder|BonusWeakLeg whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BonusWeakLeg whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BonusWeakLeg whereDifference($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BonusWeakLeg whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BonusWeakLeg wherePd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BonusWeakLeg wherePf($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BonusWeakLeg whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BonusWeakLeg whereUsersId($value)
 * @mixin \Eloquent
 */
class BonusWeakLeg extends Model
{
    //
}
