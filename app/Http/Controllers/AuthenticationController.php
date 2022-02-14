<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PragmaRX\Google2FA\Google2FA;

class AuthenticationController extends Controller
{
    function login(){
        return view('Authentication.login');
    }
    function registration(){
        return view('Authentication.registration');

    }
    function recoverPassword(){
        return view('Authentication.recover-password');

    }
    function confirmEmail(){
        return view('Authentication.confirm-email');

    }
    function lockScreen(){
        return view('Authentication.lock-screen');

    }
    public function authenticatorView()
    {
        return view('Authentication.public-auth-2fa');
    }
    function newPassword(Request $request, $id){

        if (! $request->hasValidSignature()) {
            abort(403);
        }
        return view('Authentication.new_password')->with('id', $id);

    }

}
