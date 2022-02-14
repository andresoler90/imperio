<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profile(){
        return view('user.profile');
    }

    public function profileEdit(){
        return view('user.profile_edit');
    }

    public function addUser(){
        return view('user.add_user');
    }

    public function userList(){
        return view('user.user_list');
    }
}
