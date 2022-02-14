<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Support\Facades\Auth;

/**
 * App\Models\UserProduct
 *
 * @property int $id
 * @property int $users_id Id del usuario
 * @property int $products_id Id del producto
 * @property int $created_user
 * @property string $expiration_date Fecha en el que vence el producto para el usuario
 * @property int $price Monto por el que pago el usuario al momento de la compra
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Product|null $product
 * @method static \Illuminate\Database\Eloquent\Builder|UserProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserProduct newQuery()
 * @method static \Illuminate\Database\Query\Builder|UserProduct onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|UserProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProduct whereCreatedUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProduct whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProduct whereExpirationDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProduct wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProduct whereProductsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProduct whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProduct whereUsersId($value)
 * @method static \Illuminate\Database\Query\Builder|UserProduct withTrashed()
 * @method static \Illuminate\Database\Query\Builder|UserProduct withoutTrashed()
 * @mixin \Eloquent
 */
class UserProduct extends Model
{
    use SoftDeletes, Loggable;

    protected $fillable = [
        'users_id',
        'products_id',
        'created_user'
    ];

    protected static $logAttributes = [
        'users_id',
        'products_id',
        'created_user'
    ];

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            if (Auth::check()) {
                $model->created_user = \Auth::id();
            }
        });
    }

    public function product()
    {
        return $this->hasOne('App\Models\Product', 'id', 'products_id');
    }
}
