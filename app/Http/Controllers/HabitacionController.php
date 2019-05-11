<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Habitacion;
class HabitacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $NuevaHabitacion = \DB::table('habitacion')->get();
        return view('vendor.adminlte.nuevahabitacion', compact('NuevaHabitacion'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return view('vendor.adminlte.nuevahabitacion', compact('NuevaHabitacion'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         //dd($request->all());
        $NuevaHabitacion                    = new Habitacion;
        $NuevaHabitacion->numero_habitacion = $request->input('numero_habitacion');
        $NuevaHabitacion->tipo_habitacion   = $request->input('tipo_habitacion');
        $NuevaHabitacion->precio            = $request->input('precio');
        $NuevaHabitacion->tiempo_limpieza   = $request->input('tiempo_limpieza');
        $NuevaHabitacion->ip_arduino        = $request->input('ip_arduino');
        $NuevaHabitacion->save();
        $NuevaHabitacion = \DB::table('habitacion')->get();
        return view('vendor.adminlte.nuevahabitacion', compact('NuevaHabitacion'));
        
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
        $NuevaHabitacion->ip_arduino = $request->ip_arduino;
        $NuevaHabitacion->save();
        $NuevaHabitacion = \DB::table('habitacion')->get();
        return view('vendor.adminlte.nuevahabitacion', compact('NuevaHabitacion'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Habitacion::destroy($id);
        $NuevaHabitacion = \DB::table('habitacion')->get();
        return view('vendor.adminlte.nuevahabitacion', compact('NuevaHabitacion'));
        //return redirect('Habitacion/create');
        
    }
}
