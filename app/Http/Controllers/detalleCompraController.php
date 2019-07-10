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
use App\Http\Requests\IngresoFormRequest;

class detalleCompraController extends Controller
{
    public function index()
    {
         $Factura = DB::table('factura_compra')
    	
         ->orderBy('id', 'desc')
        //dd($NuevaCompra);
        ->first();
        
        return view('vendor.adminlte.detalleCompra',compact('Factura'));
    }


    public function store(Request $request)
    {
        
        try {
    		DB::beginTransaction();       
    		$factura = new Factura_Compra;
    		$factura->id_proveedor = $request->get('id_proveedor');
    		$factura->descripcion = $request->get('cdescripcion');
            $factura->total_pagar = $request->get('total_pagar');
            $factura->id_usuario = $request->get('id_usuario');
            $factura->save();
        
    		//Artículos array()
    		//Tabla detalle_ingreso
    		$id_producto = $request->get('idproducto'); //array()
    		$cant = $request->get('cantidad');
    		$preciocompra = $request->get('preciocompra');

    		//Recorre los detalles de ingreso
    		$cont = 0;

    		while($cont < count($id_producto))
    		{
    			$detalle = new DetalleCompra;
    			//$ingreso->id del ingreso que recien se guardo 
    			$detalle->id_factura = $factura->id;
    			//id_articulo de la posición cero
    			$detalle->id_producto = $id_producto[$cont];
    			$detalle->cantidad = $cant[$cont];
    			$detalle->total_pagar = $preciocompra[$cont];
    		 	$detalle->save();

                $cont = $cont + 1;
            }
            DB::commit();
    	} catch (Exception $e) {
    		//Si existe algún error en la Transacción
    		DB::rollback(); //Anular los cambios en la DB
    	}

    	
        
             return redirect('/detalle_compra');
        }

           



       // public function factura(Request $request){
          //  $NuevaCompra                   = new Factura_Compra;
        //$NuevaCompra->id_proveedor = $request->get('id_proveedor');
        //$NuevaCompra->descripcion = $request->get('descripcion');
        //$NuevaCompra->total_pagar = $request->get('total_pagar');
        //$NuevaCompra->id_usuario = $request->get('id_usuario');
        //$NuevaCompra->save();
        //return redirect('/detalle_compra');        

        //}

	public function destroy($id)
    {
        DetalleCompra::destroy($id);
        return redirect('/detalle_compra');        
    }


}
