<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserMembership;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index()
    {

        $usermemberships = UserMembership::join('memberships', 'memberships.id', 'user_memberships.memberships_id')
            ->where('memberships.type', 'subscription')
            ->select('user_memberships.*')->get();

        return view('cruds.subscription.index', compact('usermemberships'));
    }
}
