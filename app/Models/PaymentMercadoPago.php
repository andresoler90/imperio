<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class PaymentMercadoPago extends Model
{
    use  SoftDeletes, Loggable;

    protected $table = 'payment_mercadopago';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'users_id', 'user_memberships_id', 'name','email','serial','external_reference','amount','identification_document','cellphone','status'
    ];
    public $sortable = ['id'];

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'users_id');
    }

    public function userMembership()
    {
        return $this->hasOne('App\Models\UserMembership', 'id', 'user_memberships_id')
            ->with('membership');
    }

}
