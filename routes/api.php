<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\MenuController;

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

//Route example
Route::post('example/conection', [MenuController::class, 'example']);

