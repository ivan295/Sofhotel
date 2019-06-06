<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gastos;
use App\Usuario;
use DB;
class gastosController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
     {
     	$NuevoGasto = DB::table('gastos')
        //->join('usuario','usuario.id','=','gastos.id_usuario')
        //->select('gastos.*','usuario.nombre as user')
        ->get();
        return view('vendor.adminlte.gastos', compact('NuevoGasto'));

     }

     public function store(Request $request)
     {
        //dd($request->all());
     	$NuevoGasto                    = new Gastos;
     	$NuevoGasto->descripcion = $request->descripcion;
     	$NuevoGasto->gasto_total = $request->gasto_total;
     	$NuevoGasto->hora_gasto  = $request->hora_gasto;
     	$NuevoGasto->fecha_gasto = $request->fecha_gasto;
        $NuevoGasto->id_usuario = $request->usuario;
     	$NuevoGasto->save();
     	return redirect('/gastos');
     }

      public function destroy($id)
    {
        Gastos::destroy($id);
        return redirect('/gastos');        
    }


    public function edit($id)
    {
        $gasto = gastos::find($id);
        return view('vendor.adminlte.editgasto', compact('gasto'));
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
        $NuevoGasto = Gastos::find($id);
        $NuevoGasto->descripcion = $request->descripcion;
     	$NuevoGasto->gasto_total = $request->gasto_total;
     	$NuevoGasto->hora_gasto  = $request->hora_gasto;
     	$NuevoGasto->fecha_gasto = $request->fecha_gasto;
        $NuevoGasto->save();
        return redirect('/gastos');
    }


 }
