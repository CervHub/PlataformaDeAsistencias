<?php

namespace App\Imports;

use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\Employee;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Collection;
use App\Http\Controllers\Repository\EmployeeModel;

class EmployeeImport implements ToCollection, WithHeadingRow
{
    protected $employeeModel;

    public function __construct(EmployeeModel $employeeModel)
    {
        $this->employeeModel = $employeeModel;
    }

    public function collection(Collection $rows)
    {
        $results = [];

        foreach ($rows as $row) {
            $id_company = Session::get('company_id');
            $data = [
                'name' => $row['nombres'],
                'lastname' => $row['apellidos'],
                'doi' => strval($row['documento_de_identidad']),
                'status' => 'active',
                'id_company' => $id_company,
                'birthdate' => \DateTime::createFromFormat('j/n/Y', $row['fecha_de_nacimiento'])->format('Y-m-d'),
                'role' => 'Empleado',
                'position' => $row['cargo'],
                'email' => $row['correo'],
                'id_schedule' => isset($row['id_jornada']) && is_numeric($row['id_jornada']) ? (int) $row['id_jornada'] : null,
            ];

            $result = $this->employeeModel->create($data);
        }
    }
}
