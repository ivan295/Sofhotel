<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gastos;
use App\Usuario;
use App\Dinero;
use DB;
class gastosController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(Request $request)
     {
     	$NuevoGasto = Gastos::search($request->gasto)
        ->join('users','users.id','=','gastos.id_usuario')
        ->select('gastos.*','users.usuario as user')
        ->orderBy('id', 'desc')
        ->where('gastos.estado','=',1)
        ->paginate(10);
        return view('vendor.adminlte.gastos', compact('NuevoGasto'));

     }

     public function store(Request $request)
     {
         //dd($request->all());
        $request->validate([
            'descripcion' => 'required',
            'gasto_total' => 'required',
            'id_usuario' => 'required',
            ]);

        $d = obtener_dinero_disponible();
        $dinero = Dinero::find($d->id);
        
     	$NuevoGasto                    = new Gastos;
     	$NuevoGasto->descripcion = $request->descripcion;
     	$NuevoGasto->gasto_total = $request->gasto_total;
        $NuevoGasto->id_usuario = $request->id_usuario;
        $NuevoGasto->estado = 1;
        $contador = $dinero->dinero_disponible - $request->gasto_total;
        $dinero->dinero_disponible = $contador;

        $dinero->save();
     	$NuevoGasto->save();
     	return redirect('/gastos')->with('success','Gasto agregado correctamente');
     }

      public function destroy($id)
    {
        $d = obtener_dinero_disponible();
        $dinero = Dinero::find($d->id);
        $gasto = Gastos::findOrFail($id);

        $contador = $dinero->dinero_disponible + $gasto->gasto_total;
        $gasto->estado = '0';
        $gasto->update();

        $dinero->dinero_disponible = $contador;
        $dinero->update();
        
        return redirect('/gastos');        
    }


    public function edit($id)
    {
        $d = DB::table('dineros')->orderBy('id', 'desc')->first();
        $id_dinero = $d->id;
        $gasto = gastos::find($id);
        $iniciar_dinero = $gasto->gasto_total + $d->dinero_disponible;
        return view('vendor.adminlte.editgasto', compact('gasto', 'iniciar_dinero', 'id_dinero'));
    
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
        $dinero = Dinero::find($request->id_dinero);
    

        $NuevoGasto = Gastos::find($id);
        $NuevoGasto->descripcion = $request->descripcion;
     	$NuevoGasto->gasto_total = $request->gasto_total;

        $mont = $request->iniciar_dinero - $request->gasto_total;

        $dinero->dinero_disponible = $mont;
        $dinero->update();

        $NuevoGasto->update();
        return redirect('/gastos');
    }


 }
