<?php 
use App\Dinero;
use App\Caja;
use App\Gastos;
use App\Factura_venta;
use App\Deposito;

 function obtener_dinero_disponible(){
	$d = DB::table('dineros')->orderBy('id', 'desc')->first();
	return $d;
}

//
//individual diario

function obtener_caja_individual($id){
	$caja = DB::table('cajas')->join('dineros', 'dineros.id', '=', 'cajas.id_dinero_final')->join('users', 'users.id', '=', 'cajas.id_usuario')->where('cajas.id', '=', $id)->select('cajas.id','cajas.numero_caja','cajas.id_usuario' ,'cajas.dinero_inicial', 'cajas.created_at', 'cajas.updated_at', 'dineros.dinero_disponible as dinero_disponible' ,'users.usuario as usuario')->first();
	return $caja;
}

function obtener_deposito_individual($fecha_inicial, $fecha_final){

	$depositos = DB::table('depositos')->join('users', 'users.id', '=', 'depositos.id_usuario')->join('cuentas', 'cuentas.id', '=', 'depositos.id_cuenta')->join('bancos', 'bancos.id', '=', 'cuentas.id_banco')->join('propietario_cuentas', 'propietario_cuentas.id', '=', 'cuentas.id_propietario')->join('tipo_cuentas', 'tipo_cuentas.id', '=', 'cuentas.id_tipo_cuenta')->where('depositos.created_at', '>=', $fecha_inicial)->where('depositos.created_at', '<=', $fecha_final)->select('depositos.id','depositos.monto', 'depositos.motivo','depositos.created_at', 'users.usuario as nombre_usuario', 'cuentas.numero_cuenta as num_cta', 'bancos.entidad as entidad', 'propietario_cuentas.nombre as nombre', 'tipo_cuentas.descripcion as tp_descripcion' ,  'propietario_cuentas.nombre as nombre', 'bancos.entidad as entidad')->orderBy('id', 'asc')->get();

	return $depositos;

}


function obtener_gasto_individual($fecha_inicial, $fecha_final){

	$gasto = DB::table('gastos')->join('users','users.id','=','gastos.id_usuario')->where('gastos.created_at', '>=', $fecha_inicial)->where('gastos.updated_at', '<=', $fecha_final)->select('gastos.*','users.usuario as user')->orderBy('id', 'asc')->get();

	return $gasto;

}

function obtener_facturaventa_individual($fecha_inicial, $fecha_final){

	$factura_venta = DB::table('factura_venta')->join('alquiler','alquiler.id','=','factura_venta.id_alquiler')->join('habitacion','habitacion.id','=','alquiler.id_habitacion')->join('users', 'users.id', '=', 'alquiler.id_usuario')
       ->where('factura_venta.created_at','>=', $fecha_inicial )->where('factura_venta.created_at','<=', $fecha_final )->select('factura_venta.*','users.usuario as nombre_usuario','alquiler.fecha as Fecha','habitacion.numero_habitacion as habitacion','habitacion.precio as precio')
         ->orderBy('id', 'asc')->get();

	return $factura_venta;

}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//individual especifico


function obtener_deposito_individual_especifico($id_usuario, $fecha_inicial, $fecha_final){

	$depositos = DB::table('depositos')->join('users', 'users.id', '=', 'depositos.id_usuario')->join('cuentas', 'cuentas.id', '=', 'depositos.id_cuenta')->join('bancos', 'bancos.id', '=', 'cuentas.id_banco')->join('propietario_cuentas', 'propietario_cuentas.id', '=', 'cuentas.id_propietario')->join('tipo_cuentas', 'tipo_cuentas.id', '=', 'cuentas.id_tipo_cuenta')->whereDate('depositos.created_at', '>=', $fecha_inicial)->whereDate('depositos.created_at', '<=', $fecha_final)->where('users.id', '=', $id_usuario)->select('depositos.id','depositos.monto', 'depositos.motivo','depositos.created_at', 'users.usuario as nombre_usuario', 'cuentas.numero_cuenta as num_cta', 'bancos.entidad as entidad', 'propietario_cuentas.nombre as nombre', 'tipo_cuentas.descripcion as tp_descripcion' ,  'propietario_cuentas.nombre as nombre', 'bancos.entidad as entidad')->orderBy('id', 'asc')->get();

	return $depositos;

}


function obtener_caja_individual_especifico($id_usuario, $fecha_inicial, $fecha_final){

	$caja = DB::table('cajas')->join('dineros', 'dineros.id', '=', 'cajas.id_dinero_final')->join('users', 'users.id', '=', 'cajas.id_usuario')->whereDate('cajas.created_at', '>=', $fecha_inicial)->whereDate('cajas.updated_at', '<=', $fecha_final)->where('users.id', '=', $id_usuario)->select('cajas.id','cajas.numero_caja', 'cajas.dinero_inicial', 'cajas.created_at', 'cajas.updated_at', 'dineros.dinero_disponible as dinero_disponible', 'users.usuario as usuario', 'users.nombre as nombre', 'users.apellido as apellido')->orderBy('cajas.id', 'asc')->get();

	return $caja;

}

function obtener_gasto_individual_especifico($id_usuario, $fecha_inicial, $fecha_final){

	$gasto = DB::table('gastos')->join('users','users.id','=','gastos.id_usuario')->whereDate('gastos.created_at', '>=', $fecha_inicial)->whereDate('gastos.updated_at', '<=', $fecha_final)->where('users.id', '=', $id_usuario)->select('gastos.*','users.usuario as user')->orderBy('id', 'asc')->get();

	return $gasto;

}

function obtener_facturaventa_individual_especifico($id_usuario, $fecha_inicial, $fecha_final){

	$factura_venta = DB::table('factura_venta')->join('alquiler','alquiler.id','=','factura_venta.id_alquiler')->join('habitacion','habitacion.id','=','alquiler.id_habitacion')->join('users', 'users.id', '=', 'alquiler.id_usuario')
       ->whereDate('factura_venta.created_at','>=', $fecha_inicial )->whereDate('factura_venta.created_at','<=', $fecha_final )->where('users.id', '=', $id_usuario)->select('factura_venta.*','users.usuario as nombre_usuario','alquiler.fecha as Fecha','habitacion.numero_habitacion as habitacion','habitacion.precio as precio')
         ->orderBy('id', 'asc')->get();

	return $factura_venta;

}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//individual mensual

function obtener_deposito_individual_mensual($id_usuario, $mes){

	$depositos = DB::table('depositos')->join('users', 'users.id', '=', 'depositos.id_usuario')->join('cuentas', 'cuentas.id', '=', 'depositos.id_cuenta')->join('bancos', 'bancos.id', '=', 'cuentas.id_banco')->join('propietario_cuentas', 'propietario_cuentas.id', '=', 'cuentas.id_propietario')->join('tipo_cuentas', 'tipo_cuentas.id', '=', 'cuentas.id_tipo_cuenta')->whereMonth('depositos.updated_at', $mes)->select('depositos.id','depositos.monto', 'depositos.motivo','depositos.created_at', 'users.usuario as nombre_usuario', 'cuentas.numero_cuenta as num_cta', 'bancos.entidad as entidad', 'propietario_cuentas.nombre as nombre', 'tipo_cuentas.descripcion as tp_descripcion' ,  'propietario_cuentas.nombre as nombre', 'bancos.entidad as entidad')->orderBy('id', 'asc')->get();

	return $depositos;

}


function obtener_caja_individual_mensual($id_usuario, $mes){

	$caja = DB::table('cajas')->join('dineros', 'dineros.id', '=', 'cajas.id_dinero_final')->join('users', 'users.id', '=', 'cajas.id_usuario')->whereMonth('cajas.updated_at', $mes)->where('users.id', '=', $id_usuario)->select('cajas.id','cajas.numero_caja', 'cajas.dinero_inicial', 'cajas.created_at', 'cajas.updated_at', 'dineros.dinero_disponible as dinero_disponible', 'users.usuario as usuario', 'users.nombre as nombre', 'users.apellido as apellido')->orderBy('cajas.id', 'asc')->get();

	return $caja;

}

function obtener_gasto_individual_mensual($id_usuario, $mes){

	$gasto = DB::table('gastos')->join('users','users.id','=','gastos.id_usuario')->whereMonth('gastos.updated_at', $mes)->where('users.id', '=', $id_usuario)->select('gastos.*','users.usuario as user')->orderBy('id', 'asc')->get();

	return $gasto;

}

function obtener_facturaventa_individual_mensual($id_usuario, $mes){

	$factura_venta = DB::table('factura_venta')->join('alquiler','alquiler.id','=','factura_venta.id_alquiler')->join('habitacion','habitacion.id','=','alquiler.id_habitacion')->join('users', 'users.id', '=', 'alquiler.id_usuario')
       ->whereMonth('factura_venta.updated_at', $mes)->where('users.id', '=', $id_usuario)->select('factura_venta.*','users.usuario as nombre_usuario','alquiler.fecha as Fecha','habitacion.numero_habitacion as habitacion','habitacion.precio as precio')
         ->orderBy('id', 'asc')->get();

	return $factura_venta;

}



////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//general diario


function obtener_caja_reporte_diario($fecha){
	$caja = DB::table('cajas')->join('dineros', 'dineros.id', '=', 'cajas.id_dinero_final')->join('users', 'users.id', '=', 'cajas.id_usuario')->whereDate('cajas.updated_at', $fecha)->select('cajas.id','cajas.numero_caja', 'cajas.dinero_inicial', 'cajas.created_at', 'cajas.updated_at', 'dineros.dinero_disponible as dinero_disponible', 'users.usuario as usuario', 'users.nombre as nombre', 'users.apellido as apellido', 'users.telefono as telefono')->orderBy('cajas.id', 'asc')->get();
	return $caja;
}

function obtener_deposito_reporte_diario($fecha){

	$depositos = DB::table('depositos')->join('users', 'users.id', '=', 'depositos.id_usuario')->join('cuentas', 'cuentas.id', '=', 'depositos.id_cuenta')->join('bancos', 'bancos.id', '=', 'cuentas.id_banco')->join('propietario_cuentas', 'propietario_cuentas.id', '=', 'cuentas.id_propietario')->join('tipo_cuentas', 'tipo_cuentas.id', '=', 'cuentas.id_tipo_cuenta')->whereDate('depositos.created_at', $fecha)->select('depositos.id','depositos.monto', 'depositos.motivo','depositos.created_at', 'users.usuario as nombre_usuario', 'cuentas.numero_cuenta as num_cta', 'bancos.entidad as entidad', 'propietario_cuentas.nombre as nombre', 'tipo_cuentas.descripcion as tp_descripcion' ,  'propietario_cuentas.nombre as nombre', 'bancos.entidad as entidad')->orderBy('id', 'asc')->get();

	return $depositos;

}

function obtener_gasto_reporte_diario($fecha){

	$gasto = DB::table('gastos')->join('users','users.id','=','gastos.id_usuario')->whereDate('gastos.created_at', $fecha)->select('gastos.*','users.usuario as user')->orderBy('id', 'asc')->get();

	return $gasto;
}

function obtener_facturaventa_reporte_diario($fecha){

	$factura_venta = DB::table('factura_venta')
       ->join('alquiler','alquiler.id','=','factura_venta.id_alquiler')
       ->join('habitacion','habitacion.id','=','alquiler.id_habitacion')->join('users', 'users.id', '=', 'alquiler.id_usuario')
       ->whereDate('factura_venta.created_at', $fecha )->select('factura_venta.*','alquiler.fecha as Fecha','users.usuario as nombre_usuario','habitacion.numero_habitacion as habitacion','habitacion.precio as precio')
         ->orderBy('id', 'asc')->get();

	return $factura_venta;
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//general especifico

function obtener_deposito_reporte_especifico($fecha_inicial, $fecha_final){

	$depositos = DB::table('depositos')->join('users', 'users.id', '=', 'depositos.id_usuario')->join('cuentas', 'cuentas.id', '=', 'depositos.id_cuenta')->join('bancos', 'bancos.id', '=', 'cuentas.id_banco')->join('propietario_cuentas', 'propietario_cuentas.id', '=', 'cuentas.id_propietario')->join('tipo_cuentas', 'tipo_cuentas.id', '=', 'cuentas.id_tipo_cuenta')->whereDate('depositos.created_at', '>=', $fecha_inicial)->whereDate('depositos.created_at', '<=', $fecha_final)->select('depositos.id','depositos.monto', 'depositos.motivo','depositos.created_at', 'users.usuario as nombre_usuario', 'cuentas.numero_cuenta as num_cta', 'bancos.entidad as entidad', 'propietario_cuentas.nombre as nombre', 'tipo_cuentas.descripcion as tp_descripcion' ,  'propietario_cuentas.nombre as nombre', 'bancos.entidad as entidad')->orderBy('id', 'asc')->get();

	return $depositos;

}


function obtener_caja_reporte_especifico($fecha_inicial, $fecha_final){

	$caja = DB::table('cajas')->join('dineros', 'dineros.id', '=', 'cajas.id_dinero_final')->join('users', 'users.id', '=', 'cajas.id_usuario')->whereDate('cajas.created_at', '>=', $fecha_inicial)->whereDate('cajas.updated_at', '<=', $fecha_final)->select('cajas.id','cajas.numero_caja', 'cajas.dinero_inicial', 'cajas.created_at', 'cajas.updated_at', 'dineros.dinero_disponible as dinero_disponible', 'users.usuario as usuario')->orderBy('cajas.id', 'asc')->get();

	return $caja;

}

function obtener_gasto_reporte_especifico($fecha_inicial, $fecha_final){

	$gasto = DB::table('gastos')->join('users','users.id','=','gastos.id_usuario')->whereDate('gastos.created_at', '>=', $fecha_inicial)->whereDate('gastos.updated_at', '<=', $fecha_final)->select('gastos.*','users.usuario as user')->orderBy('id', 'asc')->get();

	return $gasto;

}

function obtener_facturaventa_reporte_especifico($fecha_inicial, $fecha_final){

	$factura_venta = DB::table('factura_venta')->join('alquiler','alquiler.id','=','factura_venta.id_alquiler')->join('habitacion','habitacion.id','=','alquiler.id_habitacion')->join('users', 'users.id', '=', 'alquiler.id_usuario')
       ->whereDate('factura_venta.created_at','>=', $fecha_inicial )->whereDate('factura_venta.created_at','<=', $fecha_final )->select('factura_venta.*','users.usuario as nombre_usuario','alquiler.fecha as Fecha','habitacion.numero_habitacion as habitacion','habitacion.precio as precio')
         ->orderBy('id', 'asc')->get();

	return $factura_venta;

}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//general mensual

function obtener_caja_reporte_mensual($mes){
	$caja = DB::table('cajas')->join('dineros', 'dineros.id', '=', 'cajas.id_dinero_final')->join('users', 'users.id', '=', 'cajas.id_usuario')->whereMonth('cajas.updated_at', $mes)->select('cajas.id','cajas.numero_caja', 'cajas.dinero_inicial', 'cajas.created_at', 'cajas.updated_at', 'dineros.dinero_disponible as dinero_disponible', 'users.usuario as usuario')->orderBy('cajas.id', 'asc')->get();
	return $caja;
}

function obtener_deposito_reporte_mensual($mes){

	$depositos = DB::table('depositos')->join('users', 'users.id', '=', 'depositos.id_usuario')->join('cuentas', 'cuentas.id', '=', 'depositos.id_cuenta')->join('bancos', 'bancos.id', '=', 'cuentas.id_banco')->join('propietario_cuentas', 'propietario_cuentas.id', '=', 'cuentas.id_propietario')->join('tipo_cuentas', 'tipo_cuentas.id', '=', 'cuentas.id_tipo_cuenta')->whereMonth('depositos.created_at', $mes)->select('depositos.id','depositos.monto', 'depositos.motivo','depositos.created_at', 'users.usuario as nombre_usuario', 'cuentas.numero_cuenta as num_cta', 'bancos.entidad as entidad', 'propietario_cuentas.nombre as nombre', 'tipo_cuentas.descripcion as tp_descripcion' ,  'propietario_cuentas.nombre as nombre', 'bancos.entidad as entidad')->orderBy('id', 'asc')->get();

	return $depositos;

}

function obtener_gasto_reporte_mensual($mes){

	$gasto = DB::table('gastos')->join('users','users.id','=','gastos.id_usuario')->whereMonth('gastos.created_at', $mes)->select('gastos.*','users.usuario as user')->orderBy('id', 'asc')->get();

	return $gasto;
}

function obtener_facturaventa_reporte_mensual($mes){

	$factura_venta = DB::table('factura_venta')
       ->join('alquiler','alquiler.id','=','factura_venta.id_alquiler')
       ->join('habitacion','habitacion.id','=','alquiler.id_habitacion')->join('users', 'users.id', '=', 'alquiler.id_usuario')
       ->whereMonth('factura_venta.created_at', $mes )->select('factura_venta.*','users.usuario as nombre_usuario','alquiler.fecha as Fecha','habitacion.numero_habitacion as habitacion','habitacion.precio as precio')
         ->orderBy('id', 'asc')->get();

	return $factura_venta;
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

function calcular_total_egresos($total_depositos, $total_gastos){
	$total_egresos =  $total_depositos + $total_gastos;
	return $total_egresos;
}

function calcular_total_utilidad($total_venta, $total_egresos){
	$utilidad = $total_venta  - $total_egresos;
	return $utilidad;
}

 ?>