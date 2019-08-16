<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Factura_venta;
use DB;
use App\DetalleVenta;
use App\Alquiler;
use App\Dinero;
class detalleVentaController extends Controller
{
    public function index(){
        // dd([$arreglo]);
        
        // $Alquiler = DB::table('alquiler')
        // ->join('habitacion','habitacion.id','=','alquiler.id_habitacion')
        // ->where('alquiler.auxiliar','=',$auxiliar)
        // ->where('alquiler.id_habitacion','=',$id)
        // ->select('alquiler.*','habitacion.numero_habitacion as habitacion','habitacion.precio as Precio')
        // ->first();
        //dd('asdasdasdasdhasgdha');
    $Alquiler = DB::table('alquiler')
    ->join('habitacion','habitacion.id','=','alquiler.auxiliar2')
    ->where('alquiler.auxiliar','=', 0)
    ->where('alquiler.auxiliar2', '>', 0)
    ->select('alquiler.*','habitacion.numero_habitacion as habitacion','habitacion.precio as Precio')
    ->first();
    //dd($Alquiler);
    $salida = Alquiler::find($Alquiler->id);
            $salida->auxiliar2 = '0';      
            $salida->update();
    return view('vendor.adminlte.detalleVenta',compact('Alquiler'));
    // ->get(); 
    // $habitacion =DB::table('habitacion')
    // ->where('habitacion.id','=',$Alquiler->id_habitacion)
    // ->first();
    // dd([$Alquiler,$habitacion]);
    }

    public function store(Request $request){
         
            $d = DB::table('dineros')->orderBy('id', 'desc')->first();
            $dinero = Dinero::find($d->id);

    		$factura = new Factura_venta;
    		$factura->total_productos = $request->total_venta;
    		$factura->total_cobro = $request->total_c;
            $factura->id_alquiler = $request->id_alquiler;
            $factura->total_alquiler = 12.50;
            //$factura->id_usuario = $request->id_usuario;
            $factura->estado = 1;

            $contador = $dinero->dinero_disponible + $request->total_c;
            $dinero->dinero_disponible = $contador;
            $dinero->update();
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
             return redirect('/home');
        }
    }
