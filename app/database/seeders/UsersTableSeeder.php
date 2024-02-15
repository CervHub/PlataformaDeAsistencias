<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Http\Controllers\Repository\UserModel; // Importa el controlador
use App\Models\User;
use App\Models\Employee;
use App\Models\Company;
use App\Models\Role;

class UsersTableSeeder extends Seeder
{

    function formatCode($companyId, $rucNumber)
    {
        $formattedCompanyId = str_pad($companyId, 4, '0', STR_PAD_LEFT);
        return $formattedCompanyId . '-' . $rucNumber;
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
            $user = User::create([
                'email' => 'admin@admin.com',
                'doi' => '123456789',
                'password' => bcrypt('admin'),
                'status' => 'active',
                'birthdate' => null
            ]);
            $code = $this->formatCode(Company::first()->id, '123456789');
            $employee = Employee::create([
                'email' => 'admin@admin.com',
                'id_user' => $user->id,
                'id_company' => Company::first()->id,
                'id_role' => Role::where('name', 'Root')->first()->id,
                'name' => 'Root',
                'lastname' => 'Admin',
                'data' => null,
                'status' => 'active',
                'url_photo' => null,
                'code' => $code
            ]);
            error_log('User created: ' . $user->id);
        } catch (\Throwable $th) {
            //throw $th;
            error_log('Error creating user: ' . $th->getMessage());
        }
    }
}
