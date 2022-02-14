<?php

namespace App\Http\Middleware;

use Closure;
use PragmaRX\Google2FA\Google2FA;

class Verification2FAGoogle
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     * @TODO SOLO PARA RUTAS CON METHOD = POST
     */
    public function handle($request, Closure $next)
    {

        if (Session('requestTemp') != null)
            session()->forget('requestTemp');

        //Se guarda nombre de ruta para continuar proceso post
        $request['route'] = \Route::currentRouteName();

        // Se almacena request en session para posterior consumo
        session()->push("requestTemp", $request->all());

        if (!\Auth::user()->token_login) {
            \Alert::warning('', __('Esta acción requiere metodo de autenticación 2FA activa.'));
            return redirect()->back();
        } elseif (isset($request->code_verification) && $request->code_verification != null) {
            if ((new Google2FA())->verifyKey(\Auth::user()->token_login, $request->code_verification)) {
                return $next($request);
            }else{
                \Alert::warning('', __('Clave dinamica errada'));
                return redirect()->route('authenticator.view');
            }
        } else {
            return redirect()->route('authenticator.view');
        }

    }
}
