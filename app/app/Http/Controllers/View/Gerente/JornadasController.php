<?php

namespace App\Http\Controllers\View\Gerente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Repository\SchedulesModel;
use App\Models\Schedule;
use Illuminate\Support\Facades\Session;

class JornadasController extends Controller
{
    protected $schedulesModel;
    public function __construct(SchedulesModel $schedulesModel)
    {
        $this->schedulesModel = $schedulesModel;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schedules = Schedule::where('id_company', Session::get('company_id'))->get();
        return view('Gerente.Jornada.index', compact('schedules'));
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
        $data = [
            'name' => $request->nombre_jornada,
            'json' => $request->datajson,
            'totalHours' => $request->totalHours,
            'lunchHours' => $request->lunchHours,
            'workHours' => $request->workHours,
            'horas_receso' => $request->horas_receso,
            'id_company' => Session::get('company_id')
        ];

        $result = $this->schedulesModel->create($data);

        if ($result[0]) {
            return redirect()->back()->with('success', 'Jornada creada exitosamente');
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
