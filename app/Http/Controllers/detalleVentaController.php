<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Factura_venta;
use DB;
use App\DetalleVenta;

class detalleVentaController extends Controller
{
    public function index()
    {
    $Alquiler = DB::table('alquiler')
    ->join('habitacion','habitacion.id','=','alquiler.id_habitacion')
    ->select('alquiler.*','habitacion.numero_habitacion as habitacion','habitacion.precio as Precio')
      ->orderBy('id', 'desc')
      ->first();
         //dd($FacturaVenta);

    return view('vendor.adminlte.detalleVenta',compact('Alquiler'));
    //, compact('habitacion','producto'));
    }

    public function store(Request $request){
         
    		$factura = new Factura_venta;
    		$factura->total_productos = $request->total_venta;
    		$factura->total_cobro = $request->total_c;
            $factura->id_alquiler = $request->id_alquiler;
            //$factura->id_usuario = $request->id_usuario;
            $factura->estado = 1;
            $factura->save();

             $cont = 0;
    		 while($cont < count($request->productoid))
    		 {
    		 	$detalle = new DetalleVenta;
    		 	$detalle->id_factura_venta = $factura->id;//$factura->id  factura que recien se guardó
    		 	$detalle->id_producto = $request->productoid[$cont];//id_articulo de la posición cero
                $detalle->cantidad = $request->cantidad[$cont];
                $detalle->total_venta = $request->precioventa[$cont]*$request->cant[$cont];

                $detalle->save();
        
                $cont = $cont + 1;
             }
             return redirect('/detalle_venta');
        }
    }

