<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerificarClienteAuth
{
    public function handle(Request $request, Closure $next)
    {
        if (!session('cliente_token')) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para continuar.');
        }

        return $next($request);
    }
}