<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Estado;
use DB;
use Habitacion;
class estadoController extends Controller
{

    public function mostrar(){
        $userall = DB::table('estados')->get();
        return response()->json($userall);
    }



     public function add($t){
    	$dato = new Estado;
    	$dato->contador = $t;
    	$dato->save();
    	dd($t);
    	//dd($dato->contador);

    }

    public function mod($t){
    	$cont = DB::table('estados')->get();
    	foreach ($cont as $c) {
    	}
    	$data = Estado::Find($c->id);
    	$data->contador = $t;
    	$data->save();
    	dd($t);

    }

    public function actualizar(Request $request){

        
    	$mensaje = $request->campo;
 		$sock = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);

    	$len = strlen($mensaje);

   		socket_sendto($sock, $mensaje, $len, 0, '192.168.0.108', 8888);
    	socket_close($sock);
    	return view('vendor.adminlte.iniciarestado');
    	//dd($mensaje);
    }
}
