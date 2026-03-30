<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Mail\TwoFactorCodeMail;

class LoginController extends Controller
{
    /**
     * Muestra el formulario de login.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Procesa el primer paso del login y genera el código 2FA.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Generar código de 6 dígitos
            $user->two_factor_code = rand(100000, 999999);
            $user->two_factor_expires_at = now()->addMinutes(15);
            $user->save();

            // Enviar el código por correo
            try {
                Mail::to($user->email)->send(new TwoFactorCodeMail($user->two_factor_code));
            } catch (\Exception $e) {
                // Si el correo falla (error SMTP), esto evitará que la app se rompa totalmente
                return back()->withErrors(['emails' => 'Error al enviar el correo. Revisa tu configuración SMTP.']);
            }

            return redirect()->route('verify.index');
        }

        return back()->withErrors(['emails' => 'Las credenciales no coinciden con nuestros registros.']);
    }

    /**
     * Muestra el formulario para ingresar el código de 6 dígitos.
     */
    public function showVerifyForm()
    {
        return view('auth.verify');
    }

    /**
     * Verifica el código 2FA y otorga acceso al panel.
     */
    public function verifyCode(Request $request)
    {
        $request->validate([
            'two_factor_code' => 'required|integer',
        ]);

        $user = Auth::user();

        // Verificamos si el código coincide y no ha expirado
        if ($request->two_factor_code == $user->two_factor_code && now()->lt($user->two_factor_expires_at)) {

            // Activamos la sesión que el Middleware TwoFactorVerify requiere
            session(['two_factor_verified' => true]);

            // Limpiamos el código para que no se use dos veces
            $user->two_factor_code = null;
            $user->two_factor_expires_at = null;
            $user->save();

            return redirect()->to('/admon');
        }

        return back()->withErrors(['two_factor_code' => 'El código es incorrecto o ha expirado.']);
    }

    /**
     * Cierra la sesión de forma segura y limpia el 2FA.
     */
    public function logout(Request $request)
    {
        // 1. Cierra la sesión en el sistema de Auth
        Auth::logout();

        // 2. Borra específicamente la marca de 2FA
        $request->session()->forget('two_factor_verified');

        // 3. Invalida y regenera la sesión para seguridad
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // 4. Redirige al login limpio
        return redirect('/login');
    }
}
