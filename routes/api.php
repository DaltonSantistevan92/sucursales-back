<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\GeneralController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\Detalle_CompraController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\NegocioController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\Producto_NegocioController;
use App\Http\Controllers\ToolController;


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
Route::get('negocio/estado/{estado}', [NegocioController::class, 'getActivos']);
Route::put('negocio/actualizar/estado', [NegocioController::class, 'updateStatus']);
Route::post('negocio/productos', [NegocioController::class, 'addSucursalNegocio']);
Route::get('negocio/productos/{id}', [NegocioController::class, 'viewNegocioProducto']);

//Rutas de categorias
Route::post('categoria', [CategoriaController::class, 'createCategory']);
Route::get('categoria/{orden}', [CategoriaController::class, 'get']);
Route::put('categoria/delete', [CategoriaController::class, 'delete']);

//Rutas de producto
Route::get('producto/{estado}', [ProductoController::class, 'get']);
Route::get('producto/{id}', [ProductoController::class, 'find']);
Route::get('producto/categoria/{categoria_id}/{estado}', [ProductoController::class, 'getProductoByCategoria']);
Route::post('producto', [ProductoController::class, 'create']);
Route::put('producto/actualizar-estado', [ProductoController::class, 'updateStatus']); //editar

//Ruta Producto_Negocio
Route::get('producto_negocio/{negocio_id}/{categoria_id}/{estado}',[Producto_NegocioController::class, 'getProductoByNegocio']);
Route::get('producto_negocio/{producto_id}',[Producto_NegocioController::class, 'getProductoById']);


//Ruta de Compra
Route::post('compra',[CompraController::class, 'create']);
Route::get('compra/cantidad/{negocio_id}/{year}/{month}', [CompraController::class, 'cantCompraEstado']);
Route::get('compra/{negocio_id}/{status_id}/{year}/{month}', [CompraController::class, 'get']);
Route::put('compra/confirmar', [CompraController::class, 'confirmarCompra']);

//Ruta de Detalle_Compra
Route::post('detallecompra',[Detalle_CompraController::class, 'create']);

//Ruta para traer imagenes
Route::get('archivo/{folder}/{file}', [ToolController::class, 'viewImage']);

//Ruta de proveedor
Route::get('proveedor', [ProveedorController::class, 'get']);
Route::get('proveedor/{id}', [ProveedorController::class, 'find']);
Route::get('proveedor/estado/{estado}', [ProveedorController::class, 'getByEstado']);
Route::post('proveedor', [ProveedorController::class, 'createProveedor']);

//Ruta para subir archivos
Route::post('upload', [ToolController::class, 'uploadFile']);
Route::get('year/{estado}', [ToolController::class, 'getYears']);
Route::get('month', [ToolController::class, 'getMonths']);

