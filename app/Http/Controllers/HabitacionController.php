<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Habitacion;
use DB;
use App\Estado_habitacion;
class HabitacionController extends Controller
{
   
    public function index()
    {
        $NuevaHabitacion = DB::table('habitacion')
        ->join('estado_habitacion','estado_habitacion.id','=','habitacion.id_estado')
        ->select('habitacion.*','estado_habitacion.ip_arduino as ip')
        ->orderBy('id', 'asc')
        ->where('habitacion.estado','=',1)
        ->get();
        //dd($NuevaHabitacion);        
        return view('vendor.adminlte.nuevahabitacion', compact('NuevaHabitacion'));
    }

    public function create()
    {
        //return view('vendor.adminlte.nuevahabitacion', compact('NuevaHabitacion'));
        
    }

    public function store(Request $request)
    {
        $request->validate([
            'numero_habitacion' => 'required|numeric',
            'tipo_habitacion' => 'required|alpha', //alpha valida que solo se ingresen letras
            'precio' => 'required',
            'tiempo_limpieza' => 'required',
            ]);
            //dd($request->all());
        $NuevaHabitacion                    = new Habitacion;
        $NuevaHabitacion->numero_habitacion = $request->numero_habitacion;
        $NuevaHabitacion->tipo_habitacion   = $request->tipo_habitacion;
        $NuevaHabitacion->precio            = $request->precio;
        $NuevaHabitacion->tiempo_limpieza   = $request->tiempo_limpieza;
        $NuevaHabitacion->id_estado   = $request->id_estado;
        $NuevaHabitacion->estado =1;
        $NuevaHabitacion->save();
        $tiempo = 2 * 60 * 1000000;
        $sock = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
        $len = strlen($tiempo);
        socket_sendto($sock, $tiempo, $len, 0, '192.168.0.108', 8888);
        socket_close($sock);

        return redirect('/Habitacion')->with('success','Habitacion creada correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $habit = habitacion::find($id);
        return view('vendor.adminlte.edithabitacion', compact('habit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $NuevaHabitacion = Habitacion::find($id);
        $NuevaHabitacion->numero_habitacion = $request->numero_habitacion;
        $NuevaHabitacion->tipo_habitacion = $request->tipo_habitacion;
        $NuevaHabitacion->precio = $request->precio;    
        $NuevaHabitacion->tiempo_limpieza = $request->tiempo_limpieza;
        $NuevaHabitacion->save();
        return redirect('/Habitacion');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $habitacion = Habitacion::findOrFail($id);
        $habitacion->estado = '0';
        $habitacion->update();
        return redirect('/Habitacion');
        
    }
}
