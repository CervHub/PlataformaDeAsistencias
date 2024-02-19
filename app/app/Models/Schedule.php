<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = ['name', 'data', 'status', 'id_company', 'totalHours', 'lunchHours', 'workHours', 'horas_receso'];
    use HasFactory;

    public function getDayStatus()
    {
        $this->data = json_decode($this->data);

        $days = ['L', 'M', 'X', 'J', 'V', 'S', 'D'];
        $result = [];

        foreach ($days as $day) {
            $from = $this->data->horario->$day->from;
            $to = $this->data->horario->$day->to;

            $result[$day] = !($from === "00:00" && $to === "00:00");
        }
        return $result;
    }
}
