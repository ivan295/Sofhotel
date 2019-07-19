<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Usuario;
use App\TipoUsuario;
use DB;
class usuarioController extends Controller
{
    public function index(Request $request)
    {  
    	$Nuevousuario = Usuario::search($request->nombre)
    	->join('tipousuario','tipousuario.id','=','users.idtipoUsuario')
    	->select('users.*','tipousuario.descripcion as TipoUser')
        ->orderBy('id', 'desc')
        ->where('users.estado','=',1)
        ->paginate(10);
        //return response()->json($Nuevousuario);
        //dd($Nuevousuario);
        return view('vendor.adminlte.nuevousuario',compact('Nuevousuario'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'cedula' => 'required',
            'usuario' => 'required',
            'password' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
            'idtipouser' => 'required',
            'usuario' => 'required',
            ]);
         //dd($request->all());
        $Nuevousuario                   = new User;
        $Nuevousuario->nombre = $request->nombre;
        $Nuevousuario->apellido = $request->apellido;
        $Nuevousuario->cedula = $request->cedula;
        $Nuevousuario->usuario = $request->usuario;
        $Nuevousuario->password = bcrypt($request->password);
        $Nuevousuario->direccion = $request->direccion;
        $Nuevousuario->telefono = $request->telefono;
        $Nuevousuario->idtipoUsuario = $request->idtipouser;
        $Nuevousuario->email = $request->usuario.'@sistema.com';
        $Nuevousuario->estado = 1;

        $Nuevousuario->save();
        return redirect('/nuevouser')->with('success','Usuario agregado correctamente');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->estado = '0';
        $user->update();
        return redirect('/nuevouser');        
    }

    public function edit($id)
    {
        $Nuevousuario = User::find($id);
         return view('vendor.adminlte.editusuario', compact('Nuevousuario'));
    }

    public function update(Request $request, $id)
    {
        $Nuevousuario = User::find($id);
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
