<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User;
use PragmaRX\Google2FA\Google2FA;
use Illuminate\Support\Facades\Auth;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Writer as BaconQrCodeWriter;
use BaconQrCode\Renderer\Image\ImagickImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {

        $this->validateLogin($request);

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }
        $credentials = $request->only($this->username(), 'password');

        if (Auth::validate($credentials)) {

            $user = User::where($this->username(), '=', $request->username)->first();
            //Verificamos si este usuario posee activo la a2fa
            if ($user->token_login) {
                return view("Authentication.auth-2fa", compact('user'));
            } else {
                $request->session()->regenerate();
                Auth::login($user);
                return redirect()->intended($this->redirectPath());
            }
        }


        $this->incrementLoginAttempts($request);
        Alert::warning(__('Credenciales inválidas'), __('El usuario y/o contraseña ingresados son inválidos'));
        return $this->sendFailedLoginResponse($request);
    }

    public function createUserUrlQR($user)
    {
        $bacon = new BaconQrCodeWriter(new ImageRenderer(
            new RendererStyle(200),
            new ImagickImageBackEnd()
        ));

        $data = $bacon->writeString(
            (new Google2FA)->getQRCodeUrl(
                config('app.name'),
                $user->email,
                $user->token_login
            ), 'utf-8');

        return 'data:image/png;base64,' . base64_encode($data);
    }

    public function googleLogin(Request $request, User $user)
    {
        $request->validate(['code_verification' => 'required']);

        if ((new Google2FA())->verifyKey($user->token_login, $request->code_verification)) {
            $request->session()->regenerate();

            Auth::login($user);

            return redirect()->intended($this->redirectPath());
        } else {
            Alert::warning('', __('Clave dinamica errada'));
            //$this->incrementLoginAttempts($request);

            return redirect()->back();
        }
    }


    public function username()
    {
        return 'username';
    }


}
