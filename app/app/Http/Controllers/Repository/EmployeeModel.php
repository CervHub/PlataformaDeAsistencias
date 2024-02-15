<?php

namespace App\Http\Controllers\Repository;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Employee;
use App\Models\User;
use App\Models\Role;

class EmployeeModel extends Controller
{
    function formatCode($companyId, $rucNumber)
    {
        $formattedCompanyId = str_pad($companyId, 4, '0', STR_PAD_LEFT);
        return $formattedCompanyId . '-' . $rucNumber;
    }

    public function create($data)
    {
        DB::beginTransaction();

        try {
            $name = $data['name'];
            $lastname = $data['lastname'];
            $doi = $data['doi'];
            $status = 'active';
            $id_company = $data['id_company'];
            $birthdate = $data['birthdate'];
            $role = $data['role'];
            $code = $this->formatCode($id_company, $doi);
            $position = $data['position'];
            $email = $data['email'];

            $new_employee = Employee::where('code', $code)->first();

            if ($new_employee) {
                return [false, 'El empleado ya existe'];
            } else {
                // Primero validamos que no exista el usuario
                $new_user = User::where('doi', $data['doi'])->first();
                if (!$new_user) {
                    $new_user = User::create([
                        'doi' => $doi,
                        'email' => $doi . '@' . $doi . '.com',
                        'password' => bcrypt($doi),
                        'birthdate' => $birthdate,
                        'status' => $status
                    ]);
                }
                $new_employee = Employee::create([
                    'code' => $this->formatCode($id_company, $doi),
                    'name' => $name,
                    'lastname' => $lastname,
                    'url_photo' => null,
                    'id_company' => $id_company,
                    'email' => $email,
                    'id_schedule' => null,
                    'id_user' => $new_user->id,
                    'id_role' => Role::where('name', $role)->first()->id,
                    'status' => $status,
                    'position' => $position
                ]);

                DB::commit();

                return [true, 'Employee created'];
            }
        } catch (\Exception $e) {
            DB::rollback();

            error_log('Error creating company: ' . $e->getMessage());
            return [false, $e->getMessage()];
        }
    }
}
