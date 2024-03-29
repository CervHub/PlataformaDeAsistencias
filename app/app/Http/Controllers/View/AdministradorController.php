<?php

namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\Session;
use App\Models\Role;
use App\Http\Controllers\Repository\EmployeeModel;

class AdministradorController extends Controller
{
    protected $employeeModel;

    public function __construct(EmployeeModel $employeeModel)
    {
        $this->employeeModel = $employeeModel;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $role = Role::where('name', 'Administrador')->first();
        $id_company = Session::get('company_id');

        $employees = Employee::where('id_role', $role->id)
            ->where('id_company', $id_company)
            ->get();

        return view('Gerente.Administrador.index', compact('employees'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'nombres.required' => 'El campo Nombres es obligatorio.',
            'apellidos.required' => 'El campo Apellidos es obligatorio.',
            'correo.required' => 'El campo Correo es obligatorio.',
            'correo.email' => 'El campo Correo debe ser una dirección de correo electrónico válida.',
            'correo.unique' => 'El correo ya está en uso.',
            'fecha_nacimiento.required' => 'El campo Fecha de Nacimiento es obligatorio.',
            'fecha_nacimiento.date' => 'El campo Fecha de Nacimiento debe ser una fecha válida.',
            'posicion.required' => 'El campo Posición es obligatorio.',
            'documento_identidad.required' => 'El campo Documento de Identidad es obligatorio.',
        ];

        $validatedData = $request->validate([
            'nombres' => 'required',
            'apellidos' => 'required',
            'correo' => 'required|email|unique:employees,email',
            'fecha_nacimiento' => 'required|date',
            'posicion' => 'required',
            'documento_identidad' => 'required',
        ], $messages);

        if (!$validatedData) {
            return redirect()->back()->withErrors($validatedData);
        }
        $data = [
            'name' => $request->nombres,
            'lastname' => $request->apellidos,
            'doi' => $request->documento_identidad,
            'id_company' => Session::get('company_id'),
            'birthdate' => $request->fecha_nacimiento,
            'role' => 'Administrador',
            'position' => $request->posicion,
            'email' => $request->correo,
        ];
        $result = $this->employeeModel->create($data);

        if ($result[0]) {
            return redirect()->back()->with('success', 'Empleado creado exitosamente');
        } else {
            return redirect()->back()->with('warning', $result[1]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
