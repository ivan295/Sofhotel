<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Collection;
use Response;
use App\DetalleCompra;
use App\Dinero;
use DB;
use App\Factura_Compra;
use App\Productos;
class detalleCompraController extends Controller
{
    public function index()
    {
        
        return view('vendor.adminlte.detalleCompra');
    }

    public function store(Request $request)
    {    
            $d = DB::table('dineros')->orderBy('id', 'desc')->first();
            $dinero = Dinero::find($d->id);

    		$factura = new Factura_Compra;
    		$factura->id_proveedor = $request->id_proveedor;
    		$factura->descripcion = $request->cdescripcion;
            $factura->total_pagar = $request->total_pagar;
            $factura->id_usuario = $request->id_usuario;
            $factura->estado = 1;

            $contador = $dinero->dinero_disponible - $request->total_pagar;
            $dinero->dinero_disponible = $contador;
                
            $dinero->update();
            $factura->save();

             $cont = 0;
    		 while($cont < count($request->productoid))
    		 {
                $produc = Productos::find($request->productoid[$cont]);

    		 	$detalle = new DetalleCompra;
    		 	$detalle->id_factura = $factura->id;//$factura->id  factura que recien se guardó
    		 	$detalle->id_producto = $request->productoid[$cont];//id_articulo  posición cero
                $detalle->cantidad = $request->cant[$cont];
                $detalle->precio_compra = $request->precioco[$cont];
                $detalle->subtotal = $request->precioco[$cont]*$request->cant[$cont];
                $detalle->total = 0;
                $produc->stock = $produc->stock + $request->cant[$cont];
                $detalle->save();
                $produc->save();
                $cont = $cont + 1;
             }
             return redirect('/detalle_compra');
        }



}
