<?php

// Ubicación del archivo: gameapp/app/Http/Controllers/Auth/LoginController.php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // Validar los datos del formulario de login
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
            'remember' => 'nullable|boolean',
        ]);

        // Obtener las credenciales de la solicitud
        $credentials = $request->only('email', 'password');

        // Intentar autenticar al usuario con la opción de recordar
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            // Redirigir al dashboard si la autenticación es exitosa
            return redirect()->intended('dashboard');
        }

        // Redirigir de vuelta con un mensaje de error si la autenticación falla
        return redirect()->back()->withErrors([
            'email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ])->withInput($request->except('password'));
    }

    // Método para manejar el logout
    public function logout(Request $request)
    {
        // Cierra la sesión del usuario
        Auth::logout();

        // Invalida la sesión actual
        $request->session()->invalidate();

        // Regenera el token de la sesión para prevenir ataques CSRF
        $request->session()->regenerateToken();

        // Borra cualquier otro almacenamiento en la sesión
        $request->session()->flush();

        // Redirige a la página de inicio o a cualquier otra página después del logout
        return redirect('/');
    }
}
