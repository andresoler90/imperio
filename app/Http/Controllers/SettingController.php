<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function accountSetting(){
        return view('setting.account');
    }

    public function privacySetting(){
        return view('setting.privacy');
    }

    public function privacyPolicy(){
        return view('setting.privacy_policy');
    }

    public function termsService(){
        return view('setting.terms_of_service');
    }

}
