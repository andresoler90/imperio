<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

/**
 * App\Models\UserComunication
 *
 * @property int $id
 * @property string $subject Asunto del email
 * @property string $message Mensaje del email
 * @property int $from_users_id Id del usuario que envia el email
 * @property int $to_users_id Id del usuario al que se le envia el email
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\User|null $fromUser
 * @property-read \App\User|null $toUser
 * @method static \Illuminate\Database\Eloquent\Builder|UserComunication newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserComunication newQuery()
 * @method static \Illuminate\Database\Query\Builder|UserComunication onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|UserComunication query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserComunication whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserComunication whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserComunication whereFromUsersId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserComunication whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserComunication whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserComunication whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserComunication whereToUsersId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserComunication whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|UserComunication withTrashed()
 * @method static \Illuminate\Database\Query\Builder|UserComunication withoutTrashed()
 * @mixin \Eloquent
 */
class UserComunication extends Model
{
    use SoftDeletes, Loggable;

    protected $fillable = [
        'subject',
        'message',
        'from_users_id',
        'to_users_id',
    ];

    protected static $logAttributes = [
        'subject',
        'message',
        'from_users_id',
        'to_users_id',
    ];

    public function fromUser()
    {
        return $this->hasOne('App\User', 'id', 'from_users_id');
    }

    public function toUser()
    {
        return $this->hasOne('App\User', 'id', 'to_users_id');
    }
}
