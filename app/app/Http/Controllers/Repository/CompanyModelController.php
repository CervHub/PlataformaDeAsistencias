<?php

namespace App\Http\Controllers\Repository;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Company;
use App\Http\Controllers\Repository\UserModelController;
use Illuminate\Validation\ValidationException;

class CompanyModelController extends Controller
{
    private $userController;

    public function __construct()
    {
        $this->userController = new UserModelController;
    }

    public function create(Request $request)
    {
        // Validar los datos del request
        $request->validate([
            'ruc' => 'required|unique:companies',
            'name' => 'required',
            'description' => 'required',
        ]);

        // Crear una nueva compañía
        $company = new Company;
        $company->ruc = $request->ruc;
        $company->name = $request->name;
        $company->description = $request->description;
        $company->save();

        $userResponse = $this->userController->createUser();


        // Retornar una respuesta
        return response()->json(['message' => 'Company created successfully'], 201);
    }
}
