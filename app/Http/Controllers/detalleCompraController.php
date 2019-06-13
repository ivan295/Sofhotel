<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DetalleCompra;
use DB;
use Productos;
use Factura_Compra;
class detalleCompraController extends Controller
{
    public function index()
    {
        $DetalleCompra = DB::table('detalle_compra')
        ->join('producto','producto.id','=','detalle_compra.id_producto')
        ->join('factura_compra','factura_compra.id','=','detalle_compra.id_factura')
    	->select('detalle_compra.*','producto.descripcion as Descripcion','factura_compra.descripcion as Descripcion_fact')
    	
        ->orderBy('id', 'desc')
        //dd($NuevaCompra);
        ->get();
        return view('vendor.adminlte.detalleCompra',compact('DetalleCompra'));
    }

    public function store(Request $request)
    {
        $DetalleCompra                   = new DetalleCompra;
        $DetalleCompra->cantidad = $request->cantidad;
        $DetalleCompra->total_compra = $request->total_compra;
        $DetalleCompra->id_factura = $request->id_factura;
        $DetalleCompra->id_producto = $request->id_producto;
        $DetalleCompra->save();
        return redirect('/detalle_compra');
	}

	public function destroy($id)
    {
        DetalleCompra::destroy($id);
        return redirect('/detalle_compra');        
    }

    public function filtroProductos($request=''){
        $detalles = DetalleCompra::with(['producto','factura_compra'])->get();
        //dd($detalles);
        //return response()->json($detalles);
        foreach ($detalles as $d => $item) {
            if ($item->producto->descripcion != $request && $request!='') {
                unset($detalles[$d]);                        
            }
            // foreach ($item->producto as $p => $producto) {
            //     if ($producto->descripcion != $request) {
            //         unset($item->producto[$p]);                        
            //     }
            // }
        }
        return response()->json($detalles);

        //$productos = DetalleCompra::with(['producto'=>function($query){
        //     $query
        // },'factura_compra']) where('descripcion','like',%$response%)->get();
        // return response()->json($productos);

    }

}
