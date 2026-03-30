<?php

namespace App\Http\Middleware; // Verifica que diga exactamente esto

use Closure;
use Illuminate\Http\Request;

class VerifyTwoFactorCode // El nombre debe coincidir con el del archivo
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        // Si el usuario está logueado pero el código no ha sido verificado
        if (auth()->check() && $user->two_factor_code) {
            return redirect()->route('verify.index');
        }

        return $next($request);
    }
}
