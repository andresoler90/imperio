<?php

namespace App\Http\Middleware;

use Closure;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $roles)
    {

        $newRol = explode('|',$roles);

        //$roleId = $request->user()->role->id;
        $roleName = $request->user()->role->name;

        if (!in_array($roleName,$newRol))
            return abort(403,__('Unauthorized'));

        return $next($request);
    }
}
