<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Membership;
use App\Models\PaymentCoinbase;
use App\Models\UserMembership;
use App\Models\System;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class ShoppingHistoryController extends Controller
{
    public function index()
    {
        $historialCompras = UserMembership::all();
        return view('reports.shopping.index', compact('historialCompras'));
    }

    public function Usershopping()
    {
        //$historialCompras = UserMembership::where('users_id',  Auth::id())->get();
        $historialCompras = PaymentCoinbase::where('users_id', Auth::id())->get();
        $system = System::where('parameter', 'registration_value')->first();
        //dd($historialCompras);
        return view('reports.shopping.userShopping', compact('historialCompras','system'));
    }

    public function create()
    {

    }

    public function store(Request $request)
    {

    }

    public function edit()
    {


    }

    public function update(Request $request)
    {

    }

    public function destroy()
    {

    }
}
