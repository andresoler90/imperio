<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

/**
 * App\Models\KycDocument
 *
 * @property int $id
 * @property int $users_id Id del usuario que es dueño del documento
 * @property int $kyc_types_id Tipo de documento que sube el usuario
 * @property int|null $approved_id Id del usuario administrador que aprueba o rechaza el documento
 * @property string|null $comment Comentarios asociados al documento
 * @property string $file Nombre del documento dentro del sistema
 * @property string $status Estado de la subida del documento 0=esperando, 1=aprobacion, 2=cancelado
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\User|null $approved
 * @property-read mixed $status_name
 * @property-read \App\Models\KycType|null $kyc_type
 * @property-read \App\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|KycDocument newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KycDocument newQuery()
 * @method static \Illuminate\Database\Query\Builder|KycDocument onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|KycDocument query()
 * @method static \Illuminate\Database\Eloquent\Builder|KycDocument whereApprovedId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KycDocument whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KycDocument whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KycDocument whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KycDocument whereFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KycDocument whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KycDocument whereKycTypesId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KycDocument whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KycDocument whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KycDocument whereUsersId($value)
 * @method static \Illuminate\Database\Query\Builder|KycDocument withTrashed()
 * @method static \Illuminate\Database\Query\Builder|KycDocument withoutTrashed()
 * @mixin \Eloquent
 */
class KycDocument extends Model
{
    use SoftDeletes, Loggable;

    protected $fillable = [
        'users_id',
        'kyc_types_id',
        'approved_id',
        'comment',
        'file',
        'status'
    ];

    protected static $logAttributes = [
        'users_id',
        'kyc_types_id',
        'approved_id',
        'comment',
        'file',
        'status'
    ];

    public function kyc_type()
    {
        return $this->hasOne('App\Models\KycType', 'id', 'kyc_types_id');
    }

    public function user()
    {
        return $this->hasOne('App\User','id','users_id');
    }

    public function approved()
    {
        return $this->hasOne('App\User','id','approved_id');
    }

    public function getStatusNameAttribute()
    {
        switch ($this->status){
            case 0:
                return 'Pendiente';
                break;
            case 1:
                return 'Aprobado';
                break;
            case 2:
                return 'Rechazado';
                break;
        }
    }

}
