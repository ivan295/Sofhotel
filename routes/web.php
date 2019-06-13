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
//nueva habitacion
Route::get('/habitacion/nuevahabitacion', function () {
    return view('/vendor/adminlte/nuevahabitacion');
});
//nuevo gasto
Route::get('/gastos/nuevogasto', function () {
    return view('/vendor/adminlte/gastos');
});
//tipo de usuario
Route::get('/tipouser/nuevotipousuario', function () {
    return view('/vendor/adminlte/tipousuario');
});
//nuevo usuario
Route::get('/nuevouser/nuevousuario', function () {
    return view('/vendor/adminlte/nuevousuario');
});
//factura compra
Route::get('/factura_compra/facturaCompra',function(){
	return view('/vendor/adminlte/facturaCompra');
});
//proveedor
Route::get('/proveedor/proveedor',function(){
	return view('/vendor/adminlte/nuevoproveedor');
});
//productos
Route::get('/productos/productos',function(){
	return view('/vendor/adminlte/nuevoproducto');
});
//detalle_compra
Route::get('/detalle_compra/detalle_compra',function(){
	return view('/vendor/adminlte/detalleCompra');
});
//alquiler
Route::get('/alquiler/alquiler',function(){
    return view('/vendor/adminlte/Alquiler');
});



//rutas index
Route::get('/Habitacion', 'HabitacionController@index');
Route::get('/gastos', 'gastosController@index');
Route::get('/tipouser', 'tipousuarioController@index');
Route::get('/nuevouser', 'usuarioController@index');
Route::get('/factura_compra','facturacompraController@index');
Route::get('/proveedor','proveedorController@index');
Route::get('/productos','productosController@index');
Route::get('/detalle_compra','detalleCompraController@index');
Route::get('/alquiler','alquilerController@index');





//nueva habitacion
Route::post('Habitacion/mostrar', ['as' => 'habitacion.index', 'uses'=>'HabitacionController@index']);

Route::delete('Habitacion/{id}/eliminar', ['as'=> 'habitacion.delete', 'uses' =>'HabitacionController@destroy']);

Route::post('Habitacion/{id}/edit', ['as' => 'habitacion.editar', 'uses' => 'HabitacionController@edit']);

Route::put('Habitacion/{id}', ['as' => 'habitacion.update', 'uses'=>'HabitacionController@update']);

Route::post('Habitacion/crear', ['as' => 'habitacion.create', 'uses'=>'HabitacionController@store']);


//gastos/////////////////
Route::post('gastos/crear', ['as' => 'gastos.create', 'uses'=>'gastosController@store']);

Route::delete('gastos/{id}/eliminar', ['as'=> 'gastos.delete', 'uses' =>'gastosController@destroy']);

Route::post('gastos/{id}/edit', ['as' => 'gastos.editar', 'uses' => 'gastosController@edit']);

Route::put('gastos/{id}', ['as' => 'gastos.update', 'uses'=>'gastosController@update']);

//tipo de usuario////////////
Route::post('tipouser/crear', ['as' => 'tipouser.create', 'uses'=>'tipousuarioController@store']);

Route::delete('tipouser/{id}/eliminar', ['as'=> 'tipouser.delete', 'uses' =>'tipousuarioController@destroy']);

Route::post('tipouser/{id}/edit', ['as' => 'tipouser.editar', 'uses' => 'tipousuarioController@edit']);

Route::put('tipouser/{id}', ['as' => 'tipouser.update', 'uses'=>'tipousuarioController@update']);

//nuevo usuario///////////
Route::post('nuevouser/crear', ['as' => 'nuevouser.create', 'uses'=>'usuarioController@store']);

Route::delete('nuevouser/{id}/eliminar', ['as'=> 'nuevouser.delete', 'uses' =>'usuarioController@destroy']);

Route::post('nuevouser/{id}/edit', ['as' => 'nuevouser.editar', 'uses' => 'usuarioController@edit']);

Route::put('nuevouser/{id}', ['as' => 'nuevouser.update', 'uses'=>'usuarioController@update']);

//factura compra/////
Route::post('factura_compra/crear', ['as' => 'factura_compra.create', 'uses'=>'facturacompraController@store']);

Route::delete('factura_compra/{id}/eliminar', ['as'=> 'factura_compra.delete', 'uses' =>'facturacompraController@destroy']);

Route::post('factura_compra/{id}/edit', ['as' => 'factura_compra.editar', 'uses' => 'facturacompraController@edit']);

Route::put('factura_compra/{id}', ['as' => 'factura_compra.update', 'uses'=>'facturacompraController@update']);

//Arduino
Route::get('/iniciarestado', function () {
    return view('/vendor/adminlte/iniciarestado');
});

Route::get('/estado/{t}', 'EstadoController@add');

Route::get('/modificar_estado/{t}', 'EstadoController@mod');

Route::get('modestados', 'EstadoController@actualizar');


//proveedor
Route::post('proveedor/crear', ['as' => 'proveedor.create', 'uses'=>'proveedorController@store']);

Route::delete('proveedor/{id}/eliminar', ['as'=> 'proveedor.delete', 'uses' =>'proveedorController@destroy']);

Route::post('proveedor/{id}/edit', ['as' => 'proveedor.editar', 'uses' => 'proveedorController@edit']);

Route::put('proveedor/{id}', ['as' => 'proveedor.update', 'uses'=>'proveedorController@update']);


//productos
Route::post('productos/crear', ['as' => 'productos.create', 'uses'=>'productosController@store']);

Route::delete('productos/{id}/eliminar', ['as'=> 'productos.delete', 'uses' =>'productosController@destroy']);

Route::post('productos/{id}/edit', ['as' => 'productos.editar', 'uses' => 'productosController@edit']);

Route::put('productos/{id}', ['as' => 'productos.update', 'uses'=>'productosController@update']);

//detalle_compra
Route::post('detalle_compra/crear', ['as' => 'detalle_compra.create', 'uses'=>'detalleCompraController@store']);

Route::delete('detalle_compra/{id}/eliminar', ['as'=> 'detalle_compra.delete', 'uses' =>'detalleCompraController@destroy']);

Route::post('detalle_compra/{id}/edit', ['as' => 'detalle_compra.editar', 'uses' => 'detalleCompraController@edit']);

Route::put('detalle_compra/{id}', ['as' => 'detalle_compra.update', 'uses'=>'detalleCompraController@update']);


/// filtro de productos
//Route::get('filtroProductos/{dato?}','detalleCompraController@filtroProductos');
// Route::get()


//Alquiler
Route::post('alquiler/crear', ['as' => 'alquiler.create', 'uses'=>'alquilerController@store']);

Route::delete('alquiler/{id}/eliminar', ['as'=> 'alquiler.delete', 'uses' =>'alquilerController@destroy']);

Route::post('alquiler/{id}/edit', ['as' => 'alquiler.editar', 'uses' => 'alquilerController@edit']);

Route::put('alquiler/{id}', ['as' => 'alquiler.update', 'uses'=>'alquilerController@update']);

