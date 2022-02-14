<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Membership;
use App\Models\Product;
use App\Models\UserBalance;
use App\Models\UserMembership;
use App\Models\UserProduct;
use App\Providers\RouteServiceProvider;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'         => ['required', 'string', 'max:255'],
            'lastname'     => ['required', 'string', 'max:255'],
            'email'        => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'     => ['required', 'string', 'min:6', 'confirmed'],
            'username'     => ['required', 'string', 'min:4', 'unique:users'],
            'countries_id' => ['required'],
            'sponsor'      => ['required', 'exists:users,username'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $sponsor = User::where('username', $data['sponsor'])->first();
        $user = User::create([
            'name'         => $data['name'],
            'lastname'     => $data['lastname'],
            'email'        => $data['email'],
            'password'     => Hash::make($data['password']),
            'username'     => $data['username'],
            'countries_id' => $data['countries_id'],
            'roles_id'     => 2,
            'sponsor_id'   => $sponsor->id,
        ]);

//        if ($user) {
//            $membership = Membership::find($data["memberships_id"]);
//            $userMembership = new UserMembership();
//            $userMembership->users_id = $user->id;
//            $userMembership->memberships_id = $membership->id;
//            $userMembership->price = $membership->amount;
//            $userMembership->save();
//        }

        return $user;
    }

    protected function registered(Request $request, $user)
    {
        //
    }
}
