<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserMembership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Config;
use App\User;


class SponserController extends Controller
{
    public function index()
    {
        $sponserTop= User::all();
        foreach ($sponserTop as $val) {
            $user_sponser[] =  $val->sponsor_id; //.'|'.$val->id;
        }
        $valores = array_count_values($user_sponser);
        $sponserTopnew = User::whereIn('id',$user_sponser)->get();
        return view('cruds.SponserTop.index', compact('sponserTopnew','valores'));
    }

    public function detail($id)
    {
        $sponserToplist= User::where('sponsor_id',$id)->get();
        return view('cruds.SponserTop.detail', compact('sponserToplist'));
    }

}
