<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\TallerController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\AutoController;
use App\Http\Controllers\CobranzaController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\MecanicoController;
use App\Http\Controllers\RefaccionesController;
use App\Http\Controllers\Tipo_TrabajoController;
use App\Http\Controllers\Trabajo_RealizadoController;
use App\Http\Controllers\TrasladoController;

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

Route::post('login',[AuthController::class, 'authenticate']);
Route::post('register', [AuthController::class, 'register']);

Route::prefix('proveedores')->group(function(){
    Route::get('ver', [ProveedorController::class, 'index']);
    Route::get('ver/{id}', [ProveedorController::class, 'show']);
    Route::group(['middleware' => ['jwt.verify']], function() {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('get-user', [AuthController::class, 'getUser']);
        Route::post('ingresar', [ProveedorController::class, 'store']);
        Route::post('actualizar/{id}', [ProveedorController::class, 'update']);
        Route::post('mirar/{id}', [ProveedorController::class, 'delete']);
    });
});

Route::prefix('talleres')->group(function(){
    Route::get('ver', [TallerController::class, 'index']);
    Route::get('ver/{id}', [TallerController::class, 'show']);
    Route::group(['middleware' => ['jwt.verify']], function() {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('get-user', [AuthController::class, 'getUser']);
        Route::post('ingresar', [TallerController::class, 'store']);
        Route::post('actualizar/{id}', [TallerController::class, 'update']);
        Route::post('mirar/{id}', [TallerController::class, 'delete']);
    });
});

Route::prefix('clientes')->group(function(){
    Route::get('ver', [ClienteController::class, 'index']);
    Route::get('ver/{id}', [ClienteController::class, 'show']);
    Route::group(['middleware' => ['jwt.verify']], function() {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('get-user', [AuthController::class, 'getUser']);
        Route::post('ingresar', [ClienteController::class, 'store']);
        Route::post('actualizar/{id}', [ClienteController::class, 'update']);
        Route::post('mirar/{id}', [ClienteController::class, 'delete']);
    });
});

Route::prefix('autos')->group(function(){
    Route::get('ver', [AutoController::class, 'index']);
    Route::get('ver/{id}', [AutoController::class, 'show']);
    Route::group(['middleware' => ['jwt.verify']], function() {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('get-user', [AuthController::class, 'getUser']);
        Route::post('ingresar', [AutoController::class, 'store']);
        Route::post('actualizar/{id}', [AutoController::class, 'update']);
        Route::post('mirar/{id}', [AutoController::class, 'delete']);
    });
});

Route::prefix('cobranzas')->group(function(){
    Route::get('ver', [CobranzaController::class, 'index']);
    Route::get('ver/{id}', [CobranzaController::class, 'show']);
    Route::group(['middleware' => ['jwt.verify']], function() {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('get-user', [AuthController::class, 'getUser']);
        Route::post('ingresar', [CobranzaController::class, 'store']);
        Route::post('actualizar/{id}', [CobranzaController::class, 'update']);
        Route::post('mirar/{id}', [CobranzaController::class, 'delete']);
    });
});

Route::prefix('facturas')->group(function(){
    Route::get('ver', [FacturaController::class, 'index']);
    Route::get('ver/{id}', [FacturaController::class, 'show']);
    Route::group(['middleware' => ['jwt.verify']], function() {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('get-user', [AuthController::class, 'getUser']);
        Route::post('ingresar', [FacturaController::class, 'store']);
        Route::post('actualizar/{id}', [FacturaController::class, 'update']);
        Route::post('mirar/{id}', [FacturaController::class, 'delete']);
    });
});

Route::prefix('inventarios')->group(function(){
    Route::get('ver', [InventarioController::class, 'index']);
    Route::get('ver/{id}', [InventarioController::class, 'show']);
    Route::group(['middleware' => ['jwt.verify']], function() {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('get-user', [AuthController::class, 'getUser']);
        Route::post('ingresar', [InventarioController::class, 'store']);
        Route::post('actualizar/{id}', [InventarioController::class, 'update']);
        Route::post('mirar/{id}', [InventarioController::class, 'delete']);
    });
});

Route::prefix('mecanicos')->group(function(){
    Route::get('ver', [MecanicoController::class, 'index']);
    Route::get('ver/{id}', [MecanicoController::class, 'show']);
    Route::group(['middleware' => ['jwt.verify']], function() {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('get-user', [AuthController::class, 'getUser']);
        Route::post('ingresar', [MecanicoController::class, 'store']);
        Route::post('actualizar/{id}', [MecanicoController::class, 'update']);
        Route::post('mirar/{id}', [MecanicoController::class, 'delete']);
    });
});

Route::prefix('refacciones')->group(function(){
    Route::get('ver', [RefaccionesController::class, 'index']);
    Route::get('ver/{id}', [RefaccionesController::class, 'show']);
    Route::group(['middleware' => ['jwt.verify']], function() {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('get-user', [AuthController::class, 'getUser']);
        Route::post('ingresar', [RefaccionesController::class, 'store']);
        Route::post('actualizar/{id}', [RefaccionesController::class, 'update']);
        Route::post('mirar/{id}', [RefaccionesController::class, 'delete']);
    });
});

Route::prefix('tipotrabajos')->group(function(){
    Route::get('ver', [Tipo_TrabajoController::class, 'index']);
    Route::get('ver/{id}', [Tipo_TrabajoController::class, 'show']);
    Route::group(['middleware' => ['jwt.verify']], function() {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('get-user', [AuthController::class, 'getUser']);
        Route::post('ingresar', [Tipo_TrabajoController::class, 'store']);
        Route::post('actualizar/{id}', [Tipo_TrabajoController::class, 'update']);
        Route::post('mirar/{id}', [Tipo_TrabajoController::class, 'delete']);
    });
});

Route::prefix('trabajosrealiz')->group(function(){
    Route::get('ver', [Trabajo_RealizadoController::class, 'index']);
    Route::get('ver/{id}', [Trabajo_RealizadoController::class, 'show']);
    Route::group(['middleware' => ['jwt.verify']], function() {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('get-user', [AuthController::class, 'getUser']);
        Route::post('ingresar', [Trabajo_RealizadoController::class, 'store']);
        Route::post('actualizar/{id}', [Trabajo_RealizadoController::class, 'update']);
        Route::post('mirar/{id}', [Trabajo_RealizadoController::class, 'delete']);
    });
});

Route::prefix('traslados')->group(function(){
    Route::get('ver', [TrasladoController::class, 'index']);
    Route::get('ver/{id}', [TrasladoController::class, 'show']);
    Route::group(['middleware' => ['jwt.verify']], function() {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('get-user', [AuthController::class, 'getUser']);
        Route::post('ingresar', [TrasladoController::class, 'store']);
        Route::post('actualizar/{id}', [TrasladoController::class, 'update']);
        Route::post('mirar/{id}', [TrasladoController::class, 'delete']);
    });
});