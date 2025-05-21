<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Ensure2FAIsVerified
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        // Si el usuario no ha pasado 2FA, redirige a la validación
        if (!$request->session()->get('2fa_passed')) {
            return redirect('/2fa/enable');
        }

        return $next($request);
    }
}
