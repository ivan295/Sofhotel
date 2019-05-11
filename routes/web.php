<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', function () {
    return redirect('/login');
});

Route::group(['middleware' => 'auth'], function () {

});

Route::get('/habitacion/nuevahabitacion', function () {
    return view('/vendor/adminlte/nuevahabitacion');
});

Route::post('/hab_mod', function () {
  return view('/vendor/adminlte/edithabitacion');

});

Route::get('/Habitacion', 'HabitacionController@index');

Route::post('Habitacion/mostrar', ['as' => 'habitacion.index', 'uses'=>'HabitacionController@index']);
Route::delete('Habitacion/{id}/eliminar', ['as'=> 'habitacion.delete', 'uses' =>'HabitacionController@destroy']);

Route::post('Habitacion/{id}/edit', ['as' => 'habitacion.editar', 'uses' => 'HabitacionController@edit']);

Route::put('Habitacion/{id}', ['as' => 'habitacion.update', 'uses'=>'HabitacionController@update']);

Route::post('Habitacion/crear', ['as' => 'habitacion.create', 'uses'=>'HabitacionController@store']);
