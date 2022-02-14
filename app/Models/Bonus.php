<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

/**
 * App\Models\Bonus
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property float $percentage Porcentaje que se le asociara al bono el usuario
 * @property int|null $required Indica si es un bono que debe ser aplicado a todas las membresias
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|Bonus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Bonus newQuery()
 * @method static \Illuminate\Database\Query\Builder|Bonus onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Bonus query()
 * @method static \Illuminate\Database\Eloquent\Builder|Bonus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bonus whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bonus whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bonus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bonus whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bonus wherePercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bonus whereRequired($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bonus whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Bonus withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Bonus withoutTrashed()
 * @mixin \Eloquent
 */
class Bonus extends Model
{
    use SoftDeletes, Loggable;

    protected $table = "bonus";

    protected $fillable = [
        "name",
        'description',
        "percentage",
        "required",
    ];
}
