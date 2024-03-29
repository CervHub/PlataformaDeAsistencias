<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Repository\CompanyModel;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\AttendancesController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('employee/create', [EmployeeController::class, 'store']);
Route::get('employee/show/{id}', [EmployeeController::class, 'show']);
Route::post('attendance/register', [AttendancesController::class, 'store']);
Route::get('attendance/', [AttendancesController::class, 'index']);
