<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

/**
 * App\Models\Membership
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $amount
 * @property string $amount_type Tipo de moneda en la que se genera la membresia
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read mixed $select_text
 * @method static \Illuminate\Database\Eloquent\Builder|Membership newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Membership newQuery()
 * @method static \Illuminate\Database\Query\Builder|Membership onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Membership query()
 * @method static \Illuminate\Database\Eloquent\Builder|Membership whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Membership whereAmountType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Membership whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Membership whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Membership whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Membership whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Membership whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Membership whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Membership withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Membership withoutTrashed()
 * @mixin \Eloquent
 * @property float $cap Indica el maximo margen de ganancia que pudiese tener esta membresia
 * @property string|null $image Imagen de referencia para la membresia
 * @property string $type Indica que tipo de membresia es
 * @method static \Illuminate\Database\Eloquent\Builder|Membership whereCap($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Membership whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Membership whereType($value)
 */
class Membership extends Model
{
    use SoftDeletes, Loggable;

    protected $fillable = [
        "name",
        "description",
        "amount",
        "amount_type",
        "cap",
        "image",
        "type",
    ];

    public function getSelectTextAttribute()
    {
        return " $" . number_format($this->amount) . " - " . $this->name;
    }
}
