<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Employee;
use App\Models\Company;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('Auth.login');
    }

    public function login(Request $request)
    {
        $route = $this->authenticate($request->tipo_login, $request->email, $request->password);

        if ($route === 'login') {
            // Autenticación fallida, agregar un mensaje de error a la sesión
            session()->flash('error', 'La autenticación falló. Por favor, verifica tus credenciales e intenta de nuevo.');
        }

        return redirect()->route($route);
    }

    private function authenticate($tipo_login, $email, $password)
    {
        if ($tipo_login === 'empresa') {
            $employee = Employee::where('code', 'LIKE', "%-{$email}")->first();
            if ($employee) {
                $user = $employee->user;
                $rol = $employee->role;
                $company_id = $employee->id_company;

                if (Auth::attempt(['email' => $user->email, 'password' => $password])) {
                    // Autenticación exitosa

                    // Guardar el rol y la compañía en la sesión
                    session(['rol_id' => $rol->id, 'company_id' => $company_id, 'employee_id' => $employee->id]);

                    // Redirigir a 'gerencia.show'
                    return 'gerencia.show';
                } else {
                    // Autenticación fallida, agregar un mensaje de error a la sesión
                    session()->flash('error', 'La autenticación falló. Por favor, verifica tus credenciales e intenta de nuevo.');

                    // Redirigir a 'login'
                    return 'login';
                }
            }
        }
        if ($tipo_login === 'personal') {
            // Aquí deberías implementar la lógica de autenticación para 'personal'
            // y devolver el nombre de la ruta a la que quieres redirigir al usuario.
        }

        // Autenticación fallida, redirigir a 'login'
        return 'login';
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }
}
