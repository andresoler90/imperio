<?php

namespace App\Models;

use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\TicketPriority
 *
 * @property int $id
 * @property string $priority_name nombre de la prioridad
 * @property int $active estado de la prioridad 0:inactivo 1:activo
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|TicketPriority newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TicketPriority newQuery()
 * @method static \Illuminate\Database\Query\Builder|TicketPriority onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|TicketPriority query()
 * @method static \Illuminate\Database\Eloquent\Builder|TicketPriority whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketPriority whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketPriority whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketPriority whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketPriority wherePriorityName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketPriority whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|TicketPriority withTrashed()
 * @method static \Illuminate\Database\Query\Builder|TicketPriority withoutTrashed()
 * @mixin \Eloquent
 */
class TicketPriority extends Model
{
    use SoftDeletes, Loggable;

    protected $fillable = [
        'priority_name',
        'active'
    ];

    protected static $logAttributes = [
        'priority_name',
        'active'
    ];
}
