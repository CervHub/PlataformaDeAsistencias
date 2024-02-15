<?php

namespace App\Http\Controllers\View\Root;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Http\Controllers\Repository\CompanyModel;
use App\Models\Employee;
use App\Models\Role;

class CompanyController extends Controller
{
    public $companyModel;

    public function __construct(CompanyModel $companyModel)
    {
        $this->companyModel = $companyModel;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::all();
        return view('Root.Company.index', compact('companies'));
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
            'ruc.required' => 'El campo RUC es obligatorio.',
            'ruc.unique' => 'El RUC ya está en uso.',
            'name.required' => 'El campo nombre es obligatorio.',
            'description.required' => 'El campo descripción es obligatorio.',
        ];

        $validated = $request->validate([
            'ruc' => 'required|unique:companies',
            'name' => 'required',
            'description' => 'required',
        ], $messages);

        if (!$validated) {
            return redirect()->back()->withErrors($validated);
        }

        try {
            $data = [
                'ruc' => $request->ruc,
                'name' => $request->name,
                'description' => $request->description,
                'role' => 'Gerente',
            ];

            $this->companyModel->create($data);
        } catch (\Exception $e) {
            return redirect()->back()->with('warning', 'Error al crear la empresa.');
        }

        return redirect()->back()->with('success', 'La empresa se creó correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $company = Company::find($id);
        $data = [
            'name' => $company->name,
            'description' => $company->description,
            'ruc' => $company->ruc,
            'password' => $company->password,
        ];

        return response()->json($data);
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
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $company = Company::findOrFail($id);
        $company->update($validated);

        return redirect()->route('company.index')->with('success', 'La gerencia se actualizó correctamente.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
