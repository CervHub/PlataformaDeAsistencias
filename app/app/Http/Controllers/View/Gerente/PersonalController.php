<?php

namespace App\Http\Controllers\View\Gerente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Role;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Repository\EmployeeModel;
use App\Models\Schedule;
use App\Imports\EmployeeImport;
use Maatwebsite\Excel\Facades\Excel;

class PersonalController extends Controller
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
        $jornadas = Schedule::where('id_company', Session::get('company_id'))->get();
        $company_id = Session::get('company_id');

        $adminRoleId = Role::where('name', 'Gerente')->first()->id; // Reemplaza esto con el id del rol de administrador
        $employees = Employee::where('id_company', $company_id)
            ->where('id_role', '!=', $adminRoleId)
            ->get();
        return view('Gerente.Personal.index', compact('employees', 'jornadas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    public function upload(Request $request)
    {
        try {
            $employeeModel = new EmployeeModel;
            Excel::import(new EmployeeImport($employeeModel), $request->file('excel'));
            return redirect()->back()->with('success', 'Archivo importado con éxito');
        } catch (\Exception $e) {
            return redirect()->back()->with('warning', 'Hubo un error durante la importación: ' . $e->getMessage());
        }
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
            'documento_identidad' => 'required'
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
            'role' => 'Empleado',
            'position' => $request->posicion,
            'email' => $request->correo,
            'id_schedule' => $request->jornada
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
        dd($id);
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
        $employee = Employee::find($id);
        if ($employee) {
            $employee->delete();
            return redirect()->back()->with('success', 'Empleado eliminado con éxito');
        }

        return redirect()->back()->with('warning', 'Empleado no encontrado');
    }
}
