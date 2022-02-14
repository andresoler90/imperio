<?php

namespace App\Models;

use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\BonusRoi
 *
 * @property int $id
 * @property mixed $detail
 * @property int $created_users_id Usuario que ejecuto el bono
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|BonusRoi newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BonusRoi newQuery()
 * @method static \Illuminate\Database\Query\Builder|BonusRoi onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|BonusRoi query()
 * @method static \Illuminate\Database\Eloquent\Builder|BonusRoi whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BonusRoi whereCreatedUsersId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BonusRoi whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BonusRoi whereDetail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BonusRoi whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BonusRoi whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|BonusRoi withTrashed()
 * @method static \Illuminate\Database\Query\Builder|BonusRoi withoutTrashed()
 * @mixin \Eloquent
 */
class BonusRoi extends Model
{
    use SoftDeletes, Loggable;
    protected $table='bonus_roi';
}
