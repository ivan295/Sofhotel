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
        // $NuevaH = \DB::table('habitacion')->join('estado_habitacion','estado_habitacion.id','=','habitacion.id_estado')
        // ->select('habitacion.*','estado_habitacion.estado')
        // ->get();
        // return view('vendor.adminlte.home', compact('NuevaH'));

        $nuevoAlquiler = DB::table('alquiler')
        ->join('users','users.id','=','alquiler.id_usuario')
        ->join('habitacion','habitacion.id','=','alquiler.id_habitacion')
    	->select('alquiler.*','users.nombre as name','habitacion.numero_habitacion as habitacion')
    	->orderBy('id', 'desc')
        //dd($nuevoAlquiler);
        ->paginate(10);
        return view('vendor.adminlte.Alquiler',compact('nuevoAlquiler'));
    }

    public function store(Request $request)
    {
        //dd($request->all());
        if($request->ajax()){
            $nuevoAlquiler = new Alquiler;
            $nuevoAlquiler->fecha = $request->ingreso;
            $nuevoAlquiler->hora_ingreso_habitacion = $request->hora;
            $nuevoAlquiler->hora_salida_habitacion = $request->hora;;
            $nuevoAlquiler->tiempo_alquiler = "12:45:00";
            $nuevoAlquiler->numero_personas = 2;
            $nuevoAlquiler->id_usuario = 1;
            $nuevoAlquiler->id_habitacion = $request->id;
            $nuevoAlquiler->estado=1;
            $nuevoAlquiler->save();
        }
        
        return redirect('/alquiler');
	}

}
