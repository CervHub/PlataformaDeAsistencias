<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Repository\CompanyModelController;

class VistaSuperAdminController extends Controller
{
    private $companyController;

    public function __construct()
    {
        $this->companyController = new CompanyModelController;
    }

    public function index()
    {
        return view('SuperAdmin.index');
    }
    public function companies()
    {
        return view('SuperAdmin.Companies.index');
    }

    public function companies_create(Request $request)
    {
        $response = $this->companyController->create($request);
        dd($response->getStatusCode());
        if ($response->getStatusCode() == 201) {
            return redirect()->back()->with('success', 'Company created successfully');
        }

        return $response;
    }

    public function access()
    {
        return view('SuperAdmin.Users.index');
    }
}
