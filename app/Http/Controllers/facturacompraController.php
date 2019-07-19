<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Factura_Compra;
use App\DetalleCompra;
use DB;
use Proveedor;
class facturacompraController extends Controller
{
    public function index(Request $request)
    {
        $NuevaCompra = Factura_Compra::search($request->descripcion)
        ->join('proveedor','proveedor.id','=','factura_compra.id_proveedor')
        ->join('users','users.id','=','factura_compra.id_usuario')
    	->select('factura_compra.*','proveedor.empresa as Empresa','users.nombre as name')
        ->orderBy('id', 'desc')
        ->where('factura_compra.estado','=',1)
        ->paginate(10);
        return view('vendor.adminlte.facturaCompra',compact('NuevaCompra'));
    }
    	
    public function show($id){
        $Compra = DB::table('factura_compra')
        ->join('proveedor','proveedor.id','=','factura_compra.id_proveedor')
        ->join('users','users.id','=','factura_compra.id_usuario')
        ->select('factura_compra.*','proveedor.empresa as Empresa','users.nombre as name')
        ->where('factura_compra.id','=', $id)
        ->first();

        $Detalle = DB::table('detalle_compra')
        ->join('producto','producto.id','=','detalle_compra.id_producto')
        ->select('detalle_compra.*','producto.descripcion as producto')
        ->where('detalle_compra.id_factura','=', $id)
        ->get();
        //dd($NuevaCompra,$Detalle);
        return view('vendor.adminlte.detallescompra',compact('Compra','Detalle'));

    }

	public function destroy($id)
    {
        $factura = Factura_Compra::findOrFail($id);
        $factura->estado = '0';
        $factura->update();
        return redirect('/factura_compra');        
    }

}
