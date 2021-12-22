<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\GeneralController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\NegocioController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\ToolController;
use App\Models\Proveedor;

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
Route::post('user/save', [UsuarioController::class, 'saveUser']);

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
Route::get('negocio/{id}', [NegocioController::class, 'find']);
Route::put('negocio/actualizar/estado', [NegocioController::class, 'updateStatus']);

//Rutas de categorias
Route::post('categoria', [CategoriaController::class, 'createCategory']);
Route::get('categoria/{orden}', [CategoriaController::class, 'get']);
Route::put('categoria/delete', [CategoriaController::class, 'delete']);

//Rutas de producto
Route::get('producto/{estado}', [ProductoController::class, 'get']);
Route::get('producto/{id}', [ProductoController::class, 'find']);
Route::post('producto', [ProductoController::class, 'create']);
Route::put('producto/actualizar-estado', [ProductoController::class, 'updateStatus']); //editar

//Ruta para traer imagenes
Route::get('archivo/{folder}/{file}', [ToolController::class, 'viewImage']);

//Ruta de proveedor
Route::get('proveedor', [ProveedorController::class, 'get']);
Route::get('proveedor/{id}', [ProveedorController::class, 'find']);
Route::get('proveedor/estado/{estado}', [ProveedorController::class, 'getByEstado']);
Route::post('proveedor', [ProveedorController::class, 'createProveedor']);

//Ruta del cliente

