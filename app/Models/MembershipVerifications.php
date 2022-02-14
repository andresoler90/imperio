<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

/**
 * App\Models\MembershipVerifications
 *
 * @property int $id
 * @property string $support_document nombre del documento
 * @property int $user_memberships_id Datos de la membresia
 * @property string|null $comment
 * @property int|null $refuse_user
 * @property int|null $confirm_user
 * @property string $status P: Pendiente / A: Activo / R: Rechazado
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read mixed $status_badge
 * @property-read mixed $status_name
 * @property-read \App\Models\UserMembership|null $userMembership
 * @method static \Illuminate\Database\Eloquent\Builder|MembershipVerifications newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MembershipVerifications newQuery()
 * @method static \Illuminate\Database\Query\Builder|MembershipVerifications onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|MembershipVerifications query()
 * @method static \Illuminate\Database\Eloquent\Builder|MembershipVerifications whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MembershipVerifications whereConfirmUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MembershipVerifications whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MembershipVerifications whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MembershipVerifications whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MembershipVerifications whereRefuseUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MembershipVerifications whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MembershipVerifications whereSupportDocument($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MembershipVerifications whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MembershipVerifications whereUserMembershipsId($value)
 * @method static \Illuminate\Database\Query\Builder|MembershipVerifications withTrashed()
 * @method static \Illuminate\Database\Query\Builder|MembershipVerifications withoutTrashed()
 * @mixin \Eloquent
 * @property int|null $account_holder Titular de la cuenta
 * @method static \Illuminate\Database\Eloquent\Builder|MembershipVerifications whereAccountHolder($value)
 */
class MembershipVerifications extends Model
{

    use SoftDeletes, Loggable;

    protected $fillable = [
        "support_document",
        "user_memberships_id",
        "refuse_coment",
        "refuse_user",
        "approved_user",
        "status",
    ];

    public function userMembership()
    {
        return $this->hasOne('App\Models\UserMembership', 'id', 'user_memberships_id');
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
