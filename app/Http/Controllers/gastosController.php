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

    public function reporte_diario(Request $request){
        $date = $request->fecha;
        $Nuevogasto = obtener_gasto_reporte_diario($request->fecha);
        $total_gasto = calcular_total_gastos($Nuevogasto);
        $view = \View::make('vendor.adminlte.reporte_gastos', compact('Nuevogasto', 'date', 'total_gasto'))->render();
          $pdf = \App::make('dompdf.wrapper');
          $pdf->loadHTML($view);
          return $pdf->stream('reporte'.'pdf');
     }

       public function reporte_diario_api($fecha){
        $Nuevogasto = obtener_gasto_reporte_diario($fecha);
          return response()->json($Nuevogasto);
     }

     public function reporte_especifico(Request $request){
        $date_inicial = $request->fecha_inicial;
        $date_final = $request->fecha_final;
        $Nuevogasto = obtener_gasto_reporte_especifico($request->fecha_inicial,$request->fecha_final);
        $total_gasto = calcular_total_gastos($Nuevogasto);
        $view = \View::make('vendor.adminlte.reporte_gastos', compact('Nuevogasto', 'date_inicial', 'date_final', 'total_gasto'))->render();
          $pdf = \App::make('dompdf.wrapper');
          $pdf->loadHTML($view);
          return $pdf->stream('reporte'.'pdf');
    }

    public function reporte_especifico_api($fecha_inicial, $fecha_final){
        $Nuevogasto = $gasto = obtener_gasto_reporte_especifico($fecha_inicial, $fecha_final);
          return response()->json($Nuevogasto);
    }

    public function reporte_mensual(Request $request){
        $month = $request->mes;
        $mes_entero=strtotime($month);
        $mes = date('m', $mes_entero);

        $Nuevogasto = obtener_gasto_reporte_mensual($mes);
        $total_gasto = calcular_total_gastos($Nuevogasto);
        $view = \View::make('vendor.adminlte.reporte_gastos', compact('Nuevogasto', 'month', 'total_gasto'))->render();
          $pdf = \App::make('dompdf.wrapper');
          $pdf->loadHTML($view);
          return $pdf->stream('reporte'.'pdf');

    }

     public function reporte_mensual_api($mes){
        $month = $mes;
        $mes_entero=strtotime($month);
        $mes = date('m', $mes_entero);

        $Nuevogasto = obtener_gasto_reporte_mensual($mes);

          return response()->json($Nuevogasto);

    }


 }
