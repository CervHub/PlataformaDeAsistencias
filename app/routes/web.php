<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\View\GerenciaController;
use App\Http\Controllers\View\TallerController;
use App\Http\Controllers\View\AdministradorController;
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
        // Las rutas predefinidas son:
        // GET /gerencia/administradores (muestra la lista de administradores) -> administradores.index
        // GET /gerencia/administradores/create (muestra el formulario de creación de administradores) -> administradores.create
        // POST /gerencia/administradores (almacena un nuevo administrador) -> administradores.store
        // GET /gerencia/administradores/{administrador} (muestra un administrador específico) -> administradores.show
        // GET /gerencia/administradores/{administrador}/edit (muestra el formulario de edición de un administrador específico) -> administradores.edit
        // PUT/PATCH /gerencia/administradores/{administrador} (actualiza un administrador específico) -> administradores.update
        // DELETE /gerencia/administradores/{administrador} (elimina un administrador específico) -> administradores.destroy
    });
});
