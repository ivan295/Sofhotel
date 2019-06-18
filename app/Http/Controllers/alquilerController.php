<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Alquiler;
use Habitacion;
use User;
use Estado_habitacion;
use DB;
class alquilerController extends Controller
{
    public function index()
    {
        $NuevaH = \DB::table('habitacion')->join('estado_habitacion','estado_habitacion.id','=','habitacion.id_estado')
        ->select('habitacion.*','estado_habitacion.estado')
        ->get();
        return view('vendor.adminlte.home', compact('NuevaH'));
        //$nuevoAlquiler = DB::table('alquiler')
        //->join('users','users.id','=','alquiler.id_usuario')
        //->join('habitacion','habitacion.id','=','alquiler.id_habitacion')
    	//->select('alquiler.*','users.nombre as name','habitacion.numero_habitacion as habitacion')
    	//->orderBy('id', 'desc')
        //dd($nuevoAlquiler);
        //->get();
        //return view('vendor.adminlte.home');
        //,compact('nuevoAlquiler'));
    }

    public function store(Request $request)
    {
        $nuevoAlquiler                   = new Alquiler;
        $nuevoAlquiler->fecha = $request->fecha;
        $nuevoAlquiler->hora_ingreso_habitacion = $request->hora_ingreso;
        $nuevoAlquiler->hora_salida_habitacion = $request->hora_salida;
        $nuevoAlquiler->tiempo_alquiler = $request->tiempo_alquiler;
        $nuevoAlquiler->numero_personas = $request->numero_personas;
        $nuevoAlquiler->id_usuario = $request->id_usuario;
        $nuevoAlquiler->id_habitacion = $request->id_habitacion;
        $nuevoAlquiler->save();
        return redirect('/alquiler');
	}

}
