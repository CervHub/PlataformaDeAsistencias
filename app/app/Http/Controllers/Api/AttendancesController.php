<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Employee;
use App\Models\Attendance;
use Carbon\Carbon;
use DateTimeZone;

class AttendancesController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    function formatCode($companyId, $rucNumber)
    {
        $formattedCompanyId = str_pad($companyId, 4, '0', STR_PAD_LEFT);
        return $formattedCompanyId . '-' . $rucNumber;
    }

    public function index()
    {
        try {
            // Tu código aquí

            return response()->json([
                'success' => true,
                'message' => 'Conexión exitosa con la API del Sistema Integrado de Gestión (SIG). Los datos se han cargado correctamente.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Hubo un error: ' . $e->getMessage()
            ], 500);
        }
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $dni = $request->input('dni');
            $ruc = $request->input('ruc');

            $company = Company::where('ruc', $ruc)->first();
            $code = $this->formatCode($company->id, $dni);
            $employee = Employee::where('code', $code)->first();

            if (!$employee) {
                return response()->json([
                    'success' => false,
                    'message' => 'El empleado no existe.'
                ]);
            }

            if ($employee->id_schedule) {
                try {
                    // Obtén la fecha y hora actual en la zona horaria de Perú
                    $now = Carbon::now(new DateTimeZone('America/Lima'));
                    $date = $now->toDateString();  // Obtén la fecha actual como una cadena

                    // Verifica si existe un registro de asistencia para el empleado en la fecha actual
                    $attendance = Attendance::where('id_employee', $employee->id)
                        ->whereDate('created_at', $date)
                        ->first();

                    if ($attendance) {
                        $now = Carbon::now(new DateTimeZone('America/Lima'));
                        if (!$attendance->lunch_exit_time) {
                            $attendance->lunch_exit_time = $now;
                            $message = 'Se ha registrado la hora de salida del almuerzo.';
                        } elseif (!$attendance->lunch_return_time) {
                            $attendance->lunch_return_time = $now;
                            $message = 'Se ha registrado la hora de retorno del almuerzo.';
                        } elseif (!$attendance->work_exit_time) {
                            $attendance->work_exit_time = $now;
                            $message = 'Se ha registrado la hora de salida del trabajo.';
                        } else {
                            $message = 'Usted ya completó su registro para hoy.';
                        }

                        $attendance->save();
                    } else {
                        $success = false;
                        $message = 'Se registro su hora de Ingreso.';

                        $attendance = new Attendance();
                        $attendance->work_entry_time = Carbon::now(new DateTimeZone('America/Lima'));
                        $attendance->id_employee = $employee->id;
                        $attendance->save();
                    }

                    return response()->json([
                        'success' => true,
                        'message' => $message
                    ]);
                } catch (\Exception $e) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Hubo un error al procesar los datos: ' . $e->getMessage()
                    ], 500);
                }
            } else {
                $success = false;
                $message = 'El empleado no tiene registrado un horario.';
            }

            return response()->json([
                'success' => $success,
                'message' => $message
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Hubo un error al procesar los datos: ' . $e->getMessage()
            ], 500);
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
