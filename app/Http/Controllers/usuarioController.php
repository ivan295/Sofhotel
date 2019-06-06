<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuario;
use App\TipoUsuario;
use DB;
class usuarioController extends Controller
{
    public function index()
    {  
    	$Nuevousuario = DB::table('usuario')
    	->join('tipousuario','tipousuario.id','=','usuario.idtipoUsuario')
    	->select('usuario.*','tipousuario.descripcion as TipoUser')
    	->get();
        //dd($Nuevousuario);
        return view('vendor.adminlte.nuevousuario',compact('Nuevousuario'));
    }

    public function store(Request $request)
    {
         //dd($request->all());
        $Nuevousuario                   = new Usuario;
        $Nuevousuario->nombre = $request->nombre;
        $Nuevousuario->apellido = $request->apellido;
        $Nuevousuario->cedula = $request->cedula;
        $Nuevousuario->usuario = $request->usuario;
        $Nuevousuario->password = $request->password;
        $Nuevousuario->direccion = $request->direccion;
        $Nuevousuario->telefono = $request->telefono;
        $Nuevousuario->idtipoUsuario = $request->idtipouser;
        $Nuevousuario->save();
        return redirect('/nuevouser');
    }

    public function destroy($id)
    {
        Usuario::destroy($id);
        return redirect('/nuevouser');        
    }

    public function edit($id)
    {
        $Nuevousuario = Usuario::find($id);
        return view('vendor.adminlte.editusuario', compact('Nuevousuario'));
    }

    public function update(Request $request, $id)
    {
        $Nuevousuario = Usuario::find($id);
        $Nuevousuario->nombre = $request->nombre;
        $Nuevousuario->apellido = $request->apellido;
        $Nuevousuario->cedula = $request->cedula;
        $Nuevousuario->usuario = $request->usuario;
        $Nuevousuario->password = $request->password;
        $Nuevousuario->direccion = $request->direccion;
        $Nuevousuario->telefono = $request->telefono;
        $Nuevousuario->idtipoUsuario = $request->idtipouser;
        $Nuevousuario->save();
        return redirect('/nuevouser');
    }
}
