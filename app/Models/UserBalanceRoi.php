<?php

namespace App\Models;

use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserBalanceRoi extends Model
{
    protected $table="user_balance_roi";

    use SoftDeletes, Loggable;

    public function createdUser()
    {
        return $this->hasOne('App\User', 'id', 'created_user');
    }

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'users_id');
    }
}
