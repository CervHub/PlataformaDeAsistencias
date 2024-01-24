<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VistaSuperAdminController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('', [AuthController::class, 'login'])->name('loginauth');

Route::prefix('superadmin')->middleware('superadmin')->group(function () {
    Route::get('dashboard', [VistaSuperAdminController::class, 'index'])->name('superadmin.dashboard');
    Route::get('companies', [VistaSuperAdminController::class, 'companies'])->name('superadmin.companies');
    Route::post('companies_create', [VistaSuperAdminController::class, 'companies_create'])->name('superadmin.companies_create');
    Route::get('access', [VistaSuperAdminController::class, 'access'])->name('superadmin.access');
});
