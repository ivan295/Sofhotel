<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proveedor;
use DB;
class proveedorController extends Controller
{
    public function index(Request $request)
    {
        $Nuevoproveedor = Proveedor::search($request->nombre)
        ->orderBy('id', 'desc')
        ->paginate(10);
        return view('vendor.adminlte.nuevoproveedor',compact('Nuevoproveedor'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'cedula' => 'required',
            'telefono' => 'required',
            'correo' => 'required',
            'empresa' => 'required',
            ]);

        $Nuevoproveedor                   = new Proveedor;
        $Nuevoproveedor->nombres = $request->nombre;
        $Nuevoproveedor->apellidos = $request->apellido;
        $Nuevoproveedor->cedula = $request->cedula;
        $Nuevoproveedor->telefono = $request->telefono;
        $Nuevoproveedor->correo = $request->correo;
        $Nuevoproveedor->empresa = $request->empresa;
        $Nuevoproveedor->save();
        return redirect('/proveedor')->with('success','Proveedor agregado correctamente');
	}

	public function destroy($id)
    {
        Proveedor::destroy($id);
        return redirect('/proveedor');        
    }


    public function edit($id)
    {
        $Nuevoproveedor = Proveedor::find($id);
         return view('vendor.adminlte.editproveedor', compact('Nuevoproveedor'));
    }

    public function update(Request $request, $id)
    {
        $Nuevoproveedor = Proveedor::find($id);
        $Nuevoproveedor->nombres = $request->nombre;
        $Nuevoproveedor->apellidos = $request->apellido;
        $Nuevoproveedor->cedula = $request->cedula;
        $Nuevoproveedor->telefono = $request->telefono;
        $Nuevoproveedor->correo = $request->correo;
        $Nuevoproveedor->empresa = $request->empresa;
        $Nuevoproveedor->save();
        return redirect('/proveedor');
    }
}
