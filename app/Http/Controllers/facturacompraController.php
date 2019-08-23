<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Factura_Compra;
use App\DetalleCompra;
use DB;
use Proveedor;
class facturacompraController extends Controller
{
    public function index(Request $request)
    {
        $NuevaCompra = Factura_Compra::search($request->descripcion)
        ->join('proveedor','proveedor.id','=','factura_compra.id_proveedor')
        ->join('users','users.id','=','factura_compra.id_usuario')
    	->select('factura_compra.*','proveedor.empresa as Empresa','users.nombre as name')
        ->orderBy('id', 'desc')
        ->where('factura_compra.estado','=',1)
        ->paginate(10);
        return view('vendor.adminlte.facturaCompra',compact('NuevaCompra'));
    }
    	
    public function show($id){
        $Compra = DB::table('factura_compra')
        ->join('proveedor','proveedor.id','=','factura_compra.id_proveedor')
        ->join('users','users.id','=','factura_compra.id_usuario')
        ->select('factura_compra.*','proveedor.empresa as Empresa','users.nombre as name')
        ->where('factura_compra.id','=', $id)
        ->first();

        $Detalle = DB::table('detalle_compra')
        ->join('producto','producto.id','=','detalle_compra.id_producto')
        ->select('detalle_compra.*','producto.descripcion as producto')
        ->where('detalle_compra.id_factura','=', $id)
        ->get();
        //dd($NuevaCompra,$Detalle);
        return view('vendor.adminlte.detallescompra',compact('Compra','Detalle'));

    }

	public function destroy($id)
    {
        $factura = Factura_Compra::findOrFail($id);
        $factura->estado = '0';
        $factura->update();
        return redirect('/factura_compra');        
    }

    public function reporte_diario(Request $request){
        $date = $request->fecha;
        $compra = obtener_factura_compra_reporte_diario($request->fecha);
        $total = 0;
        foreach ($compra as $c) {
            $total = $total + $c->total_pagar;
                  }
        $view = \View::make('vendor.adminlte.reporte_factura_compra', compact('compra', 'date', 'total'))->render();
          $pdf = \App::make('dompdf.wrapper');
          $pdf->loadHTML($view);
          return $pdf->stream('reporte'.'pdf');
     }

       public function reporte_diario_api($fecha){
        $compra = obtener_factura_compra_reporte_diario($fecha);
        $total = 0;
        foreach ($compra as $c) {
            $total = $total + $c->total_pagar;
                  }
          return response()->json([$compra, $total]);
     }

     public function reporte_especifico(Request $request){
        $date_inicial = $request->fecha_inicial;
        $date_final = $request->fecha_final;
        $compra = $gasto = obtener_factura_compra_reporte_especifico($request->fecha_inicial,$request->fecha_final);
        $total = 0;
        foreach ($compra as $c) {
            $total = $total + $c->total_pagar;
                  }
        
        $view = \View::make('vendor.adminlte.reporte_factura_compra', compact('compra', 'date_inicial', 'date_final', 'total'))->render();
          $pdf = \App::make('dompdf.wrapper');
          $pdf->loadHTML($view);
          return $pdf->stream('reporte'.'pdf');
    }

    public function reporte_especifico_api($fecha_inicial, $fecha_final){
        $compra = obtener_factura_compra_reporte_especifico($fecha_inicial, $fecha_final);
        $total = 0;
        foreach ($compra as $c) {
            $total = $total + $c->total_pagar;
                  }
          return response()->json([$compra, $total]);
    }

    public function reporte_mensual(Request $request){
        $month = $request->mes;
        $mes_entero=strtotime($month);
        $mes = date('m', $mes_entero);

        $compra = obtener_factura_compra_reporte_mensual($mes);
        $total = 0;
        foreach ($compra as $c) {
            $total = $total + $c->total_pagar;
                  }
        
        $view = \View::make('vendor.adminlte.reporte_factura_compra', compact('compra', 'month', 'total'))->render();
          $pdf = \App::make('dompdf.wrapper');
          $pdf->loadHTML($view);
          return $pdf->stream('reporte'.'pdf');

    }

     public function reporte_mensual_api($mes){
        $month = $mes;
        $mes_entero=strtotime($month);
        $mes = date('m', $mes_entero);

        $compra = obtener_factura_compra_reporte_mensual($mes);
        $total = 0;
        foreach ($compra as $c) {
            $total = $total + $c->total_pagar;
                  }

          return response()->json([$compra, $total]);

    }

}
