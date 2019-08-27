<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Caja;
use App\Usuario;
use App\Deposito;
use App\Gastos;
use App\Factura_venta;

class ReporteGeneralController extends Controller
{
    public function reporte_diario(Request $request){
        $date = $request->fecha;

    	$caja = obtener_caja_reporte_diario($request->fecha);
    	$depositos = obtener_deposito_reporte_diario($request->fecha);
        $gasto = obtener_gasto_reporte_diario($request->fecha);
        $factura_venta = obtener_factura_venta_reporte_diario($request->fecha);
        $compra = obtener_factura_compra_reporte_diario($request->fecha);
        $total_depositos = calcular_total_depositos($depositos);
        $total_gastos = calcular_total_gastos($gasto);
        $total_venta = calcular_total_ventas($factura_venta);
        $total_compra = calcular_total_compras($compra);
        $total_egresos = calcular_total_egresos($total_depositos, $total_gastos);
        $utilidad = calcular_total_utilidad($total_venta, $total_egresos);
        $c[] = $caja.$depositos.$gasto.$factura_venta;
        //return response()->json([$caja, $depositos, $gasto, $factura_venta]);
       // return response()->json($c);
    	//dd([$total_depositos, $total_gastos, $total_venta, $total_egresos, $utilidad]);
        $view = \View::make('vendor.adminlte.reporte_general', compact('date','caja','depositos', 'gasto', 'factura_venta', 'total_depositos', 'total_gastos', 'total_venta', 'total_egresos', 'utilidad', 'compra', 'total_compra'))->render();
          $pdf = \App::make('dompdf.wrapper');
          $pdf->loadHTML($view);
          return $pdf->stream('reporte'.'pdf');

    }

    public function reporte_diario_api($fecha){

        $caja = obtener_caja_reporte_diario($fecha);
        $depositos = obtener_deposito_reporte_diario($fecha);
        $gasto = obtener_gasto_reporte_diario($fecha);
        $factura_venta = obtener_factura_venta_reporte_diario($fecha);
        $compra = obtener_factura_compra_reporte_diario($request->fecha);
        $total_depositos = calcular_total_depositos($depositos);
        $total_gastos = calcular_total_gastos($gasto);
        $total_venta = calcular_total_ventas($factura_venta);
        $total_compra = calcular_total_compras($compra);
        $total_egresos = calcular_total_egresos($total_depositos, $total_gastos);
        $utilidad = calcular_total_utilidad($total_venta, $total_egresos);
        $c = $caja.$depositos.$gasto.$factura_venta;
        //$totales = "total_depositos:".$total_depositos. "total_gastos:".$total_gastos;
       

        $totales = [
        "totalDepositos" => "".$total_depositos,
        "totalGastos" => "".$total_gastos,
        "totalVentas" => "".$total_venta,
        "totalEgresos" => "".$total_egresos,
        "utilidad" => "".$utilidad,
        "totalCompra" => "".$total_compra,
        ];
 
        return response()->json([$caja, $depositos, $gasto, $factura_venta, $totales, $compra]);

    }

    public function reporte_especifico(Request $request){
        $date_inicial = $request->fecha_inicial;
        $date_final = $request->fecha_final;

    	$caja = obtener_caja_reporte_especifico($request->fecha_inicial,$request->fecha_final);
    	$depositos = obtener_deposito_reporte_especifico($request->fecha_inicial,$request->fecha_final);
        $gasto = obtener_gasto_reporte_especifico($request->fecha_inicial,$request->fecha_final);
        $factura_venta = obtener_factura_venta_reporte_especifico($request->fecha_inicial,$request->fecha_final);
        $compra = obtener_factura_compra_reporte_especifico($request->fecha_inicial,$request->fecha_final);
        $total_depositos = calcular_total_depositos($depositos);
        $total_gastos = calcular_total_gastos($gasto);
        $total_venta = calcular_total_ventas($factura_venta);
        $total_compra = calcular_total_compras($compra);
        $total_egresos = calcular_total_egresos($total_depositos, $total_gastos);
        $utilidad = calcular_total_utilidad($total_venta, $total_egresos);

       // dd([$caja, $depositos, $gasto, $factura_venta, $total_depositos, $total_gastos, $total_venta, $total_egresos, $utilidad]);
        $view = \View::make('vendor.adminlte.reporte_general', compact('date_inicial', 'date_final','caja','depositos', 'gasto', 'factura_venta', 'total_depositos', 'total_gastos', 'total_venta', 'total_egresos', 'utilidad', 'compra', 'total_compra'))->render();
          $pdf = \App::make('dompdf.wrapper');
          $pdf->loadHTML($view);
          return $pdf->stream('reporte'.'pdf');

    }

     public function reporte_especifico_api($fecha_inicial, $fecha_final){

        $caja = obtener_caja_reporte_especifico($fecha_inicial,$fecha_final);
        $depositos = obtener_deposito_reporte_especifico($fecha_inicial,$fecha_final);
        $gasto = obtener_gasto_reporte_especifico($fecha_inicial,$fecha_final);
        $factura_venta = obtener_factura_venta_reporte_especifico($fecha_inicial,$fecha_final);
        $compra = obtener_factura_compra_reporte_especifico($request->fecha_inicial,$request->fecha_final);
        $total_depositos = calcular_total_depositos($depositos);
        $total_gastos = calcular_total_gastos($gasto);
        $total_venta = calcular_total_ventas($factura_venta);
        $total_compra = calcular_total_compras($compra);
        $total_egresos = calcular_total_egresos($total_depositos, $total_gastos);
        $utilidad = calcular_total_utilidad($total_venta, $total_egresos);
           $totales = [
        "totalDepositos" => "".$total_depositos,
        "totalGastos" => "".$total_gastos,
        "totalVentas" => "".$total_venta,
        "totalEgresos" => "".$total_egresos,
        "utilidad" => "".$utilidad,
        "totalCompra" => "".$total_compra
        ];
 
        return response()->json([$caja, $depositos, $gasto, $factura_venta, $totales, $compra]);

    }

    public function reporte_mensual(Request $request){
    	$month = $request->mes;
        $mes_entero=strtotime($month);
        $mes = date('m', $mes_entero);

        $caja = obtener_caja_reporte_mensual($mes);
    	$depositos = obtener_deposito_reporte_mensual($mes);
        $gasto = obtener_gasto_reporte_mensual($mes);
        $factura_venta = obtener_factura_venta_reporte_mensual($mes);
    	$compra = obtener_factura_compra_reporte_mensual($mes);
        $total_depositos = calcular_total_depositos($depositos);
        $total_gastos = calcular_total_gastos($gasto);
        $total_venta = calcular_total_ventas($factura_venta);
        $total_compra = calcular_total_compras($compra);
        $total_egresos = calcular_total_egresos($total_depositos, $total_gastos);
        $utilidad = calcular_total_utilidad($total_venta, $total_egresos);

        //dd([$caja, $depositos, $gasto, $factura_venta, $total_depositos, $total_gastos, $total_venta, $total_egresos, $utilidad]);

        $view = \View::make('vendor.adminlte.reporte_general', compact('month','caja','depositos', 'gasto', 'factura_venta', 'total_depositos', 'total_gastos', 'total_venta', 'total_egresos', 'utilidad', 'compra', 'total_compra'))->render();
          $pdf = \App::make('dompdf.wrapper');
          $pdf->loadHTML($view);
          return $pdf->stream('reporte'.'pdf');
    }

    public function reporte_mensual_api($mes){
        $month = $mes;
        $mes_entero=strtotime($month);
        $mes = date('m', $mes_entero);

        $caja = obtener_caja_reporte_mensual($mes);
        $depositos = obtener_deposito_reporte_mensual($mes);
        $gasto = obtener_gasto_reporte_mensual($mes);
        $factura_venta = obtener_factura_venta_reporte_mensual($mes);
        $compra = obtener_factura_compra_reporte_mensual($mes);
        $total_depositos = calcular_total_depositos($depositos);
        $total_gastos = calcular_total_gastos($gasto);
        $total_venta = calcular_total_ventas($factura_venta);
        $total_compra = calcular_total_compras($compra);
        $total_egresos = calcular_total_egresos($total_depositos, $total_gastos);
        $utilidad = calcular_total_utilidad($total_venta, $total_egresos);

        $totales = [
        "totalDepositos" => "".$total_depositos,
        "totalGastos" => "".$total_gastos,
        "totalVentas" => "".$total_venta,
        "totalEgresos" => "".$total_egresos,
        "utilidad" => "".$utilidad,
        "totalCompra" => "".$total_compra,
        ];
 
        return response()->json([$caja,$compra ,$depositos, $gasto, $factura_venta, $totales]);

        
    }
    public function caja_usuario_dia(Request $request){
        $fecha = $request->fecha;
        $caja = obtener_caja_reporte_diario($fecha);
        return view('vendor.adminlte.reporte_usuario_diario', compact('caja', 'fecha'));
    }

       public function caja_usuario_dia_api($fecha){
        $caja = obtener_caja_reporte_diario($fecha);
        return response()->json($caja);
    }

    public function reporte_diario_usuario($id){

        $caja = obtener_caja_individual($id);
        $deposito = obtener_deposito_individual($caja->created_at, $caja->updated_at);

        $gasto = obtener_gasto_individual($caja->created_at, $caja->updated_at);
        $FacturaVenta = obtener_factura_venta_individual($caja->created_at, $caja->updated_at);
        $compra = obtener_factura_compra_individual($caja->created_at, $caja->updated_at);
        $total_depositos = calcular_total_depositos($deposito);
        $total_gastos = calcular_total_gastos($gasto);
        $total_venta = calcular_total_ventas($FacturaVenta);
        $total_compra = calcular_total_compras($compra);
        $total_egresos = calcular_total_egresos($total_depositos, $total_gastos);
        $utilidad = calcular_total_utilidad($total_venta, $total_egresos);

        $view = \View::make('vendor.adminlte.reporte_caja', compact('date','caja','deposito', 'gasto', 'FacturaVenta', 'total_depositos', 'total_gastos', 'total_venta', 'total_egresos', 'utilidad', 'compra', 'total_compra'))->render();
          $pdf = \App::make('dompdf.wrapper');
          $pdf->loadHTML($view);
          return $pdf->stream('reporte'.'pdf');
    }

    public function reporte_diario_usuario_api($id){

        $caja = obtener_caja_individual($id);
        $deposito = obtener_deposito_individual($caja->created_at, $caja->updated_at);

        $gasto = obtener_gasto_individual($caja->created_at, $caja->updated_at);
        $FacturaVenta = obtener_factura_venta_individual($caja->created_at, $caja->updated_at);
        $compra = obtener_factura_compra_individual($caja->created_at, $caja->updated_at);
        $total_depositos = calcular_total_depositos($deposito);
        $total_gastos = calcular_total_gastos($gasto);
        $total_venta = calcular_total_ventas($FacturaVenta);
        $total_compra = calcular_total_compras($compra);
        $total_egresos = calcular_total_egresos($total_depositos, $total_gastos);
        $utilidad = calcular_total_utilidad($total_venta, $total_egresos);
        $totales = [
        "totalDepositos" => "".$total_depositos,
        "totalGastos" => "".$total_gastos,
        "totalVentas" => "".$total_venta,
        "totalEgresos" => "".$total_egresos,
        "utilidad" => "".$utilidad,
        "totalCompra" => "".$total_compra,
        ];
        
          return response()->json([$caja, $deposito, $gasto, $FacturaVenta, $totales, $compra]);
    }

    public function consulta_caja_usuario_especifico(Request $request){
        $fecha_inicial = $request->fecha_inicial;
        $fecha_final = $request->fecha_final;
        $usuarios = DB::table('users')->get();
        return view('vendor.adminlte.reporte_usuario_especifico', compact('usuarios', 'fecha_inicial', 'fecha_final'));   
    }

     public function consulta_usuario_api(){
        $usuarios = DB::table('users')->get();
        return compact()->json($usuarios);
    }

    public function reporte_especifico_usuario($id, $fecha_inicial, $fecha_final){
     //   dd([$id, $fecha_inicial, $fecha_final]);
        $caja = obtener_caja_individual_especifico($id, $fecha_inicial, $fecha_final);
        $deposito = obtener_deposito_individual_especifico($id, $fecha_inicial, $fecha_final);

        $gasto = obtener_gasto_individual_especifico($id, $fecha_inicial, $fecha_final);
        $FacturaVenta = obtener_factura_venta_individual_especifico($id, $fecha_inicial, $fecha_final);
        $compra = obtener_factura_compra_individual_especifico($id, $fecha_inicial, $fecha_final);
        $total_depositos = calcular_total_depositos($deposito);
        $total_gastos = calcular_total_gastos($gasto);
        $total_venta = calcular_total_ventas($FacturaVenta);
        $total_compra = calcular_total_compras($compra);
        $total_egresos = calcular_total_egresos($total_depositos, $total_gastos);
        $utilidad = calcular_total_utilidad($total_venta, $total_egresos);
        //dd([$caja, $deposito, $gasto, $FacturaVenta]);
        $view = \View::make('vendor.adminlte.reporte_individual', compact('caja','deposito', 'gasto', 'FacturaVenta', 'total_depositos', 'total_gastos', 'total_venta', 'total_egresos', 'utilidad','fecha_inicial', 'fecha_final', 'compra', 'total_compra'))->render();
          $pdf = \App::make('dompdf.wrapper');
          $pdf->loadHTML($view);
          return $pdf->stream('reporte'.'pdf');
    }

     public function reporte_especifico_usuario_api($id, $fecha_inicial, $fecha_final){
     //   dd([$id, $fecha_inicial, $fecha_final]);
        $caja = obtener_caja_individual_especifico($id, $fecha_inicial, $fecha_final);
        $deposito = obtener_deposito_individual_especifico($id, $fecha_inicial, $fecha_final);

        $gasto = obtener_gasto_individual_especifico($id, $fecha_inicial, $fecha_final);
        $FacturaVenta = obtener_factura_venta_individual_especifico($id, $fecha_inicial, $fecha_final);
        $compra = obtener_factura_compra_individual_especifico($id, $fecha_inicial, $fecha_final);
        $total_depositos = calcular_total_depositos($deposito);
        $total_gastos = calcular_total_gastos($gasto);
        $total_venta = calcular_total_ventas($FacturaVenta);
        $total_compra = calcular_total_compras($compra);
        $total_egresos = calcular_total_egresos($total_depositos, $total_gastos);
        $utilidad = calcular_total_utilidad($total_venta, $total_egresos);

        $totales = [
        "totalDepositos" => "".$total_depositos,
        "totalGastos" => "".$total_gastos,
        "totalVentas" => "".$total_venta,
        "totalEgresos" => "".$total_egresos,
        "utilidad" => "".$utilidad,
        "totalCompra" => "".$total_compra,
        ];

        return response()->json([$caja, $compra, $deposito, $gasto, $FacturaVenta, $totales]);
    }


    public function caja_usuario_mes(Request $request){
        $month = $request->mes;
        $usuarios = DB::table('users')->get();
        return view('vendor.adminlte.reporte_usuario_mensual', compact('usuarios', 'month'));
    }


    public function reporte_mensual_usuario($id, $month){
        

        $mes_entero=strtotime($month);
        $mes = date('m', $mes_entero);

        $caja = obtener_caja_individual_mensual($id, $mes);
        $deposito = obtener_deposito_individual_mensual($id, $mes);
        $gasto = obtener_gasto_individual_mensual($id, $mes);
        $FacturaVenta = obtener_factura_venta_individual_mensual($id, $mes);
        $compra = obtener_factura_compra_individual_mensual($id, $mes);
        $total_depositos = calcular_total_depositos($deposito);
        $total_gastos = calcular_total_gastos($gasto);
        $total_venta = calcular_total_ventas($FacturaVenta);
        $total_compra = calcular_total_compras($compra);
        $total_egresos = calcular_total_egresos($total_depositos, $total_gastos);
        $utilidad = calcular_total_utilidad($total_venta, $total_egresos);
        //dd([$caja, $deposito, $gasto, $FacturaVenta]);
        $view = \View::make('vendor.adminlte.reporte_individual', compact('month','caja','deposito', 'gasto', 'FacturaVenta', 'total_depositos', 'total_gastos', 'total_venta', 'total_egresos', 'utilidad', 'compra', 'total_compra'))->render();
          $pdf = \App::make('dompdf.wrapper');
          $pdf->loadHTML($view);
          return $pdf->stream('reporte'.'pdf');
    }

    public function reporte_mensual_usuario_api($id, $month){
        

        $mes_entero=strtotime($month);
        $mes = date('m', $mes_entero);

        $caja = obtener_caja_individual_mensual($id, $mes);
        $deposito = obtener_deposito_individual_mensual($id, $mes);
        $gasto = obtener_gasto_individual_mensual($id, $mes);
        $FacturaVenta = obtener_factura_venta_individual_mensual($id, $mes);
        $compra = obtener_factura_compra_individual_mensual($id, $mes);
        $total_depositos = calcular_total_depositos($deposito);
        $total_gastos = calcular_total_gastos($gasto);
        $total_venta = calcular_total_ventas($FacturaVenta);
        $total_compra = calcular_total_compras($compra);
        $total_egresos = calcular_total_egresos($total_depositos, $total_gastos);
        $utilidad = calcular_total_utilidad($total_venta, $total_egresos);


        $totales = [
        "totalDepositos" => "".$total_depositos,
        "totalGastos" => "".$total_gastos,
        "totalVentas" => "".$total_venta,
        "totalEgresos" => "".$total_egresos,
        "utilidad" => "".$utilidad,
        "totalCompra" => "".$total_compra,
        ];
       
       return response()->json([$caja,$compra , $deposito, $gasto, $FacturaVenta, $totales]);
    }
}
