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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::group(['prefix' => 'v1','middleware' => 'auth:api'], function () {
    //    Route::resource('task', 'TasksController');

    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
    #adminlte_api_routes
});

Route::get('usuario_api_report', 'usuarioController@usuario_api');

Route::get('usuario_api_filtro/{id}', 'usuarioController@usuario_filtro_api');
//reportes de depositos

Route::get('report_depositos_diario/{fecha}', 'DepositoController@reporte_diario_api');



Route::get('report_depositos_especifico/{fecha_inicial}/{fecha_final}', 'DepositoController@reporte_especifico_api');

Route::get('report_depositos_mensual/{mes}', 'DepositoController@reporte_mensual_api');

//reportes de gastos

Route::get('report_gastos_diario/{fecha}', 'gastosController@reporte_diario_api');

Route::get('report_gastos_especifico/{fecha_inicial}/{fecha_final}', 'gastosController@reporte_especifico_api');

Route::get('report_gastos_mensual/{mes}', 'gastosController@reporte_mensual_api');

//reportes generales

Route::get('report_general_diario/{fecha}', 'ReporteGeneralController@reporte_diario_api');

Route::get('report_general_especifico/{fecha_inicial}/{fecha_final}', 'ReporteGeneralController@reporte_especifico_api');

Route::get('report_general_mensual/{mes}', 'ReporteGeneralController@reporte_mensual_api');


//reportes por usuario

Route::get('consult_caja_usuario_dia/{fecha}', 'ReporteGeneralController@caja_usuario_dia_api');

Route::get('consult_caja_usuario_mes/{mes}', 'ReporteGeneralController@caja_usuario_mes_api');

Route::get('consult_caja_usuario_especifico/{fecha_inicial}/{fecha_final', 'ReporteGeneralController@consulta_caja_usuario_especifico_api');

Route::get('consult_caja_usuario', 'ReporteGeneralController@consulta_usuario_api');

Route::get('report_usuario_diario/{id}', 'ReporteGeneralController@reporte_diario_usuario_api');

Route::get('report_usuario_especifico/{id}/{fecha_inicial}/{fecha_final}', 'ReporteGeneralController@reporte_especifico_usuario_api');


Route::get('report_usuario_mes/{id}/{mes}', 'ReporteGeneralController@reporte_mensual_usuario_api');