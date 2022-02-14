<?php

namespace App\Models;

use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\MembershipPoolUpgrades
 *
 * @property int $id
 * @property int $users_id Usuario solicitante
 * @property int $memberships_id Membresia
 * @property string $status P: Pendiente / A: Activo / R: Rechazado
 * @property int|null $confirm_user Usuario que aprueba upgrade
 * @property string $support_document nombre del documento
 * @property string|null $identification_document Documento de identidad
 * @property string|null $cellphone Telefono
 * @property string|null $type Tipo
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read mixed $status_badge
 * @property-read mixed $status_name
 * @property-read \App\Models\Membership|null $membership
 * @method static \Illuminate\Database\Eloquent\Builder|MembershipPoolUpgrades newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MembershipPoolUpgrades newQuery()
 * @method static \Illuminate\Database\Query\Builder|MembershipPoolUpgrades onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|MembershipPoolUpgrades query()
 * @method static \Illuminate\Database\Eloquent\Builder|MembershipPoolUpgrades whereCellphone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MembershipPoolUpgrades whereConfirmUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MembershipPoolUpgrades whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MembershipPoolUpgrades whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MembershipPoolUpgrades whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MembershipPoolUpgrades whereIdentificationDocument($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MembershipPoolUpgrades whereMembershipsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MembershipPoolUpgrades whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MembershipPoolUpgrades whereSupportDocument($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MembershipPoolUpgrades whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MembershipPoolUpgrades whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MembershipPoolUpgrades whereUsersId($value)
 * @method static \Illuminate\Database\Query\Builder|MembershipPoolUpgrades withTrashed()
 * @method static \Illuminate\Database\Query\Builder|MembershipPoolUpgrades withoutTrashed()
 * @mixin \Eloquent
 * @property-read \App\User|null $confirmUser
 * @property-read \App\User|null $user
 */
class MembershipPoolUpgrades extends Model
{
    use SoftDeletes, Loggable;

    protected $fillable = [
        "users_id",
        "memberships_id",
        "status",
        "confirm_user",
        "support_document",
        'identification_document',
        'cellphone',
        'type'
    ];

    public function membership()
    {
        return $this->hasOne('App\Models\Membership', 'id', 'memberships_id');
    }
    public function user()
    {
        return $this->hasOne('App\User','id','users_id');
    }
    public function confirmUser()
    {
        return $this->hasOne('App\User','id','confirm_user');
    }

    public function getStatusNameAttribute()
    {
        $name = "";
        switch ($this->status) {
            case 'P':
                $name = __('Pendiente');
                break;

            case 'A':
                $name = __('Aprobado');
                break;

            case 'R':
                $name = __('Rechazado');
                break;
        }

        return $name;
    }

    public function getStatusBadgeAttribute()
    {
        $html = "";
        switch ($this->status) {
            case 'P':

                $html = "<span class='badge badge-warning'>" . __('Pendiente') . "</span>";
                break;

            case 'A':
                $html = "<span class='badge badge-success'>" . __('Aprobado') . "</span>";
                break;

            case 'R':
                $html = "<span class='badge badge-dark'>" . __('Rechazado') . "</span>";
                break;
        }

        return $html;
    }

}
