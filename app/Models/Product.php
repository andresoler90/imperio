<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

/**
 * App\Models\Product
 *
 * @property int $id
 * @property string $name
 * @property string|null $description Descripcion del paquete
 * @property int $commission Comision por clicks realizados
 * @property int $commission_referred Comision por referidos a la plataforma
 * @property string|null $image Imagen asociada al paquete
 * @property int $expiration_days Dias por el cual se encuentra habilitado el paquete
 * @property int $clicks Cantidad de cliks habilitados
 * @property int $price Precio
 * @property string|null $pair_price
 * @property int $created_user
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Query\Builder|Product onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereClicks($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCommission($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCommissionReferred($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereExpirationDays($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product wherePairPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Product withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Product withoutTrashed()
 * @mixin \Eloquent
 */
class Product extends Model
{
    use SoftDeletes, Loggable;

    protected $fillable = [
        "name",
        "description",
        "commission",
        "commission_referred",
        "image",
        "expiration_days",
        "clicks",
        "price",
        "pair_price",
    ];

    protected static $logAttributes = [
        "name",
        "description",
        "commission",
        "commission_referred",
        "image",
        "expiration_days",
        "clicks",
        "price",
        "pair_price",
    ];

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->created_user=\Auth::id();
        });
    }
}
