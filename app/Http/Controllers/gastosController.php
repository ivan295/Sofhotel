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
        ->join('users','users.id','=','gastos.id_usuario')
        ->select('gastos.*','users.nombre as name')
        ->orderBy('id', 'desc')
        ->paginate(10);
        return view('vendor.adminlte.gastos', compact('NuevoGasto'));

     }

     public function store(Request $request)
     {
        //dd($request->all());
     	$NuevoGasto                    = new Gastos;
     	$NuevoGasto->descripcion = $request->descripcion;
     	$NuevoGasto->gasto_total = $request->gasto_total;
        $NuevoGasto->id_usuario = $request->id_usuario;
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
        $NuevoGasto->save();
        return redirect('/gastos');
    }


 }
