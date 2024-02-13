<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Http\Controllers\Repository\RolModel;

class RolesTableSeeder extends Seeder
{
    protected $roleModel;

    public function __construct(RolModel $roleModel)
    {
        $this->roleModel = $roleModel;
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'Root',
                'description' => 'Persona con poder total en el sistema',
            ],
            [
                'name' => 'Gerente',
                'description' => 'Encargado de la gestión general de la empresa',
            ],
            [
                'name' => 'Administrador',
                'description' => 'Responsable de la administración y configuración del sistema',
            ],
            [
                'name' => 'Empleado',
                'description' => 'Usuario estándar dentro de la empresa',
            ]
        ];

        foreach ($roles as $role) {
            list($success, $result) = $this->roleModel->create($role);

            if ($success) {
                error_log('Role created: ' . $result->id);
            } else {
                error_log('Error creating role: ' . $result->getMessage());
            }
        }
    }
}
