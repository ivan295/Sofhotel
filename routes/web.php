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
Route::get('/factura_venta/factura_venta',function(){
    return view('/vendor/adminlte/Facturaventa');
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
Route::get('/factura_venta','facturaventaController@index');
Route::get('/cargarinner','HomeController@index');



//ruta para llenar home
Route::get('/home','HomeController@index');
Route::get('/mostrar_inner','HomeController@getdata');


//nueva habitacion
Route::post('Habitacion/mostrar', ['as' => 'habitacion.index', 'uses'=>'HabitacionController@index']);

Route::delete('Habitacion/{id}/eliminar', ['as'=> 'habitacion.delete', 'uses' =>'HabitacionController@destroy']);

Route::post('Habitacion/{id}/edit', ['as' => 'habitacion.editar', 'uses' => 'HabitacionController@edit']);

Route::put('Habitacion/{id}', ['as' => 'habitacion.update', 'uses'=>'HabitacionController@update']);

Route::post('Habitacion/crear', ['as' => 'habitacion.create', 'uses'=>'HabitacionController@store']);


//gastos/////////////////

Route::get('gastos/index', ['as' => 'gastos.index', 'uses'=>'gastosController@index']);

Route::post('gastos/crear', ['as' => 'gastos.create', 'uses'=>'gastosController@store']);

Route::delete('gastos/{id}/eliminar', ['as'=> 'gastos.delete', 'uses' =>'gastosController@destroy']);

Route::post('gastos/{id}/edit', ['as' => 'gastos.editar', 'uses' => 'gastosController@edit']);

Route::put('gastos/{id}', ['as' => 'gastos.update', 'uses'=>'gastosController@update']);

//tipo de usuario////////////

Route::get('tipouser/index', ['as' => 'tipouser.index', 'uses'=>'tipousuarioController@index']);

Route::post('tipouser/crear', ['as' => 'tipouser.create', 'uses'=>'tipousuarioController@store']);

Route::delete('tipouser/{id}/eliminar', ['as'=> 'tipouser.delete', 'uses' =>'tipousuarioController@destroy']);

Route::post('tipouser/{id}/edit', ['as' => 'tipouser.editar', 'uses' => 'tipousuarioController@edit']);

Route::put('tipouser/{id}', ['as' => 'tipouser.update', 'uses'=>'tipousuarioController@update']);

//nuevo usuario///////////

Route::get('nuevouser/index', ['as' => 'nuevouser.index', 'uses'=>'usuarioController@index']);


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

Route::get('/estado/{t}', 'estadoController@add');
Route::get('/consult_estado','estadoController@mostrar');
Route::get('/modificar_estado/{t}/{ip}', 'estadoHabitacionController@mod');
Route::get('modestados', 'estadoController@actualizar');
Route::get('direccion_ip/{ip}','estadoHabitacionController@addip');
Route::post('alquiler','alquilerController@store');


//proveedor

Route::get('proveedor/index', ['as' => 'proveedor.index', 'uses'=>'proveedorController@index']);

Route::post('proveedor/crear', ['as' => 'proveedor.create', 'uses'=>'proveedorController@store']);

Route::delete('proveedor/{id}/eliminar', ['as'=> 'proveedor.delete', 'uses' =>'proveedorController@destroy']);

Route::post('proveedor/{id}/edit', ['as' => 'proveedor.editar', 'uses' => 'proveedorController@edit']);

Route::put('proveedor/{id}', ['as' => 'proveedor.update', 'uses'=>'proveedorController@update']);


//productos
Route::post('productos/crear', ['as' => 'productos.create', 'uses'=>'productosController@store']);

Route::delete('productos/{id}/eliminar', ['as'=> 'productos.delete', 'uses' =>'productosController@destroy']);

Route::post('productos/{id}/edit', ['as' => 'productos.editar', 'uses' => 'productosController@edit']);

Route::put('productos/{id}', ['as' => 'productos.update', 'uses'=>'productosController@update']);

Route::get('productos/index', ['as' => 'productos.index', 'uses'=>'productosController@index']);

//detalle_compra
Route::post('detalle_compra/crear', ['as' => 'detalle_compra.create', 'uses'=>'detalleCompraController@store']);

Route::delete('detalle_compra/{id}/eliminar', ['as'=> 'detalle_compra.delete', 'uses' =>'detalleCompraController@destroy']);

Route::post('detalle_compra/{id}/edit', ['as' => 'detalle_compra.editar', 'uses' => 'detalleCompraController@edit']);

Route::put('detalle_compra/{id}', ['as' => 'detalle_compra.update', 'uses'=>'detalleCompraController@update']);

Route::get('detalle_compra/filtroProductos', ['as' => 'detalle_compra.filtroProductos', 'uses'=>'detalleCompraController@filtroProductos']);

Route::get('detalle_compra/index', ['as' => 'detalle_compra.index', 'uses'=>'detalleCompraController@index']);




/// filtro de productos
//Route::get('filtroProductos/{dato?}','detalleCompraController@filtroProductos');
// Route::get()


//Alquiler
Route::post('alquiler/crear', ['as' => 'alquiler.create', 'uses'=>'alquilerController@store']);

Route::delete('alquiler/{id}/eliminar', ['as'=> 'alquiler.delete', 'uses' =>'alquilerController@destroy']);

Route::post('alquiler/{id}/edit', ['as' => 'alquiler.editar', 'uses' => 'alquilerController@edit']);

Route::put('alquiler/{id}', ['as' => 'alquiler.update', 'uses'=>'alquilerController@update']);



//factura venta
Route::post('factura_venta/crear', ['as' => 'factura_venta.create', 'uses'=>'facturaventaController@store']);

Route::delete('factura_venta/{id}/eliminar', ['as'=> 'factura_venta.delete', 'uses' =>'facturaventaController@destroy']);

Route::post('factura_venta/{id}/edit', ['as' => 'factura_venta.editar', 'uses' => 'facturaventaController@edit']);

Route::put('factura_venta/{id}', ['as' => 'factura_venta.update', 'uses'=>'facturaventaController@update']);


//Caja

Route::get('apertura', 'CajaController@index');

Route::get('/cierre', function () {
    return view('/vendor/adminlte/cierre_caja');
    //return view('/');
});

Route::post('crear', 'CajaController@store');


//Bancos

Route::get('/nuevo_banco', function () {
    return view('/vendor/adminlte/nuevo_banco');
});

Route::get('/modificar_banco', function () {
    return view('/vendor/adminlte/modificar_banco');
});

Route::get('banco', 'BancoController@index');

Route::get('banco/index', ['as' => 'banco.index', 'uses'=>'BancoController@index']);

Route::post('banco/crear', ['as' => 'banco.create', 'uses'=>'BancoController@store']);

Route::delete('banco/{id}/eliminar', ['as' => 'banco.delete', 'uses' => 'BancoController@destroy']);

Route::post('banco/{id}/edit', ['as' => 'banco.cambio', 'uses' => 'BancoController@edit']);

Route::put('banco/{id}', ['as' => 'banco.update', 'uses' => 'BancoController@update']);

//Tipo de cuentas

Route::get('/nuevo_tipo_cuenta', function () {
    return view('/vendor/adminlte/nuevo_tipo_cuenta');
});

Route::get('/modificar_tipo_cuenta', function () {
    return view('/vendor/adminlte/modificar_tipo_cuenta');
});

Route::get('tipo_cuenta', 'TipoCuentaController@index');

Route::get('tipo_cuenta/index', ['as' => 'tipo_cuenta.index', 'uses'=>'TipoCuentaController@index']);


Route::post('tipo_cuenta/crear', ['as' => 'tipo_cuenta.create', 'uses'=>'TipoCuentaController@store']);


Route::delete('tipo_cuenta/{id}/eliminar', ['as' => 'tipo_cuenta.delete', 'uses' => 'TipoCuentaController@destroy']);

Route::post('tipo_cuenta/{id}/edit', ['as' => 'tipo_cuenta.cambio', 'uses' => 'TipoCuentaController@edit']);

Route::put('tipo_cuenta/{id}', ['as' => 'tipo_cuenta.update', 'uses' => 'TipoCuentaController@update']);


//Propietarios cuentas

Route::get('/nuevo_propietario_cuenta', function () {
    return view('/vendor/adminlte/nuevo_propietario_cuenta');
});

Route::get('/modificar_propietario_cuenta', function () {
    return view('/vendor/adminlte/modificar_propietario_cuenta');
});

Route::get('propietario_cuenta', 'PropietarioCuentaController@index');


Route::post('propietario_cuenta/crear', ['as' => 'propietario_cuenta.create', 'uses'=>'PropietarioCuentaController@store']);


Route::delete('propietario_cuenta/{id}/eliminar', ['as' => 'propietario_cuenta.delete', 'uses' => 'PropietarioCuentaController@destroy']);

Route::post('propietario_cuenta/{id}/edit', ['as' => 'propietario_cuenta.cambio', 'uses' => 'PropietarioCuentaController@edit']);

Route::put('propietario_cuenta/{id}', ['as' => 'propietario_cuenta.update', 'uses' => 'PropietarioCuentaController@update']);

Route::get('propietario_cuenta/index', ['as' => 'propietario_cuenta.index', 'uses'=>'PropietarioCuentaController@index']);


//Cuenta

Route::get('/nueva_cuenta', function () {
    return view('/vendor/adminlte/nueva_cuenta');
});

Route::get('/modificar_cuenta', function () {
    return view('/vendor/adminlte/modificar_cuenta');
});

Route::get('cuenta','CuentaController@index');

Route::get('cuenta/index', ['as' => 'cuenta.index', 'uses'=>'CuentaController@index']);


Route::post('cuenta/crear', ['as' => 'cuenta.create', 'uses'=>'CuentaController@store']);


Route::delete('cuenta/{id}/eliminar', ['as' => 'cuenta.delete', 'uses' => 'CuentaController@destroy']);

Route::post('cuenta/{id}/edit', ['as' => 'cuenta.cambio', 'uses' => 'CuentaController@edit']);


Route::put('cuenta/{id}', ['as' => 'cuenta.update', 'uses' => 'CuentaController@update']);

//depositos

Route::get('/nuevo_deposito', function () {
    return view('/vendor/adminlte/nuevo_deposito');
});

Route::get('/reporte_diario_dep', function () {
    return view('/vendor/adminlte/reporte_deposito_diario');
});

Route::get('/reporte_mensual_dep', function () {
    return view('/vendor/adminlte/reporte_deposito_mensual');
});

Route::get('/reporte_especifico_dep', function () {
    return view('/vendor/adminlte/reporte_deposito_especifico');
});

Route::get('/modificar_deposito', function () {
    return view('/vendor/adminlte/modificar_deposito');
});

Route::get('deposito', 'DepositoController@index');


Route::get('deposito/index', ['as' => 'deposito.index', 'uses'=>'DepositoController@index']);


Route::post('deposito/crear', ['as' => 'deposito.create', 'uses'=>'DepositoController@store']);


Route::delete('deposito/{id}/eliminar', ['as' => 'deposito.delete', 'uses' => 'DepositoController@destroy']);

Route::post('deposito/{id}/edit', ['as' => 'deposito.cambio', 'uses' => 'DepositoController@edit']);


Route::put('deposito/{id}', ['as' => 'deposito.update', 'uses' => 'DepositoController@update']);


//Route::post('report_depositos', 'DepositoController@reporte');