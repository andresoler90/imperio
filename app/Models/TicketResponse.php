<?php

namespace App\Models;

use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\TicketResponse
 *
 * @property int $id
 * @property int $ticket_id
 * @property int $users_id
 * @property string $comment Comentario del ticket
 * @property string $file Archivo adjunto de la respuesta del ticket
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Ticket|null $ticket
 * @property-read \App\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|TicketResponse newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TicketResponse newQuery()
 * @method static \Illuminate\Database\Query\Builder|TicketResponse onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|TicketResponse query()
 * @method static \Illuminate\Database\Eloquent\Builder|TicketResponse whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketResponse whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketResponse whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketResponse whereFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketResponse whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketResponse whereTicketId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketResponse whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketResponse whereUsersId($value)
 * @method static \Illuminate\Database\Query\Builder|TicketResponse withTrashed()
 * @method static \Illuminate\Database\Query\Builder|TicketResponse withoutTrashed()
 * @mixin \Eloquent
 */
class TicketResponse extends Model
{
    use SoftDeletes, Loggable;

    protected $fillable = [
        'ticket_id',
        'users_id',
        'comment',
        'file'
    ];

    protected static $logAttributes = [
        'ticket_id',
        'users_id',
        'comment',
        'file'
    ];

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'users_id');
    }

    public function ticket()
    {
        return $this->hasOne('App\Models\Ticket', 'id', 'ticket_id');
    }
}
