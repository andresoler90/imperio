<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class UserRoiRequest extends Model
{
    use SoftDeletes, Loggable;
    protected $table = 'user_roi_request';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'users_id',
        'amount_remove',
        'type',
        'remove_commission',
        'address_wallet',
        'status',
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

    public function user()
    {
        return $this->hasOne('App\User','id','users_id');
    }

    public function balanceTotalById($id)
    {
        return UserBalanceRoi::where('users_id', $id)->sum('amount');
    }
}
