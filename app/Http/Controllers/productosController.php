<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Productos;
use App\Proveedor;
use App\Iva;
use DB;

class productosController extends Controller
{
    public function index(Request $request)
    {
        $NuevoProducto = Productos::search($request->nombre)//llama al metodo queryscope definido en el modelo Productos
        ->join('proveedor','proveedor.id','=','producto.id_proveedor')
    	->select('producto.*','proveedor.empresa as Empresa')
        ->orderBy('id', 'desc')
        ->where('producto.estado','=',1)
        //dd($NuevaCompra);
        ->paginate(10);
        
    return view('vendor.adminlte.nuevoproducto',compact('NuevoProducto'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'descripcion' => 'required',
            'precio_venta' => 'required',
            'stock' => 'required',
            'precio_compra' => 'required',
            'id_proveedor' => 'required',
            'iva' => 'required'
            ]);

        $iva = Iva::find($request->iva);

        $nuevoproducto                   = new Productos;
        $nuevoproducto->descripcion = $request->descripcion;
        $nuevoproducto->precio_venta = $request->precio_venta;
        $nuevoproducto->stock = $request->stock;
        $nuevoproducto->precio_compra = $request->precio_compra;
        $nuevoproducto->id_proveedor = $request->id_proveedor;
        $nuevoproducto->estado= 1;
        $nuevoproducto->iva = ($iva->valor * $request->precio_compra)/100;
        $nuevoproducto->total = $nuevoproducto->iva + $nuevoproducto->precio_compra;
        $nuevoproducto->save();
       
        return redirect('/productos')->with('success','Producto agregado correctamente');

    }
    

	public function destroy($id)
    {
        $producto = Productos::findOrFail($id);
        $producto->estado = '0';
        $producto->update();
        return redirect('/productos');        
        
        
    }

   public function edit($id)
    {
        $nuevoproducto = Productos::find($id);
         return view('vendor.adminlte.editproducto', compact('nuevoproducto'));
    }

    public function update(Request $request, $id)
    {
        $iva = Iva::find($request->iva);
        $nuevoproducto = Productos::find($id);
        $nuevoproducto->descripcion = $request->descripcion;
        $nuevoproducto->precio_venta = $request->precio_venta;
        $nuevoproducto->stock = $request->stock;
        $nuevoproducto->precio_compra = $request->precio_compra;
        $nuevoproducto->id_proveedor = $request->id_proveedor;
        $nuevoproducto->iva = ($iva->valor * $request->precio_compra)/100;
        $nuevoproducto->total = $nuevoproducto->iva + $nuevoproducto->precio_compra;
        $nuevoproducto->save();
        return redirect('/productos');
    }
}
