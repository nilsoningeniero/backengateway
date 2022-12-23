<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Middleware\Authenticate;

use App\http\Controllers\LoginController;
use App\http\Controllers\UserController;
use App\http\Controllers\MarcaController;
use App\http\Controllers\ModeloController;
use App\http\Controllers\PropietarioController;
use App\http\Controllers\VehiculoController;


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

Route::middleware('auth')->get('users', function (Request $request) {
     return $request->user();
});

Route::post('login', [LoginController::class, 'login']);

Route::put('logout', [LoginController::class, 'logout']);

//Route::apiResource('users', UserController::class);

Route::apiResource('marcas', MarcaController::class);

Route::apiResource('modelos', ModeloController::class);

Route::apiResource('propietarios', PropietarioController::class);

Route::apiResource('vehiculos', VehiculoController::class);
