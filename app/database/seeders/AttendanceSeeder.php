<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;
use App\Models\Employee;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $start = new DateTime('2024-01-01');
        $end = new DateTime(); // Hoy
        $id_company = 2;
        $employees = Employee::where('id_company', $id_company)->get();
        $employeeIds = Employee::where('id_company', $id_company)->pluck('id');

        $start = new DateTime('2024-01-01');
        $end = new DateTime(); // Hoy
        $id_company = 2;

        for ($i = $start; $i <= $end; $i->modify('+1 day')) {
            $dayOfWeek = $i->format('N'); // Día de la semana en formato numérico (1=Lunes, 7=Domingo)
            if ($dayOfWeek >= 1 && $dayOfWeek <= 5) { // Si es de lunes a viernes
                $date = $i->format('Y-m-d');
                // Aquí puedes insertar la fecha en la base de datos
                // Recuerda reemplazar los valores de ejemplo con los valores reales que deseas insertar
                $employees = Employee::where('id_company', $id_company)->get();
                foreach ($employees as $employee) {
                    $randomMinutesEntry = rand(0, 59);
                    $randomMinutesExit = rand(0, 59);
                    DB::table('attendances')->insert([
                        'work_entry_time' => $date . ' 08:' . str_pad($randomMinutesEntry, 2, '0', STR_PAD_LEFT) . ':00',
                        'work_exit_time' => $date . ' 18:' . str_pad($randomMinutesExit, 2, '0', STR_PAD_LEFT) . ':00',
                        'lunch_exit_time' => $date . ' 13:00:00',
                        'lunch_return_time' => $date . ' 14:00:00',
                        'status' => 'active',
                        'id_employee' => $employee->id,
                        'created_at' => $date . ' 08:' . str_pad($randomMinutesEntry, 2, '0', STR_PAD_LEFT) . ':00',
                        'updated_at' => $date . ' 18:' . str_pad($randomMinutesExit, 2, '0', STR_PAD_LEFT) . ':00',
                    ]);
                }
            }
        }
    }
}
