<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoUsuario;
use DB;
class tipousuarioController extends Controller
{
	public function index()
    {
        $Nuevotipouser = DB::table('tipousuario')
        ->orderBy('id', 'desc')
        ->paginate(10);
        return view('vendor.adminlte.tipousuario',compact('Nuevotipouser'));
    }

    public function store(Request $request)
    {
         //dd($request->all());
        $Nuevotipouser                    = new TipoUsuario;
        $Nuevotipouser->descripcion = $request->descripcion;
        if ($Nuevotipouser->save()) {
            return back()->with('msj','Datos guardados correctamente');
        }else{
                return back()->with('msjerror');
        }
        //$Nuevotipouser->save();
        //return redirect('/tipouser');
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
