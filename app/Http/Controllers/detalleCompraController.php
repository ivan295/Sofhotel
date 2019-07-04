<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DetalleCompra;
use DB;
use App\Productos;
use App\Factura_Compra;

class detalleCompraController extends Controller
{
    public function index(Request $request)
    {
         $Producto = DB::table('detalle_compra')
        ->join('producto','producto.id','=','detalle_compra.id_producto')
        ->join('factura_compra','factura_compra.id','=','detalle_compra.id_factura')
    	 ->select('detalle_compra.*','factura_compra.descripcion as Descripcion_fact')
    	
         ->orderBy('id', 'desc')
        //dd($NuevaCompra);
        ->paginate(10);
        return view('vendor.adminlte.detalleCompra',compact('Producto'));
    }

    public function store(Request $request)
    {
        //dd($request);
        // $DetalleCompra                   = new DetalleCompra;
        // $DetalleCompra->cantidad = $request->cantidad;
        // $DetalleCompra->total_compra = $request->total_compra;
        // $DetalleCompra->id_factura = $request->id_factura;
        // $DetalleCompra->id_producto = $request->id_producto;
        // $DetalleCompra->save();
        // return redirect('/detalle_compra');
        try{
            DB::beginTransaction();
 
            $compra = new Factura_Compra();
            $compra->descripcion = $request->descripcion;
        
            $compra->id_proveedor = $request->id_proveedor;
            $compra->id_usuario = \Auth::user()->id;
            $compra->save();
 
            $detalles = $request->data;//Array de detalles
            //Recorro todos los elementos
 
            foreach($detalles as $det)
            {
                $detalle = new DetalleCompra();
                $detalle->id_factura = $compra->id;
                $detalle->id_producto = $det->id_producto;
                $detalle->cantidad = $det->cantidad;
                $detalle->precio_compra = $det->precio_compra;      
                $detalle->precio_venta = $det->precio_venta;   
                $detalle->total = $det->total;   
                $detalle->save();
            }          
           
        } catch (Exception $e)
            {
            DB::rollBack();
            }

}

	public function destroy($id)
    {
        DetalleCompra::destroy($id);
        return redirect('/detalle_compra');        
    }


}
