<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Deposito;

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
           ->paginate(10);

          return view('vendor.adminlte.deposito', compact('depositos'));


          }

    public function reporte_diario(Request $request){
             $date = $request->fecha;

            $depositos = DB::table('depositos')->join('users', 'users.id', '=', 'depositos.id_usuario')->join('cuentas', 'cuentas.id', '=', 'depositos.id_cuenta')->join('bancos', 'bancos.id', '=', 'cuentas.id_banco')->join('propietario_cuentas', 'propietario_cuentas.id', '=', 'cuentas.id_propietario')->join('tipo_cuentas', 'tipo_cuentas.id', '=', 'cuentas.id_tipo_cuenta')->whereDate('depositos.created_at', $date)->select('depositos.id','depositos.monto', 'depositos.motivo','depositos.created_at', 'users.usuario as nombre_usuario', 'cuentas.numero_cuenta as num_cta', 'bancos.entidad as entidad', 'propietario_cuentas.nombre as nombre', 'tipo_cuentas.descripcion as tp_descripcion' ,  'propietario_cuentas.nombre as nombre', 'bancos.entidad as entidad')->orderBy('id', 'asc')->get();

          
          $view = \View::make('vendor.adminlte.reporte_depositos', compact('depositos', 'date'))->render();
          $pdf = \App::make('dompdf.wrapper');
          $pdf->loadHTML($view);
          return $pdf->stream('reporte'.'pdf');
    }

    public function reporte_especifico(Request $request){
        $date_inicial= $request->fecha_inicial;
        $date_final = $request->fecha_final;

       /* $depositos = DB::table('depositos')->whereDate('created_at', '>=', $date_inicial)->whereDate('created_at', '<=', $date_final)->get();*/

        $depositos = DB::table('depositos')->join('users', 'users.id', '=', 'depositos.id_usuario')->join('cuentas', 'cuentas.id', '=', 'depositos.id_cuenta')->join('bancos', 'bancos.id', '=', 'cuentas.id_banco')->join('propietario_cuentas', 'propietario_cuentas.id', '=', 'cuentas.id_propietario')->join('tipo_cuentas', 'tipo_cuentas.id', '=', 'cuentas.id_tipo_cuenta')->whereDate('depositos.created_at', '>=', $date_inicial)->whereDate('depositos.created_at', '<=', $date_final)->select('depositos.id','depositos.monto', 'depositos.motivo','depositos.created_at', 'users.usuario as nombre_usuario', 'cuentas.numero_cuenta as num_cta', 'bancos.entidad as entidad', 'propietario_cuentas.nombre as nombre', 'tipo_cuentas.descripcion as tp_descripcion' ,  'propietario_cuentas.nombre as nombre', 'bancos.entidad as entidad')->orderBy('id', 'asc')->get();


        //dd($depositos);
        $view = \View::make('vendor.adminlte.reporte_depositos', compact('depositos', 'date_inicial', 'date_final'))->render();
          $pdf = \App::make('dompdf.wrapper');
          $pdf->loadHTML($view);
          return $pdf->stream('reporte'.'pdf');
    }

    public function reporte_mensual(Request $request){
        $month = $request->mes;
        $mes_entero=strtotime($month);
        $mes = date('m', $mes_entero);    
       // $depositos = DB::table('depositos')->whereMonth('created_at', $mes)->get();

        $depositos = DB::table('depositos')->join('users', 'users.id', '=', 'depositos.id_usuario')->join('cuentas', 'cuentas.id', '=', 'depositos.id_cuenta')->join('bancos', 'bancos.id', '=', 'cuentas.id_banco')->join('propietario_cuentas', 'propietario_cuentas.id', '=', 'cuentas.id_propietario')->join('tipo_cuentas', 'tipo_cuentas.id', '=', 'cuentas.id_tipo_cuenta')->whereMonth('depositos.created_at', $mes)->select('depositos.id','depositos.monto', 'depositos.motivo','depositos.created_at', 'users.usuario as nombre_usuario', 'cuentas.numero_cuenta as num_cta', 'bancos.entidad as entidad', 'propietario_cuentas.nombre as nombre', 'tipo_cuentas.descripcion as tp_descripcion' ,  'propietario_cuentas.nombre as nombre', 'bancos.entidad as entidad')->orderBy('id', 'asc')->get();

       // dd($depositos); 

       $view = \View::make('vendor.adminlte.reporte_depositos', compact('depositos', 'month'))->render();
          $pdf = \App::make('dompdf.wrapper');
          $pdf->loadHTML($view);
          return $pdf->stream('reporte'.'pdf');       
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


        $deposito = new Deposito;
        $deposito->motivo = $request->descripcion;
        $deposito->monto = $request->monto;
        $deposito->id_usuario = $request->id_usuario;
        $deposito->id_cuenta = $request->id_cuenta;
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
        //
    }
}
