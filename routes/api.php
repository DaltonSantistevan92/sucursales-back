<?php

use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\GeneralController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\NegocioController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//Rutas de personas
Route::get('personas',[PersonaController::class, 'getPersons']);

//Routes of users
Route::post('user/login', [UsuarioController::class, 'login']);

//Routes for menus
Route::get('menu/{rol_id}/{parte}', [MenuController::class, 'get']);

//Route para tipos Negocios, Provincia
Route::get('tipo-negocio', [GeneralController::class, 'getTiposNegocios']);
Route::get('provincia', [GeneralController::class, 'getProvincias']);
Route::get('seccion', [GeneralController::class, 'getSecciones']);
Route::get('horario', [GeneralController::class, 'getHorarios']);
Route::get('ciudad/{provincia_id}', [GeneralController::class, 'getCiudades']);
Route::get('tipo-empleo', [GeneralController::class, 'getTipoEmpleado']);

//Rutas de empleados
Route::get('empleado/{campo}/{valor}', [EmpleadoController::class, 'getEmpleadoByCampo']);

//Rutas de negocio
Route::post('negocio', [NegocioController::class, 'create']);
Route::get('negocio', [NegocioController::class, 'get']);
