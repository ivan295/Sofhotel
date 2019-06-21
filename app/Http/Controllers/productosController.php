<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Productos;
use App\Proveedor;
use DB;
class productosController extends Controller
{
    public function index()
    {
        $NuevoProducto = DB::table('producto')
        ->join('proveedor','proveedor.id','=','producto.id_proveedor')
    	->select('producto.*','proveedor.empresa as Empresa')
        ->orderBy('id', 'desc')
        //dd($NuevaCompra);
        ->paginate(10);
    return view('vendor.adminlte.nuevoproducto',compact('NuevoProducto'));
    }

    public function store(Request $request)
    {
        $nuevoproducto                   = new Productos;
        $nuevoproducto->descripcion = $request->descripcion;
        $nuevoproducto->precio_venta = $request->precio_venta;
        $nuevoproducto->stock = $request->stock;
        $nuevoproducto->precio_compra = $request->precio_compra;
        $nuevoproducto->id_proveedor = $request->id_proveedor;
        $nuevoproducto->save();
        return redirect('/productos');
	}

	public function destroy($id)
    {
        Productos::destroy($id);
        return redirect('/productos');        
    }

   public function edit($id)
    {
        $nuevoproducto = Productos::find($id);
         return view('vendor.adminlte.editproducto', compact('nuevoproducto'));
    }

    public function update(Request $request, $id)
    {
        $nuevoproducto = Productos::find($id);
        $nuevoproducto->descripcion = $request->descripcion;
        $nuevoproducto->precio_venta = $request->precio_venta;
        $nuevoproducto->stock = $request->stock;
        $nuevoproducto->precio_compra = $request->precio_compra;
        $nuevoproducto->id_proveedor = $request->id_proveedor;
        $nuevoproducto->save();
        return redirect('/productos');
    }
}
