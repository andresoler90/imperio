<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

/**
 * App\Models\System
 *
 * @property int $id
 * @property string $parameter es el nombre de la variable que se utilizara
 * @property string $value es el valor de el parametro
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|System newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|System newQuery()
 * @method static \Illuminate\Database\Query\Builder|System onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|System query()
 * @method static \Illuminate\Database\Eloquent\Builder|System whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|System whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|System whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|System whereParameter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|System whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|System whereValue($value)
 * @method static \Illuminate\Database\Query\Builder|System withTrashed()
 * @method static \Illuminate\Database\Query\Builder|System withoutTrashed()
 * @mixin \Eloquent
 * @property string|null $comment Comentarios
 * @method static \Illuminate\Database\Eloquent\Builder|System whereComment($value)
 */
class System extends Model
{
    use SoftDeletes, Loggable;

    protected $fillable = [
        'parameter',
        'value'
    ];

    protected static $logAttributes = [
        'parameter',
        'value'
    ];
}
