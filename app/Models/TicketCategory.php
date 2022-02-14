<?php

namespace App\Models;

use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\TicketCategory
 *
 * @property int $id
 * @property string $category_name nombre de la categoria
 * @property string $category_prefix nombre del prefijo de la categoria
 * @property int $active estado de la categoria 0:inactivo 1:activo
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|TicketCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TicketCategory newQuery()
 * @method static \Illuminate\Database\Query\Builder|TicketCategory onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|TicketCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|TicketCategory whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketCategory whereCategoryName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketCategory whereCategoryPrefix($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketCategory whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketCategory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|TicketCategory withTrashed()
 * @method static \Illuminate\Database\Query\Builder|TicketCategory withoutTrashed()
 * @mixin \Eloquent
 */
class TicketCategory extends Model
{
    use SoftDeletes, Loggable;

    protected $fillable = [
        'category_name',
        'category_prefix',
        'active'
    ];

    protected static $logAttributes = [
        'category_name',
        'category_prefix',
        'active'
    ];
}
