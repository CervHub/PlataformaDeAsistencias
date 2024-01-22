<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Http\Controllers\Repository\UserModelController; // Importa el controlador

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $controller = new UserModelController(); // Crea una instancia del controlador

        // Datos para el SuperAdministrador
        $superAdminData = [
            'name' => 'Super Admin',
            'email' => 'superadmin@cerv.com',
            'doi' => '12345678',
            'birthdate' => null,
            'role' => 'SuperAdministrador',
            'company' => 'CERV',
            'lastname' => 'Test Lastname',
            'url_photo' => null,
            'id_schedule' => null,
        ];

        // Usa el método createUser del controlador para crear el SuperAdministrador
        $controller->createUser($superAdminData);

        // Datos para el Administrador
        $adminData = [
            'name' => 'Admin',
            'email' => 'admin@cerv.com',
            'doi' => '87654321',
            'birthdate' => null,
            'role' => 'Administrador',
            'company' => 'CERV',
            'lastname' => 'Test Lastname',
            'url_photo' => null,
            'id_schedule' => null,
        ];

        // Usa el método createUser del controlador para crear el Administrador
        $controller->createUser($adminData);
    }
}
