<?php

namespace App\Http\Controllers\Repository;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\User;
use App\Models\Employee;
use App\Models\Role;
use Illuminate\Support\Facades\DB;

class CompanyModel extends Controller
{

    function formatCode($companyId, $rucNumber)
    {
        $formattedCompanyId = str_pad($companyId, 4, '0', STR_PAD_LEFT);
        return $formattedCompanyId . '-' . $rucNumber;
    }

    public function create($data)
    {
        return DB::transaction(function () use ($data) {
            try {
                $name = $data['name'];
                $description = $data['description'];
                $ruc = $data['ruc'];
                $password = $data['ruc'];
                $status = 'active';

                $new_company = Company::create([
                    'name' => $name,
                    'description' => $description,
                    'ruc' => $ruc,
                    'password' => $password,
                    'status' => $status
                ]);

                // Crear Usuario
                $new_user = User::create([
                    'email' => $ruc . '@' . $ruc . '.com',
                    'doi' => $ruc,
                    'password' => $password,
                    'status' => $status,
                    'birthdate' => null
                ]);

                // Crear Empleado
                $new_employee = Employee::create([
                    'id_user' => $new_user->id,
                    'id_company' => $new_company->id,
                    'id_role' => Role::where('name', 'Gerente')->first()->id,
                    'name' => $name,
                    'lastname' => $name,
                    'data' => null,
                    'status' => $status,
                    'url_photo' => null,
                    'code' => $this->formatCode($new_company->id, $ruc)
                ]);

                error_log('Company created: ' . $new_company->id);

                return [true, $new_company];
            } catch (\Exception $e) {
                error_log('Error creating company: ' . $e->getMessage());
                return [false, $e];
            }
        });
    }
}
