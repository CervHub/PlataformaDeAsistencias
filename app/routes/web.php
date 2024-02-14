<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\View\GerenciaController;
use App\Http\Controllers\View\TallerController;
use App\Http\Controllers\View\AdministradorController;
use App\Http\Controllers\View\HorarioController;
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

        // Rutas para talleres
        Route::resource('talleres', TallerController::class);
        // Las rutas predefinidas son:
        // GET /gerencia/talleres (muestra la lista de talleres) -> talleres.index
        // GET /gerencia/talleres/create (muestra el formulario de creación de talleres) -> talleres.create
        // POST /gerencia/talleres (almacena un nuevo taller) -> talleres.store
        // GET /gerencia/talleres/{taller} (muestra un taller específico) -> talleres.show
        // GET /gerencia/talleres/{taller}/edit (muestra el formulario de edición de un taller específico) -> talleres.edit
        // PUT/PATCH /gerencia/talleres/{taller} (actualiza un taller específico) -> talleres.update
        // DELETE /gerencia/talleres/{taller} (elimina un taller específico) -> talleres.destroy

        // Rutas para administradores
        Route::resource('administradores', AdministradorController::class);
        Route::resource('horarios', HorarioController::class);
    });
});
