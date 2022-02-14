<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

/**
 * App\Models\Menu
 *
 * @property int $id
 * @property string|null $name texto que se muestra
 * @property string|null $url Dirección al que debe apuntar el link
 * @property string|null $route Ruta a la que debe apuntar el link
 * @property string|null $icon Clase del fontawesome que se muestra junto al link
 * @property string|null $class Clase css que se debe aplicar al campo
 * @property string|null $menus_id Menu padre
 * @property int $roles_id Id del role que puede ver la opcion
 * @property int $created_user Id del usuario que creo el registro
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Role|null $role
 * @method static \Illuminate\Database\Eloquent\Builder|Menu newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Menu newQuery()
 * @method static \Illuminate\Database\Query\Builder|Menu onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Menu query()
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereClass($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereCreatedUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereMenusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereRolesId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereRoute($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereUrl($value)
 * @method static \Illuminate\Database\Query\Builder|Menu withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Menu withoutTrashed()
 * @mixin \Eloquent
 */
class Menu extends Model
{
    use SoftDeletes, Loggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'url',
        'route',
        'icon',
        'class',
        'menus_id',
        'roles_id',
        'created_user',
    ];


    protected static function boot()
    {
        parent::boot();
        static::saving(function ($model) {
            $model->created_user = Auth::id();
        });
    }

    public function hasChild()
    {
        $childs = Menu::where('menus_id', $this->id)->get();
        return $childs;
    }

    public function role()
    {
        return $this->hasOne('App\Models\Role', 'id', 'roles_id');
    }
}
