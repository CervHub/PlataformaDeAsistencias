<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Http\Controllers\Repository\UserModel; // Importa el controlador

class UsersTableSeeder extends Seeder
{
    protected $userModel;

    public function __construct(UserModel $userModel)
    {
        $this->userModel = $userModel;
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Datos para el SuperAdministrador
        $superAdminData = [
            'name' => 'Super Admin',
            'email' => 'superadmin@cerv.com',
            'doi' => '12345678',
            'birthdate' => null,
            'id_role' => '1',
            'id_company' => 2,
            'lastname' => 'Test Lastname',
            'url_photo' => null,
            'id_schedule' => null,
        ];

         // Datos para el SuperAdministrador
        //  $superAdminData = [
        //     'name' => 'Elfer',
        //     'email' => 'elfer.arenas@cerv.com',
        //     'doi' => '87654321',
        //     'birthdate' => null,
        //     'id_role' => '3',
        //     'id_company' => 1,
        //     'lastname' => 'Arenas',
        //     'url_photo' => null,
        //     'id_schedule' => null,
        // ];

        // Datos para el SuperAdministrador
        // $superAdminData = [
        //     'name' => 'Kassandra',
        //     'email' => 'kassandra.reynoso@cerv.com',
        //     'doi' => '123456789',
        //     'birthdate' => null,
        //     'id_role' => '3',
        //     'id_company' => 2,
        //     'lastname' => 'Reynoso',
        //     'url_photo' => null,
        //     'id_schedule' => null,
        // ];
        // Usa el método createUser del controlador para crear el SuperAdministrador
        $this->userModel->create($superAdminData);
    }
}
