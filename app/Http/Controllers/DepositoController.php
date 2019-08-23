<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Deposito;
use App\Dinero;

class DepositoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
          $depositos = Deposito::search($request->fecha)
          ->join('users', 'users.id', '=', 'depositos.id_usuario')->join('cuentas', 'cuentas.id', '=', 'depositos.id_cuenta')->join('bancos', 'bancos.id', '=', 'cuentas.id_banco')->join('propietario_cuentas', 'propietario_cuentas.id', '=', 'cuentas.id_propietario')->join('tipo_cuentas', 'tipo_cuentas.id', '=', 'cuentas.id_tipo_cuenta')->select('depositos.id','depositos.monto', 'depositos.motivo','depositos.created_at', 'users.usuario as nombre_usuario', 'cuentas.numero_cuenta as num_cta', 'bancos.entidad as entidad', 'propietario_cuentas.nombre as nombre', 'tipo_cuentas.descripcion as tp_descripcion' ,  'propietario_cuentas.nombre as nombre', 'bancos.entidad as entidad')
           ->orderBy('id', 'desc')
           ->where('depositos.estado','=',1)
           ->paginate(10);

          return view('vendor.adminlte.deposito', compact('depositos'));


          }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'descripcion' => 'required',
            'monto' => 'required',
            'id_usuario' => 'required',
            'id_cuenta' => 'required',
            ]);




        $d = obtener_dinero_disponible();;
        $dinero = Dinero::find($d->id);
        
        $deposito = new Deposito;
        $deposito->motivo = $request->descripcion;
        $deposito->monto = $request->monto;
        $deposito->id_usuario = $request->id_usuario;
        $deposito->id_cuenta = $request->id_cuenta;
        $deposito->estado = 1;
        $contador = $dinero->dinero_disponible - $request->monto;
        $dinero->dinero_disponible = $contador;
        $dinero->save();
        $deposito->save();

        return redirect('/deposito')->with('success','Depósito agregado correctamente');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $d = obtener_dinero_disponible();
        $dinero = Dinero::find($d->id);

        $deposito = Deposito::findOrFail($id);
        $contador = $dinero->dinero_disponible + $deposito->monto;
        $dinero->dinero_disponible = $contador;
        $deposito->estado = '0';
        $deposito->update();
        $dinero->update();
        return redirect('/deposito');

    }

    public function reporte_diario(Request $request){
             
            $date = $request->fecha;
            $depositos = obtener_deposito_reporte_diario($request->fecha) ;
   // dd($depositos);
          
          $view = \View::make('vendor.adminlte.reporte_depositos', compact('depositos', 'date'))->render();
          $pdf = \App::make('dompdf.wrapper');
          $pdf->loadHTML($view);
          return $pdf->stream('reporte'.'pdf');
    }

    public function reporte_diario_api($fecha){
             
           // $date = $fecha;
            $depositos = obtener_deposito_reporte_diario($fecha);
            return response()->json($depositos);
    
    }


    public function reporte_especifico(Request $request){
        $date_inicial = $request->fecha_inicial;
        $date_final = $request->fecha_final;

        $depositos = obtener_deposito_reporte_especifico($request->fecha_inicial,$request->fecha_final);

        $view = \View::make('vendor.adminlte.reporte_depositos', compact('depositos', 'date_inicial', 'date_final'))->render();
          $pdf = \App::make('dompdf.wrapper');
          $pdf->loadHTML($view);
          return $pdf->stream('reporte'.'pdf');
    }

    public function reporte_especifico_api($fecha_inicial, $fecha_final){

        $depositos = obtener_deposito_reporte_especifico($fecha_inicial, $fecha_final);
        return response()->json($depositos);
    }

    public function reporte_mensual(Request $request){
        $month = $request->mes;
        $mes_entero=strtotime($month);
        $mes = date('m', $mes_entero);    
        $depositos = obtener_deposito_reporte_mensual($mes);

        $view = \View::make('vendor.adminlte.reporte_depositos', compact('depositos', 'month'))->render();
          $pdf = \App::make('dompdf.wrapper');
          $pdf->loadHTML($view);
          return $pdf->stream('reporte'.'pdf');
          
    }

    public function reporte_mensual_api($mes){
        $month = $mes;
        $mes_entero=strtotime($month);
        $mes = date('m', $mes_entero);    
        $depositos = obtener_deposito_reporte_mensual($mes);

      return response()->json($depositos);     
    }
}
