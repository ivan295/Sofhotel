<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Alquiler;
use App\Habitacion;
use DB;
use App\Estado_habitacion;

class alquilerController extends Controller
{
    public function index()
    {
        // $NuevaH = \DB::table('habitacion')->join('estado_habitacion','estado_habitacion.id','=','habitacion.id_estado')
        // ->select('habitacion.*','estado_habitacion.estado')
        // ->get();
        // return view('vendor.adminlte.home', compact('NuevaH'));

        $nuevoAlquiler = DB::table('alquiler')
            ->join('users', 'users.id', '=', 'alquiler.id_usuario')
            ->join('habitacion', 'habitacion.id', '=', 'alquiler.id_habitacion')
            ->select('alquiler.*', 'users.nombre as name', 'habitacion.numero_habitacion as habitacion')
            ->orderBy('id', 'desc')
            //dd($nuevoAlquiler);
            ->paginate(10);
        return view('vendor.adminlte.Alquiler', compact('nuevoAlquiler'));
    }

    public function ingreso(Request $request)
    {
        if ($request->ajax()) {
            $ingreso = new Alquiler;
            $ingreso->fecha = $request->fecha_ingreso;
            $ingreso->hora_ingreso_habitacion = $request->hora;
            $ingreso->numero_personas = '2';
            $ingreso->id_usuario = '1';
            $ingreso->id_habitacion = $request->habitacion;
            $ingreso->estado = '1';
          //  $ingreso->auxiliar2 = '0';
            $ingreso->auxiliar2 = $request->habitacion;
            $ingreso->auxiliar = $request->numero_habitacion;
            $ingreso->save();
            $habitacion = Habitacion::findOrFail($request->habitacion);
            $habitacion->indice = '1';
            $habitacion->update();
        }
       // return redirect('/alquiler');
    }
    public function store(Request $request)
    {
        //$id_alquiler = $request->auxiliar;


        // if ($request->ajax()) {

        //     $alq = DB::table('alquiler')->join('habitacion', 'habitacion.id', '=', 'alquiler.id_habitacion')
        //     ->where('habitacion.id', '=', $request->id)->select('alquiler.*')->first();
        //     $salida = Alquiler::find($alq->id);
        //     $salida->hora_salida_habitacion = $request->hora;
        //     $salida->tiempo_alquiler = "12:45:00";
        //     $salida->auxiliar = '0';
        //     $salida->update();
        //     $habitacion = Habitacion::find($request->id);
        //     $habitacion->indice = 0;
        //     $habitacion->update();
        // }
        // return redirect('/alquiler');

    }

    public function ingresar2(Request $request)
    {
        if ($request->ajax()) {
            $alq = DB::table('alquiler')
            ->join('habitacion', 'habitacion.id', '=', 'alquiler.id_habitacion')
            ->where('alquiler.auxiliar', '=', $request->auxiliar)
            ->select('alquiler.*', 'habitacion.numero_habitacion as habitacion', 'habitacion.precio as Precio', 'habitacion.id as Id', 'habitacion.iva as iva', 'habitacion.desgloce as desgloce')
            ->first();
            $salida = Alquiler::find($alq->id);
            $salida->hora_salida_habitacion = $request->hora;
            $tiempo= Date("H:i:s", strtotime("00:00:00") + strtotime($request->hora)- strtotime($salida->hora_ingreso_habitacion));//obtener la diferencia de tiempos
            $salida->tiempo_alquiler=$tiempo;
            //$salida->auxiliar2 = '0';      

            $salida->auxiliar = '0';
            $salida->update();


        //     $habitacion = Habitacion::find($request->id);
        //     $est = DB::table('estado_habitacion')->join('habitacion', 'habitacion.id_estado', '=', 'estado_habitacion.id')
        //         ->where('estado_habitacion.id', '=', $habitacion->id_estado)->select('estado_habitacion.*')->first();

        //     $estado = Estado_habitacion::find($est->id);
        //     $habitacion->indice = 0;
        //     $estado->estado = "Espera";
        // $habitacion->update();
        //     $estado->update();

        }
    }
}
