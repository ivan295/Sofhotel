<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Factura_Compra;
use DB;
use Proveedor;
class facturacompraController extends Controller
{
    public function index()
    {
        $NuevaCompra = DB::table('factura_compra')
        ->join('proveedor','proveedor.id','=','factura_compra.id_proveedor')
        ->join('users','users.id','=','factura_compra.id_usuario')
    	->select('factura_compra.*','proveedor.empresa as Empresa','users.nombre as name')
        ->orderBy('id', 'desc')
        //dd($NuevaCompra);
        ->get();
        return view('vendor.adminlte.facturaCompra',compact('NuevaCompra'));
    }
    	public function store(Request $request)
    {
        $NuevaCompra                   = new Factura_Compra;
        $NuevaCompra->descripcion = $request->descripcion;
        $NuevaCompra->total_pagar = $request->total_pagar;
        $NuevaCompra->id_proveedor = $request->id_proveedor;
        $NuevaCompra->id_usuario = $request->id_usuario;
        $NuevaCompra->save();
        return redirect('/factura_compra');
	}

	public function destroy($id)
    {
        Factura_Compra::destroy($id);
        return redirect('/factura_compra');        
    }

}
