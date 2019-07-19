<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Collection;
use Response;
use App\DetalleCompra;
use DB;
use App\Factura_Compra;

class detalleCompraController extends Controller
{
    public function index()
    {
        
        return view('vendor.adminlte.detalleCompra');
    }

    public function store(Request $request)
    {    
    		$factura = new Factura_Compra;
    		$factura->id_proveedor = $request->id_proveedor;
    		$factura->descripcion = $request->cdescripcion;
            $factura->total_pagar = $request->total_pagar;
            $factura->id_usuario = $request->id_usuario;
            $factura->estado = 1;
            $factura->save();

             $cont = 0;
    		 while($cont < count($request->productoid))
    		 {
    		 	$detalle = new DetalleCompra;
    		 	$detalle->id_factura = $factura->id;//$factura->id  factura que recien se guardó
    		 	$detalle->id_producto = $request->productoid[$cont];//id_articulo de la posición cero
                $detalle->cantidad = $request->cant[$cont];
                $detalle->precio_compra = $request->precioco[$cont];
                $detalle->subtotal = $request->precioco[$cont]*$request->cant[$cont];

                $detalle->save();
        
                $cont = $cont + 1;
             }
             return redirect('/detalle_compra');
        }



}
