<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Caja;
use App\Dinero;
use DB;
class CajaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $dinero = obtener_dinero_disponible();
        return view('vendor.adminlte.apertura_caja', compact('dinero'));
    }

    public function cierre(){
            $dinero = obtener_dinero_disponible();
            $caja = DB::table('cajas')->orderBy('id', 'desc')->first();
            return view('vendor.adminlte.cierre_caja', compact('dinero', 'caja'));
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

     public function cerrar_caja(Request $request){
        //dd($request);
      $dinero = New Dinero;
        $dinero->dinero_disponible = $request->dinero_disponible;
        $caja = Caja::find($request->id_caja);
        $caja->id_dinero_final = $request->id_dinero;
        //$caja->id_usuario=$request->id_usuario;
        $caja->estado = 0;
        $dinero->save(); 
        $caja->save();
        return back();

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $caja = new Caja;
        $caja->numero_caja=$request->numero_caja;
        $caja->id_usuario=$request->id_usuario;
        $caja->dinero_inicial=$request->dinero_caja;
        $caja->estado = 1;
        $caja->save();
        return back();
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

    public function reporte_cierre_caja(){
        $caja = DB::table('cajas')->join('dineros', 'dineros.id', '=', 'cajas.id_dinero_final')->join('users', 'users.id', '=', 'cajas.id_usuario')->select('cajas.numero_caja', 'cajas.dinero_inicial', 'cajas.created_at', 'cajas.updated_at', 'dineros.dinero_disponible as dinero_disponible', 'users.usuario as usuario')->orderBy('cajas.id', 'desc')->first();

        $deposito = DB::table('depositos')->join('users', 'users.id', '=', 'depositos.id_usuario')->join('cuentas', 'cuentas.id', '=', 'depositos.id_cuenta')->join('bancos', 'bancos.id', '=', 'cuentas.id_banco')->join('propietario_cuentas', 'propietario_cuentas.id', '=', 'cuentas.id_propietario')->join('tipo_cuentas', 'tipo_cuentas.id', '=', 'cuentas.id_tipo_cuenta')->whereBetween('depositos.updated_at', [$caja->created_at , $caja->updated_at] )->select('depositos.id','depositos.monto', 'depositos.motivo','depositos.created_at', 'users.usuario as nombre_usuario', 'cuentas.numero_cuenta as num_cta', 'bancos.entidad as entidad', 'propietario_cuentas.nombre as nombre', 'tipo_cuentas.descripcion as tp_descripcion' ,  'propietario_cuentas.nombre as nombre', 'bancos.entidad as entidad')->orderBy('id', 'asc')->get();
        
        


        $gasto = DB::table('gastos')->join('users','users.id','=','gastos.id_usuario')->whereBetween('gastos.updated_at', [$caja->created_at , $caja->updated_at] )->select('gastos.*','users.usuario as user')->orderBy('id', 'asc')->get();

        


        $FacturaVenta = DB::table('factura_venta')
       ->join('alquiler','alquiler.id','=','factura_venta.id_alquiler')
       ->join('habitacion','habitacion.id','=','alquiler.id_habitacion')
       ->whereBetween('factura_venta.updated_at', [$caja->created_at , $caja->updated_at] )->select('factura_venta.*','alquiler.fecha as Fecha','habitacion.numero_habitacion as habitacion','habitacion.precio as precio')
         ->orderBy('id', 'desc')->get();

        $compra = obtener_factura_compra_individual($caja->created_at, $caja->updated_at);
        $total_depositos = calcular_total_depositos($deposito);
        $total_gastos = calcular_total_gastos($gasto);
        $total_venta = calcular_total_ventas($FacturaVenta);
        $total_compra = calcular_total_compras($compra);
        $total_egresos = calcular_total_egresos($total_depositos, $total_gastos, $total_compra);
        $utilidad = calcular_total_utilidad($total_venta, $total_egresos);         
         

         $view = \View::make('vendor.adminlte.reporte_caja', compact('caja','deposito', 'gasto', 'FacturaVenta', 'total_depositos', 'total_gastos', 'total_venta', 'total_egresos', 'utilidad', 'compra', 'total_compra'))->render();
          $pdf = \App::make('dompdf.wrapper');
          $pdf->loadHTML($view);
          return $pdf->stream('reporte'.'pdf');

        }
}
