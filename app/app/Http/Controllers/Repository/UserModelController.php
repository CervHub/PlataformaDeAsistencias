<?php

namespace App\Http\Controllers\Repository;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Company;
use App\Models\Role;
use App\Models\Employee;

class UserModelController extends Controller
{
    function Code($id, $string)
    {
        $formattedId = str_pad($id, 3, '0', STR_PAD_LEFT);
        return $formattedId . '-' . $string;
    }

    public function createUser(array $data)
    {
        try {
            // Validación del email y el doi
            $existingUser = User::where('email', $data['email'])->orWhere('doi', $data['doi'])->first();

            $roleId = Role::where('name', $data['role'])->firstOrFail()->id;
            $companyId = Company::where('name', $data['company'])->firstOrFail()->id;

            info('Role ID: ' . $roleId); // Imprime la ID del rol
            info('Company ID: ' . $companyId); // Imprime la ID de la compañía

            if ($existingUser) {
                $existingEmployee = Employee::where('code', $this->Code($companyId, $data['doi']))->first();
                if ($existingEmployee) {
                    // Si el usuario y el empleado existen, retorna false y un mensaje de error
                    return ['success' => false, 'message' => 'User and Employee already exist'];
                } else {
                    // Si el usuario existe pero el empleado no, crea el empleado y retorna true y el empleado
                    $employee = Employee::create(
                        [
                            'code' => $this->Code($companyId, $data['doi']),
                            'name' => $data['name'],
                            'lastname' => $data['lastname'],
                            'url_photo' => $data['url_photo'],
                            'id_company' => $companyId,
                            'id_schedule' => $data['id_schedule'],
                            'id_user' => $existingUser->id,
                            'id_role' => $roleId,
                        ]
                    );
                    return ['success' => true, 'employee' => $employee];
                }
            }

            // Creación del usuario
            $user = User::create([
                'email' => $data['email'],
                'doi' => $data['doi'],
                'password' => bcrypt($data['doi']),
                'birthdate' => $data['birthdate'],
                'id_role' => $roleId,
            ]);

            // Creación del empleado
            $employee = Employee::create(
                [
                    'code' => $this->Code($companyId, $data['doi']),
                    'name' => $data['name'],
                    'lastname' => $data['lastname'],
                    'url_photo' => $data['url_photo'],
                    'id_company' => $companyId,
                    'id_schedule' => $data['id_schedule'],
                    'id_user' => $user->id,
                    'id_role' => $roleId,
                ]
            );

            // Retorna true y el empleado creado
            return ['success' => true, 'employee' => $employee];
        } catch (\Exception $e) {
            // Si ocurre un error, imprime el mensaje de error en el log
            info('Error: ' . $e->getMessage());
            // Retorna false y el mensaje de error
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}
