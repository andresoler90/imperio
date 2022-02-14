<?php

namespace App\Models;

use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Ticket
 *
 * @property int $id
 * @property string $code codigo unico del ticket
 * @property int $users_id
 * @property int $category_id
 * @property int $priority_id
 * @property string $message Descripcion del ticket
 * @property string $subject Asunto del ticket
 * @property string $file_path Archivo adjunto del ticket
 * @property int $status_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\TicketCategory|null $category
 * @property-read \App\Models\TicketPriority|null $priority
 * @property-read \App\Models\TicketStatus|null $status
 * @property-read \App\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket approve()
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket newQuery()
 * @method static \Illuminate\Database\Query\Builder|Ticket onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket pending()
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket query()
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket refuse()
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereFilePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket wherePriorityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereUsersId($value)
 * @method static \Illuminate\Database\Query\Builder|Ticket withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Ticket withoutTrashed()
 * @mixin \Eloquent
 */
class Ticket extends Model
{
    use SoftDeletes, Loggable;

    protected $fillable = [
        'code',
        'users_id',
        'category_id',
        'priority_id',
        'message',
        'subject',
        'file_path',
        'status_id'
    ];

    protected static $logAttributes = [
        'code',
        'users_id',
        'category_id',
        'priority_id',
        'message',
        'subject',
        'file_path',
        'status_id'
    ];

    public function scopePending($query)
    {
        return $query->where('status', 0);
    }

    public function scopeApprove($query)
    {
        return $query->where('status', 1);
    }

    public function scopeRefuse($query)
    {
        return $query->where('status', 2);
    }

    public function status()
    {
        return $this->hasOne('App\Models\TicketStatus', 'id', 'status_id');
    }

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'users_id');
    }

    public function priority()
    {
        return $this->hasOne('App\Models\TicketPriority', 'id', 'priority_id');
    }

    public function category()
    {
        return $this->hasOne('App\Models\TicketCategory', 'id', 'category_id');
    }
}
