<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('Auth.login');
    }
    public function login(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
            'tipo_login' => 'required|in:empresa,personal',
        ]);

        // Intentar autenticar al usuario
        $credentials = $request->only('email', 'password');

        // Verificar el tipo de inicio de sesión
        if ($request->tipo_login == 'personal') {
            // Lógica para inicio de sesión de empresa
            if (Auth::attempt($credentials)) {
                // Autenticación exitosa
                $user = Auth::user();

                // Verificar el rol del usuario
                switch ($user->id_role) {
                    case 1: // SuperAdministrador
                        return redirect()->route('superadmin.dashboard');
                    case 2: // Administrador
                        return redirect()->route('administrador.dashboard');
                    case 3: // Personal
                        return redirect()->route('personal.dashboard');
                    case 4: // Empleado
                        return redirect()->route('empleado.dashboard');
                    default:
                        return redirect()->route('dashboard');
                }
            }
        } else {
            // Lógica para inicio de sesión personal
            if (Auth::attempt($credentials)) {
                // Autenticación exitosa
                $user = Auth::user();
                dd('Inicio de sesión personal');
                return redirect()->intended('dashboard');
            }
        }

        // Autenticación fallida, redirige de nuevo al formulario de login
        return back()->withErrors([
            'email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ]);
    }
    public function logout()
    {
        Auth::logout();

        return redirect('login');
    }
}
