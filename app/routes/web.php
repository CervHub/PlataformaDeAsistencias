<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\View\Gerente\PersonalController;
use App\Http\Controllers\View\Gerente\GerenciaController;
use App\Http\Controllers\View\TallerController;
use App\Http\Controllers\View\AdministradorController;
use App\Http\Controllers\View\Gerente\HorarioController;
use App\Http\Controllers\View\Root\RootController;
use App\Http\Controllers\View\Root\CompanyController;
use App\Http\Controllers\View\Gerente\PermisoController;
use App\Http\Controllers\View\Gerente\IncidenteController;
use App\Http\Controllers\View\Gerente\ReporteController;
use App\Http\Controllers\View\Gerente\JornadasController;
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
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::prefix('gerencia')->group(function () {
        Route::get('', [GerenciaController::class, 'show'])->name('gerencia.show');
        Route::resource('talleres', TallerController::class);
        Route::resource('administradores', AdministradorController::class);
        Route::resource('personal', PersonalController::class);
        Route::post('personal/upload', [PersonalController::class, 'upload'])->name('personal.upload');
        Route::resource('permisos', PermisoController::class);
        Route::resource('incidentes', IncidenteController::class);
        Route::resource('reportes', ReporteController::class);
        Route::resource('horarios', HorarioController::class);
        Route::resource('jornadas', JornadasController::class);
    });

    Route::prefix('root')->group(function () {
        Route::resource('root', RootController::class);
        Route::resource('company', CompanyController::class);
    });
});
