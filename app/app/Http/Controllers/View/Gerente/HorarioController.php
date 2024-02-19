<?php

namespace App\Http\Controllers\View\Gerente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\Session;
use App\Models\Schedule;
use App\Http\Controllers\Repository\EmployeeModel;
use App\Models\Attendance;

class HorarioController extends Controller
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
        $employees = Employee::where('id_company', Session::get('company_id'))->get();
        $employeeIds = $employees->pluck('id');
        $attendances = Attendance::whereIn('id_employee', $employeeIds)->orderBy('created_at', 'desc')->get();
        return view('gerente.horarios.index', compact('employees', 'attendances'));
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
            'employee.required' => 'El campo empleado es requerido.',
            'schedule.required' => 'El campo horario es requerido.',
        ];

        $validatedData = $request->validate([
            'employee' => 'required',
            'schedule' => 'required',
        ], $messages);

        if (!$validatedData) {
            return redirect()->back()->withErrors($validatedData);
        }
        $data = [
            'id_employee' => $request->employee,
            'id_schedule' => $request->schedule,
        ];
        $result = $this->employeeModel->asociarSchedule($data);
        if ($request[0]) {
            return redirect()->back()->with('success', 'Horario asociado correctamente');
        } else {
            return redirect()->back()->with('error', 'Error al asociar el horario');
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
        $schedule = Schedule::find($id);

        if ($schedule) {
            $schedule->status = 'Inactive';
            $schedule->save();
            return redirect()->back()->with('success', 'Horario eliminado con éxito');
        }

        return redirect()->back()->with('warning', 'Horario no encontrado');
    }
}
