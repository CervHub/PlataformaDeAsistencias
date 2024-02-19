<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Repository\EmployeeModel;
use App\Models\Employee;

class EmployeeController extends Controller
{
    private $employeeModel;
    public function __construct(EmployeeModel $employeeModel)
    {
        $this->employeeModel = $employeeModel;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(['message' => 'Hola'], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $message = $this->employeeModel->create($request->all());
        return response()->json(['message' => $message], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $employee = Employee::find($id);

        if ($employee) {
            // Genera los datos que quieres retornar
            $data = [
                'id' => $employee->id,
                'documento_identidad' => $employee->user->doi,
                'nombres' => $employee->name,
                'apellidos' => $employee->lastname,
                'posicion' => $employee->position,
            ];

            return response()->json($data);
        }

        return response()->json(['error' => 'Empleado no encontrado'], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
