<?php

namespace App\Http\Middleware;

use App\RoleUser;
use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class UserAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $usuario_actula = RoleUser::where('user_id', Auth::id())->first()->role_id;
        if ($usuario_actula == 1) {
            return $next($request);
        }
        return response('No tienes los permisos necesarios para ingresar',404);

    }
}
