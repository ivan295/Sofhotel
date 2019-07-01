<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoUsuario;
use DB;
class tipousuarioController extends Controller
{
	public function index(Request $request)
    {
        $Nuevotipouser = TipoUsuario::search($request->tipo)
        ->orderBy('id', 'desc')
        ->paginate(10);
        return view('vendor.adminlte.tipousuario',compact('Nuevotipouser'));
    }

    public function store(Request $request)
    {
         $request->validate([
            'descripcion' => 'required',
            ]);

         //dd($request->all());
        $Nuevotipouser                    = new TipoUsuario;
        $Nuevotipouser->descripcion = $request->descripcion;
        $Nuevotipouser->save();
        return redirect('/tipouser')->with('success','Tipo de usuario agregado correctamente');
    }


    public function destroy($id)
    {
        TipoUsuario::destroy($id);
        return redirect('/tipouser');        
    }

    public function edit($id)
    {
        $tipo_usuario = TipoUsuario::find($id);
        return view('vendor.adminlte.tipousuarioedit', compact('tipo_usuario'));
    }

    public function update(Request $request, $id)
    {
        $Nuevotipouser = TipoUsuario::find($id);
        $Nuevotipouser->descripcion = $request->descripcion;
        $Nuevotipouser->save();
        return redirect('/tipouser');
    }
}
