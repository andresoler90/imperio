<?php

namespace App\Models;

use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\News
 *
 * @property int $id
 * @property int $users_id Usuario creador
 * @property int $languages_id
 * @property string $title
 * @property string $body
 * @property string|null $iframe
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Languages|null $languages
 * @property-read \App\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|News newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|News newQuery()
 * @method static \Illuminate\Database\Query\Builder|News onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|News query()
 * @method static \Illuminate\Database\Eloquent\Builder|News whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereIframe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereLanguagesId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereUsersId($value)
 * @method static \Illuminate\Database\Query\Builder|News withTrashed()
 * @method static \Illuminate\Database\Query\Builder|News withoutTrashed()
 * @mixin \Eloquent
 */
class News extends Model
{
    use SoftDeletes, Loggable;

    protected $fillable = [
        'users_id',
        'title',
        'body',
        'iframe',
        'languages_id',
    ];
    protected static $logAttributes = [
        'users_id',
        'title',
        'body',
        'iframe',
        'languages_id',
    ];

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'users_id');
    }

    public function languages()
    {
        return $this->hasOne('App\Models\Languages', 'id', 'languages_id');
    }
}
