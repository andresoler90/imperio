<?php

namespace App\Models;

use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\TicketStatus
 *
 * @property int $id
 * @property string $status_name nombre del status del ticket
 * @property int $active estado de los estados 0:inactivo 1:activo
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|TicketStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TicketStatus newQuery()
 * @method static \Illuminate\Database\Query\Builder|TicketStatus onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|TicketStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder|TicketStatus whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketStatus whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketStatus whereStatusName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketStatus whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|TicketStatus withTrashed()
 * @method static \Illuminate\Database\Query\Builder|TicketStatus withoutTrashed()
 * @mixin \Eloquent
 */
class TicketStatus extends Model
{
    use SoftDeletes, Loggable;

    protected $fillable = [
        'status_name',
        'active'
    ];

    protected static $logAttributes = [
        'status_name',
        'active'
    ];
}
