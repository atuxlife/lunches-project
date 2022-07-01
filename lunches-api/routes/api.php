<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Endpoints Ingredientes
Route::get('ingredientes', 'App\Http\Controllers\IngredienteController@index');
Route::get('ingredientes/{id}', 'App\Http\Controllers\IngredienteController@show');
Route::post('ingredientes', 'App\Http\Controllers\IngredienteController@store');
Route::put('ingredientes/{id}', 'App\Http\Controllers\IngredienteController@update');
Route::delete('ingredientes/{id}', 'App\Http\Controllers\IngredienteController@destroy');

// Endpoints Menús
Route::get('menus', 'App\Http\Controllers\MenuController@index');
Route::get('menus/{id}', 'App\Http\Controllers\MenuController@show');

// Endpoints Solicitudes
Route::get('solicitudes', 'App\Http\Controllers\SolicitudesController@index');
Route::get('solicitar-plato', 'App\Http\Controllers\SolicitudesController@solicitarPlato');
Route::get('solicitar-compra', 'App\Http\Controllers\SolicitudesController@solicitarCompra');
Route::get('reprocesar-solicitudes', 'App\Http\Controllers\SolicitudesController@reprocesarOrdenes');

// Endpoint de mercado
Route::get('mercado', 'App\Http\Controllers\MarketPlaceController@index');
Route::get('comprar-mercado', 'App\Http\Controllers\MarketPlaceController@comprarMercado');
Route::get('actualizar-mercado', 'App\Http\Controllers\MarketPlaceController@actualizarMercado');
Route::get('ordenes-compra', 'App\Http\Controllers\MarketPlaceController@ordenesCompra');
