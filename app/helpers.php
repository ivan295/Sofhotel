<?php 
use App\Dinero;
use App\Caja;
use App\Gastos;
use App\Factura_venta;
use App\Factura_compra;
use App\Deposito;
use App\Habitacion;
use App\Alquiler;
use App\Estado_habitacion;
 function obtener_dinero_disponible(){
	$d = DB::table('dineros')->orderBy('id', 'desc')->first();
	return $d;
}

//
//individual diario

function obtener_caja_individual($id){
	$caja = DB::table('cajas')->join('dineros', 'dineros.id', '=', 'cajas.id_dinero_final')->join('users', 'users.id', '=', 'cajas.id_usuario')->where('cajas.id', '=', $id)->where('users.estado', '=', 1)->select('cajas.id','cajas.numero_caja','cajas.id_usuario' ,'cajas.dinero_inicial', 'cajas.created_at', 'cajas.updated_at', 'dineros.dinero_disponible as dinero_disponible' ,'users.usuario as usuario')->first();
	return $caja;
}

function obtener_deposito_individual($fecha_inicial, $fecha_final){

	$depositos = DB::table('depositos')->join('users', 'users.id', '=', 'depositos.id_usuario')->join('cuentas', 'cuentas.id', '=', 'depositos.id_cuenta')->join('bancos', 'bancos.id', '=', 'cuentas.id_banco')->join('propietario_cuentas', 'propietario_cuentas.id', '=', 'cuentas.id_propietario')->join('tipo_cuentas', 'tipo_cuentas.id', '=', 'cuentas.id_tipo_cuenta')->where('depositos.estado', '=', 1)->where('depositos.created_at', '>=', $fecha_inicial)->where('depositos.created_at', '<=', $fecha_final)->select('depositos.id','depositos.monto', 'depositos.motivo','depositos.created_at', 'users.usuario as nombre_usuario', 'cuentas.numero_cuenta as num_cta', 'bancos.entidad as entidad', 'propietario_cuentas.nombre as nombre', 'tipo_cuentas.descripcion as tp_descripcion' ,  'propietario_cuentas.nombre as nombre', 'bancos.entidad as entidad')->orderBy('id', 'asc')->get();

	return $depositos;

}


function obtener_gasto_individual($fecha_inicial, $fecha_final){

	$gasto = DB::table('gastos')->join('users','users.id','=','gastos.id_usuario')->where('gastos.estado', '=', 1)->where('gastos.created_at', '>=', $fecha_inicial)->where('gastos.updated_at', '<=', $fecha_final)->select('gastos.*','users.usuario as user')->orderBy('id', 'asc')->get();

	return $gasto;

}

function obtener_factura_venta_individual($fecha_inicial, $fecha_final){

	$factura_venta = DB::table('factura_venta')->join('alquiler','alquiler.id','=','factura_venta.id_alquiler')->join('habitacion','habitacion.id','=','alquiler.id_habitacion')->join('users', 'users.id', '=', 'alquiler.id_usuario')->where('factura_venta.created_at','>=', $fecha_inicial )->where('factura_venta.created_at','<=', $fecha_final )->select('factura_venta.*','users.usuario as nombre_usuario','alquiler.fecha as Fecha','habitacion.numero_habitacion as habitacion','habitacion.precio as precio')
         ->orderBy('habitacion', 'asc')->get();

	return $factura_venta;

}

function obtener_factura_compra_individual($fecha_inicial, $fecha_final){

	$compra = DB::table('factura_compra')->join('proveedor', 'proveedor.id', '=', 'factura_compra.id_proveedor')->join('users', 'users.id', '=', 'factura_compra.id_usuario')->where('factura_compra.created_at','>=', $fecha_inicial )->where('factura_compra.created_at','<=', $fecha_final )->select('factura_compra.*', 'users.nombre as nombre', 'users.apellido as apellido', 'proveedor.nombres as nombre_proveedor', 'proveedor.apellidos as apellido_proveedor', 'proveedor.empresa as empresa')->orderBy('id', 'asc')->get();
	return $compra;

}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//individual especifico


function obtener_deposito_individual_especifico($id_usuario, $fecha_inicial, $fecha_final){

	$depositos = DB::table('depositos')->join('users', 'users.id', '=', 'depositos.id_usuario')->join('cuentas', 'cuentas.id', '=', 'depositos.id_cuenta')->join('bancos', 'bancos.id', '=', 'cuentas.id_banco')->join('propietario_cuentas', 'propietario_cuentas.id', '=', 'cuentas.id_propietario')->join('tipo_cuentas', 'tipo_cuentas.id', '=', 'cuentas.id_tipo_cuenta')->where('depositos.estado', '=', 1)->whereDate('depositos.created_at', '>=', $fecha_inicial)->whereDate('depositos.created_at', '<=', $fecha_final)->where('users.id', '=', $id_usuario)->select('depositos.id','depositos.monto', 'depositos.motivo','depositos.created_at', 'users.usuario as nombre_usuario', 'cuentas.numero_cuenta as num_cta', 'bancos.entidad as entidad', 'propietario_cuentas.nombre as nombre', 'tipo_cuentas.descripcion as tp_descripcion' ,  'propietario_cuentas.nombre as nombre', 'bancos.entidad as entidad')->orderBy('id', 'asc')->get();

	return $depositos;

}


function obtener_caja_individual_especifico($id_usuario, $fecha_inicial, $fecha_final){

	$caja = DB::table('cajas')->join('dineros', 'dineros.id', '=', 'cajas.id_dinero_final')->join('users', 'users.id', '=', 'cajas.id_usuario')->whereDate('cajas.created_at', '>=', $fecha_inicial)->whereDate('cajas.updated_at', '<=', $fecha_final)->where('users.id', '=', $id_usuario)->select('cajas.id','cajas.numero_caja', 'cajas.dinero_inicial', 'cajas.created_at', 'cajas.updated_at', 'dineros.dinero_disponible as dinero_disponible', 'users.usuario as usuario', 'users.nombre as nombre', 'users.apellido as apellido')->orderBy('cajas.id', 'asc')->get();

	return $caja;

}

function obtener_gasto_individual_especifico($id_usuario, $fecha_inicial, $fecha_final){

	$gasto = DB::table('gastos')->join('users','users.id','=','gastos.id_usuario')->where('gastos.estado', '=', 1)->whereDate('gastos.created_at', '>=', $fecha_inicial)->whereDate('gastos.updated_at', '<=', $fecha_final)->where('users.id', '=', $id_usuario)->select('gastos.*','users.usuario as user')->orderBy('id', 'asc')->get();

	return $gasto;

}

function obtener_factura_venta_individual_especifico($id_usuario, $fecha_inicial, $fecha_final){

	$factura_venta = DB::table('factura_venta')->join('alquiler','alquiler.id','=','factura_venta.id_alquiler')->join('habitacion','habitacion.id','=','alquiler.id_habitacion')->join('users', 'users.id', '=', 'alquiler.id_usuario')
       ->whereDate('factura_venta.created_at','>=', $fecha_inicial )->whereDate('factura_venta.created_at','<=', $fecha_final )->where('users.id', '=', $id_usuario)->select('factura_venta.*','users.usuario as nombre_usuario','alquiler.fecha as Fecha','habitacion.numero_habitacion as habitacion','habitacion.precio as precio')
         ->orderBy('habitacion', 'asc')->get();

	return $factura_venta;

}

function obtener_factura_compra_especifico($id_usuario, $fecha_inicial, $fecha_final){

	$compra = DB::table('factura_compra')->join('proveedor', 'proveedor.id', '=', 'factura_compra.id_proveedor')->join('users', 'users.id', '=', 'factura_compra.id_usuario')->whereDate('factura_compra.created_at','>=', $fecha_inicial )->whereDate('factura_compra.created_at','<=', $fecha_final )->where('users.id', '=', $id_usuario)->select('factura_compra.*', 'users.nombre as nombre', 'users.apellido as apellido', 'proveedor.nombres as nombre_proveedor', 'proveedor.apellidos as apellido_proveedor', 'proveedor.empresa as empresa')->orderBy('id', 'asc')->get();
	return $compra;

}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//individual mensual

function obtener_deposito_individual_mensual($id_usuario, $mes){

	$depositos = DB::table('depositos')->join('users', 'users.id', '=', 'depositos.id_usuario')->join('cuentas', 'cuentas.id', '=', 'depositos.id_cuenta')->join('bancos', 'bancos.id', '=', 'cuentas.id_banco')->join('propietario_cuentas', 'propietario_cuentas.id', '=', 'cuentas.id_propietario')->join('tipo_cuentas', 'tipo_cuentas.id', '=', 'cuentas.id_tipo_cuenta')->where('depositos.estado', '=', 1)->whereMonth('depositos.updated_at', $mes)->select('depositos.id','depositos.monto', 'depositos.motivo','depositos.created_at', 'users.usuario as nombre_usuario', 'cuentas.numero_cuenta as num_cta', 'bancos.entidad as entidad', 'propietario_cuentas.nombre as nombre', 'tipo_cuentas.descripcion as tp_descripcion' ,  'propietario_cuentas.nombre as nombre', 'bancos.entidad as entidad')->orderBy('id', 'asc')->get();

	return $depositos;

}


function obtener_caja_individual_mensual($id_usuario, $mes){

	$caja = DB::table('cajas')->join('dineros', 'dineros.id', '=', 'cajas.id_dinero_final')->join('users', 'users.id', '=', 'cajas.id_usuario')->whereMonth('cajas.updated_at', $mes)->where('users.id', '=', $id_usuario)->select('cajas.id','cajas.numero_caja', 'cajas.dinero_inicial', 'cajas.created_at', 'cajas.updated_at', 'dineros.dinero_disponible as dinero_disponible', 'users.usuario as usuario', 'users.nombre as nombre', 'users.apellido as apellido')->orderBy('cajas.id', 'asc')->get();

	return $caja;

}

function obtener_gasto_individual_mensual($id_usuario, $mes){

	$gasto = DB::table('gastos')->join('users','users.id','=','gastos.id_usuario')->where('gastos.estado', '=', 1)->whereMonth('gastos.updated_at', $mes)->where('users.id', '=', $id_usuario)->select('gastos.*','users.usuario as user')->orderBy('id', 'asc')->get();

	return $gasto;

}

function obtener_factura_venta_individual_mensual($id_usuario, $mes){

	$factura_venta = DB::table('factura_venta')->join('alquiler','alquiler.id','=','factura_venta.id_alquiler')->join('habitacion','habitacion.id','=','alquiler.id_habitacion')->join('users', 'users.id', '=', 'alquiler.id_usuario')
       ->whereMonth('factura_venta.updated_at', $mes)->where('users.id', '=', $id_usuario)->select('factura_venta.*','users.usuario as nombre_usuario','alquiler.fecha as Fecha','habitacion.numero_habitacion as habitacion','habitacion.precio as precio')
         ->orderBy('habitacion', 'asc')->get();

	return $factura_venta;

}

function obtener_factura_compra_mensual($id_usuario, $mes){

	$compra = DB::table('factura_compra')->join('proveedor', 'proveedor.id', '=', 'factura_compra.id_proveedor')->join('users', 'users.id', '=', 'factura_compra.id_usuario')->whereMonth('factura_compra.updated_at', $mes)->where('users.id', '=', $id_usuario)->select('factura_compra.*', 'users.nombre as nombre', 'users.apellido as apellido', 'proveedor.nombres as nombre_proveedor', 'proveedor.apellidos as apellido_proveedor', 'proveedor.empresa as empresa')->orderBy('id', 'asc')->get();
	return $compra;

}



////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//general diario


function obtener_caja_reporte_diario($fecha){
	$caja = DB::table('cajas')->join('dineros', 'dineros.id', '=', 'cajas.id_dinero_final')->join('users', 'users.id', '=', 'cajas.id_usuario')->whereDate('cajas.updated_at', $fecha)->select('cajas.id','cajas.numero_caja', 'cajas.dinero_inicial', 'cajas.created_at', 'cajas.updated_at', 'dineros.dinero_disponible as dinero_disponible', 'users.usuario as usuario', 'users.nombre as nombre', 'users.apellido as apellido', 'users.telefono as telefono')->orderBy('cajas.id', 'asc')->get();
	return $caja;
}

function obtener_deposito_reporte_diario($fecha){

	$depositos = DB::table('depositos')->join('users', 'users.id', '=', 'depositos.id_usuario')->join('cuentas', 'cuentas.id', '=', 'depositos.id_cuenta')->join('bancos', 'bancos.id', '=', 'cuentas.id_banco')->join('propietario_cuentas', 'propietario_cuentas.id', '=', 'cuentas.id_propietario')->join('tipo_cuentas', 'tipo_cuentas.id', '=', 'cuentas.id_tipo_cuenta')->where('depositos.estado', '=', 1)->whereDate('depositos.created_at', $fecha)->select('depositos.id','depositos.monto', 'depositos.motivo','depositos.created_at', 'users.usuario as nombre_usuario', 'cuentas.numero_cuenta as num_cta', 'bancos.entidad as entidad', 'propietario_cuentas.nombre as nombre', 'tipo_cuentas.descripcion as tp_descripcion' ,  'propietario_cuentas.nombre as nombre', 'bancos.entidad as entidad')->orderBy('id', 'asc')->get();

	return $depositos;

}

function obtener_gasto_reporte_diario($fecha){

	$gasto = DB::table('gastos')->join('users','users.id','=','gastos.id_usuario')->where('gastos.estado', '=', 1)->whereDate('gastos.created_at', $fecha)->select('gastos.*','users.usuario as user')->orderBy('id', 'asc')->get();

	return $gasto;
}

function obtener_factura_venta_reporte_diario($fecha){

	$factura_venta = DB::table('factura_venta')
       ->join('alquiler','alquiler.id','=','factura_venta.id_alquiler')
       ->join('habitacion','habitacion.id','=','alquiler.id_habitacion')->join('users', 'users.id', '=', 'alquiler.id_usuario')->join('estado_habitacion', 'estado_habitacion.id', '=' , 'habitacion.id_estado')
       ->whereDate('factura_venta.created_at', $fecha )->select('factura_venta.*','alquiler.fecha as fecha','alquiler.tiempo_alquiler as tiempo_alquiler','alquiler.numero_personas as numero_personas','users.nombre as nombre', 'users.apellido as apellido','habitacion.numero_habitacion as habitacion','habitacion.precio as precio', 'estado_habitacion.estado as estado')
         ->orderBy('habitacion', 'asc')->get();

	return $factura_venta;
}

function obtener_factura_compra_reporte_diario($fecha){

	$compra = DB::table('factura_compra')->join('proveedor', 'proveedor.id', '=', 'factura_compra.id_proveedor')->join('users', 'users.id', '=', 'factura_compra.id_usuario')->whereDate('factura_compra.created_at', $fecha )->select('factura_compra.*', 'users.nombre as nombre', 'users.apellido as apellido', 'proveedor.nombres as nombre_proveedor', 'proveedor.apellidos as apellido_proveedor', 'proveedor.empresa as empresa')->orderBy('id', 'asc')->get();
	return $compra;
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//general especifico

function obtener_deposito_reporte_especifico($fecha_inicial, $fecha_final){

	$depositos = DB::table('depositos')->join('users', 'users.id', '=', 'depositos.id_usuario')->join('cuentas', 'cuentas.id', '=', 'depositos.id_cuenta')->join('bancos', 'bancos.id', '=', 'cuentas.id_banco')->join('propietario_cuentas', 'propietario_cuentas.id', '=', 'cuentas.id_propietario')->join('tipo_cuentas', 'tipo_cuentas.id', '=', 'cuentas.id_tipo_cuenta')->where('depositos.estado', '=', 1)->whereDate('depositos.created_at', '>=', $fecha_inicial)->whereDate('depositos.created_at', '<=', $fecha_final)->select('depositos.id','depositos.monto', 'depositos.motivo','depositos.created_at', 'users.usuario as nombre_usuario', 'cuentas.numero_cuenta as num_cta', 'bancos.entidad as entidad', 'propietario_cuentas.nombre as nombre', 'tipo_cuentas.descripcion as tp_descripcion' ,  'propietario_cuentas.nombre as nombre', 'bancos.entidad as entidad')->orderBy('id', 'asc')->get();

	return $depositos;

}


function obtener_caja_reporte_especifico($fecha_inicial, $fecha_final){

	$caja = DB::table('cajas')->join('dineros', 'dineros.id', '=', 'cajas.id_dinero_final')->join('users', 'users.id', '=', 'cajas.id_usuario')->whereDate('cajas.created_at', '>=', $fecha_inicial)->whereDate('cajas.updated_at', '<=', $fecha_final)->select('cajas.id','cajas.numero_caja', 'cajas.dinero_inicial', 'cajas.created_at', 'cajas.updated_at', 'dineros.dinero_disponible as dinero_disponible', 'users.usuario as usuario')->orderBy('cajas.id', 'asc')->get();

	return $caja;

}

function obtener_gasto_reporte_especifico($fecha_inicial, $fecha_final){

	$gasto = DB::table('gastos')->join('users','users.id','=','gastos.id_usuario')->where('gastos.estado', '=', 1)->whereDate('gastos.created_at', '>=', $fecha_inicial)->whereDate('gastos.updated_at', '<=', $fecha_final)->select('gastos.*','users.usuario as user')->orderBy('id', 'asc')->get();

	return $gasto;

}

function obtener_factura_venta_reporte_especifico($fecha_inicial, $fecha_final){

	$factura_venta = DB::table('factura_venta')->join('alquiler','alquiler.id','=','factura_venta.id_alquiler')->join('habitacion','habitacion.id','=','alquiler.id_habitacion')->join('users', 'users.id', '=', 'alquiler.id_usuario')->join('estado_habitacion', 'estado_habitacion.id', '=' , 'habitacion.id_estado')
       ->whereDate('factura_venta.created_at','>=', $fecha_inicial )->whereDate('factura_venta.created_at','<=', $fecha_final )->select('factura_venta.*','alquiler.fecha as fecha','alquiler.tiempo_alquiler as tiempo_alquiler','alquiler.numero_personas as numero_personas','users.nombre as nombre', 'users.apellido as apellido','habitacion.numero_habitacion as habitacion','habitacion.precio as precio', 'estado_habitacion.estado as estado')
         ->orderBy('habitacion', 'asc')->get();

	return $factura_venta;

}

function obtener_factura_compra_reporte_especifico($fecha_inicial, $fecha_final){

	$compra = DB::table('factura_compra')->join('proveedor', 'proveedor.id', '=', 'factura_compra.id_proveedor')->join('users', 'users.id', '=', 'factura_compra.id_usuario')->whereDate('factura_compra.created_at','>=', $fecha_inicial )->whereDate('factura_compra.created_at','<=', $fecha_final )->select('factura_compra.*', 'users.nombre as nombre', 'users.apellido as apellido', 'proveedor.nombres as nombre_proveedor', 'proveedor.apellidos as apellido_proveedor', 'proveedor.empresa as empresa')->orderBy('id', 'asc')->get();
	return $compra;
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//general mensual

function obtener_caja_reporte_mensual($mes){
	$caja = DB::table('cajas')->join('dineros', 'dineros.id', '=', 'cajas.id_dinero_final')->join('users', 'users.id', '=', 'cajas.id_usuario')->whereMonth('cajas.updated_at', $mes)->select('cajas.id','cajas.numero_caja', 'cajas.dinero_inicial', 'cajas.created_at', 'cajas.updated_at', 'dineros.dinero_disponible as dinero_disponible', 'users.usuario as usuario')->orderBy('cajas.id', 'asc')->get();
	return $caja;
}

function obtener_deposito_reporte_mensual($mes){

	$depositos = DB::table('depositos')->join('users', 'users.id', '=', 'depositos.id_usuario')->join('cuentas', 'cuentas.id', '=', 'depositos.id_cuenta')->join('bancos', 'bancos.id', '=', 'cuentas.id_banco')->join('propietario_cuentas', 'propietario_cuentas.id', '=', 'cuentas.id_propietario')->join('tipo_cuentas', 'tipo_cuentas.id', '=', 'cuentas.id_tipo_cuenta')->where('depositos.estado', '=', 1)->whereMonth('depositos.created_at', $mes)->select('depositos.id','depositos.monto', 'depositos.motivo','depositos.created_at', 'users.usuario as nombre_usuario', 'cuentas.numero_cuenta as num_cta', 'bancos.entidad as entidad', 'propietario_cuentas.nombre as nombre', 'tipo_cuentas.descripcion as tp_descripcion' ,  'propietario_cuentas.nombre as nombre', 'bancos.entidad as entidad')->orderBy('id', 'asc')->get();

	return $depositos;

}

function obtener_gasto_reporte_mensual($mes){

	$gasto = DB::table('gastos')->join('users','users.id','=','gastos.id_usuario')->where('gastos.estado', '=', 1)->whereMonth('gastos.created_at', $mes)->select('gastos.*','users.usuario as user')->orderBy('id', 'asc')->get();

	return $gasto;
}

function obtener_factura_venta_reporte_mensual($mes){

	$factura_venta = DB::table('factura_venta')
       ->join('alquiler','alquiler.id','=','factura_venta.id_alquiler')
       ->join('habitacion','habitacion.id','=','alquiler.id_habitacion')->join('users', 'users.id', '=', 'alquiler.id_usuario')->join('estado_habitacion', 'estado_habitacion.id', '=' , 'habitacion.id_estado')
       ->whereMonth('factura_venta.created_at', $mes )->select('factura_venta.*','alquiler.fecha as fecha','alquiler.tiempo_alquiler as tiempo_alquiler','alquiler.numero_personas as numero_personas','users.nombre as nombre', 'users.apellido as apellido','habitacion.numero_habitacion as habitacion','habitacion.precio as precio', 'estado_habitacion.estado as estado')
         ->orderBy('habitacion', 'asc')->get();

	return $factura_venta;
}

function obtener_factura_compra_reporte_mensual($mes){

	$compra = DB::table('factura_compra')->join('proveedor', 'proveedor.id', '=', 'factura_compra.id_proveedor')->join('users', 'users.id', '=', 'factura_compra.id_usuario')->whereMonth('factura_compra.created_at', $mes )->select('factura_compra.*', 'users.nombre as nombre', 'users.apellido as apellido', 'proveedor.nombres as nombre_proveedor', 'proveedor.apellidos as apellido_proveedor', 'proveedor.empresa as empresa')->orderBy('id', 'asc')->get();
	return $compra;
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//calculos

function calcular_total_depositos($depositos){
	$total_depositos = 0;

        foreach ($depositos as $dep) {
            $total_depositos = $total_depositos + $dep->monto;
                    }
    return $total_depositos;                
}

function calcular_total_gastos($gasto){
	$total_gastos = 0;

        foreach ($gasto as $gast) {
            $total_gastos = $total_gastos + $gast->gasto_total;
        }
        return $total_gastos;

}

function calcular_total_ventas($factura_venta){
	$total_venta = 0;

        foreach ($factura_venta as $fac_venta) {
            $total_venta =  $total_venta + $fac_venta->total_cobro;
                    }
        return $total_venta;
}

function calcular_total_compras($compra){
	$total_compra = 0;

        foreach ($compra as $c) {
            $total_compra =  $total_compra + $c->total_pagar;
                    }
        return $total_compra;
}

function calcular_total_egresos($total_depositos, $total_gastos){
	$total_egresos =  $total_depositos + $total_gastos;
	return $total_egresos;
}

function calcular_total_utilidad($total_venta, $total_egresos){
	$utilidad = $total_venta  - $total_egresos;
	return $utilidad;
}

 ?>