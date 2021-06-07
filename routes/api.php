<?php

use Illuminate\Http\Request;

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

//DatosMaestros
Route::group(['prefix' => 'DatosMaestros'], function() {
    Route::get('GetZafras', 'DatosMaestrosController@GetZafras');
    Route::get('GetSemanas', 'DatosMaestrosController@GetSemanas');
    Route::get('GetIngenios', 'DatosMaestrosController@GetIngenios');
    Route::get('GetHaciendasAutocomplete', 'DatosMaestrosController@GetHaciendasAutocomplete');
    Route::get('GetLotesXIdHacienda', 'DatosMaestrosController@GetLotesXIdHacienda');
    Route::get('GetOrdenCosechaxLote', 'DatosMaestrosController@GetOrdenCosechaxLote');
    Route::get('GetEquiposXEtapaOp', 'DatosMaestrosController@GetEquiposXEtapaOp');
    Route::get('GetHaciendas', 'DatosMaestrosController@GetHaciendas');
    Route::get('GetZafraActiva', 'DatosMaestrosController@GetZafraActiva');
    Route::get('GetHdaXLibActiva', 'DatosMaestrosController@GetHdaXLibActiva');
    Route::get('GetLotesLibActivas', 'DatosMaestrosController@GetLotesLibActivas');
    Route::get('GetLibActivasxLote', 'DatosMaestrosController@GetLibActivasxLote');
    Route::get('GetFlotasxHacienda', 'DatosMaestrosController@GetFlotasxHacienda');
    Route::get('GetMotivosDeRechazo', 'DatosMaestrosController@GetMotivosDeRechazo');
});

//CRUDPRODUCTOS
Route::group(['prefix' => 'Productos'], function() {
    Route::get('ObtenerProductos', 'ProductoController@GetProductos');
  
});
//CRUDPROVEEDOR
Route::group(['prefix' => 'Proveedor'], function() {
    Route::get('ObtenerProveedor', 'ProveedorController@GetProveedor');
  
});