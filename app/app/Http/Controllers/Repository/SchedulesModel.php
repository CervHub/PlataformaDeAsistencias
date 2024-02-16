<?php

namespace App\Http\Controllers\Repository;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Schedule;
use Illuminate\Support\Facades\Session;

class SchedulesModel extends Controller
{
    public function create($data)
    {
        DB::beginTransaction();

        try {
            $name = $data['name'];
            $json = $data['json'];
            $id_company = $data['id_company'];
            $totalHours = $data['totalHours'];
            $lunchHours = $data['lunchHours'];
            $workHours = $data['workHours'];
            $horas_receso = $data['horas_receso'];

            $new_schedule = Schedule::where('name', $name)->first();

            if ($new_schedule) {
                return [false, 'La Jornada ya existe'];
            } else {
                $new_schedule = Schedule::create([
                    'name' => $name,
                    'data' => $json,
                    'status' => 'Active',
                    'id_company' => $id_company,
                    'totalHours' => $totalHours,
                    'lunchHours' => $lunchHours,
                    'workHours' => $workHours,
                    'horas_receso' => $horas_receso
                ]);

                DB::commit();

                return [true, 'Jornada creada!'];
            }
        } catch (\Exception $e) {
            DB::rollback();

            error_log('Error creating schedule: ' . $e->getMessage());
            return [false, $e->getMessage()];
        }
    }
}
