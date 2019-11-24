<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Factura_venta;
use DB;
use Habitacion;
use Alquiler;
use App\Dinero;
use App\Estado_habitacion;
class facturaventaController extends Controller
{
    public function index()
    {
      //$FacturaVenta = DB::table('factura_venta')
      //  ->join('alquiler','alquiler.id','=','factura_venta.id_alquiler')
      //  ->join('habitacion','habitacion.id','=','alquiler.id_habitacion')
      //  ->select('factura_venta.*','alquiler.fecha as Fecha','habitacion.numero_habitacion as habitacion','habitacion.precio as Precio')
      //    ->orderBy('id', 'desc')
     
      //    ->paginate(10);
         //dd($FacturaVenta);
         
        return view('vendor.adminlte.Facturaventa', compact('habitacion','producto'));
    }
    public function store(Request $request)
    {
        $d = DB::table('dineros')->orderBy('id', 'desc')->first();
        $dinero = Dinero::find($d->id);

        $FacturaVenta                  = new Factura_venta;
        $FacturaVenta->total_alquiler = $request->total_alquiler;
        $FacturaVenta->total_productos = $request->total_productos;
        $FacturaVenta->total_cobro = $request->total_cobro;
        $FacturaVenta->id_alquiler = $request->id_alquiler;

        $contador = $dinero->dinero_disponible + $request->total_cobro;
        $dinero->dinero_disponible = $contador;

        $dinero->update();
        $FacturaVenta->save();

        return redirect('/factura_venta');
	}

  public function reporte_diario(Request $request){
             
            $date = $request->fecha;
            $factura_venta = obtener_factura_venta_reporte_diario($request->fecha);
          
            $cantidad_habitacion = DB::table('habitacion')->count();
            $hab[$cantidad_habitacion-1] = array();
            
            $habitacion = DB::table('habitacion')->orderBy('numero_habitacion', 'asc')->get();
            
            $i = 0;
            foreach ($habitacion as $fv) {
              $hab[$i] = 0;
              $i ++ ;
            }
            foreach ($factura_venta as $facv) {
              $cont = 0;
              foreach ($habitacion as $h) {
                if ($facv->habitacion == $h->numero_habitacion) {
                  $hab[$cont] = $hab[$cont] + $facv->total_cobro;
                }
                $cont++;
              }
            }

            //dd($hab);
          
          $view = \View::make('vendor.adminlte.reporte_factura_venta', compact('factura_venta', 'date', 'hab', 'habitacion'))->render();
          $pdf = \App::make('dompdf.wrapper');
          $pdf->loadHTML($view);
          return $pdf->stream('reporte'.'pdf');
    }

    public function reporte_diario_api($fecha){
        $factura_venta = obtener_factura_venta_reporte_diario($fecha);
        $cantidad_habitacion = DB::table('habitacion')->count();
            $hab[$cantidad_habitacion-1] = array();
            $habitacion = DB::table('habitacion')->orderBy('numero_habitacion', 'asc')->get();
            
            $i = 0;
            foreach ($habitacion as $fv) {
              $hab[$i] = 0;
              $i ++ ;
            }
            foreach ($factura_venta as $facv) {
              $cont = 0;
              foreach ($habitacion as $h) {
                if ($facv->habitacion == $h->numero_habitacion) {
                  $hab[$cont] = $hab[$cont] + $facv->total_cobro;
                }
                $cont++;
              }
            }
            $total = 0;
            foreach ($factura_venta as $f) {
              $total = $total + $f->total_cobro;
            }


          return response()->json([$factura_venta, $hab, $habitacion, $total]);
     }

     public function reporte_especifico(Request $request){
        $date_inicial = $request->fecha_inicial;
        $date_final = $request->fecha_final;
        $factura_venta  = obtener_factura_venta_reporte_especifico($request->fecha_inicial,$request->fecha_final);
        $cantidad_habitacion = DB::table('habitacion')->count();
            $hab[$cantidad_habitacion-1] = array();
            $habitacion = DB::table('habitacion')->orderBy('numero_habitacion', 'asc')->get();
            
            $i = 0;
            foreach ($habitacion as $fv) {
              $hab[$i] = 0;
              $i ++ ;
            }
            foreach ($factura_venta as $facv) {
              $cont = 0;
              foreach ($habitacion as $h) {
                if ($facv->habitacion == $h->numero_habitacion) {
                  $hab[$cont] = $hab[$cont] + $facv->total_cobro;
                }
                $cont++;
              }
            }

       // dd($factura_venta);
        $view = \View::make('vendor.adminlte.reporte_factura_venta', compact('factura_venta', 'date_inicial', 'date_final', 'hab', 'habitacion'))->render();
          $pdf = \App::make('dompdf.wrapper');
          $pdf->loadHTML($view);
          return $pdf->stream('reporte'.'pdf');
    }

    public function reporte_especifico_api($fecha_inicial, $fecha_final){
        $factura_venta = obtener_factura_venta_reporte_especifico($fecha_inicial, $fecha_final);
          $cantidad_habitacion = DB::table('habitacion')->count();
            $hab[$cantidad_habitacion-1] = array();
            $habitacion = DB::table('habitacion')->orderBy('numero_habitacion', 'asc')->get();
            
            $i = 0;
            foreach ($habitacion as $fv) {
              $hab[$i] = 0;
              $i ++ ;
            }
            foreach ($factura_venta as $facv) {
              $cont = 0;
              foreach ($habitacion as $h) {
                if ($facv->habitacion == $h->numero_habitacion) {
                  $hab[$cont] = $hab[$cont] + $facv->total_cobro;
                }
                $cont++;
              }
            }

             $total = 0;
            foreach ($factura_venta as $f) {
              $total = $total + $f->total_cobro;
            }

          return response()->json([$factura_venta, $hab, $habitacion, $total]);
    }

    public function reporte_mensual(Request $request){
        $month = $request->mes;
        $mes_entero=strtotime($month);
        $mes = date('m', $mes_entero);

        $factura_venta = obtener_factura_venta_reporte_mensual($mes);
        //dd($factura_venta);
        $cantidad_habitacion = DB::table('habitacion')->count();
            $hab[$cantidad_habitacion-1] = array();
            $habitacion = DB::table('habitacion')->orderBy('numero_habitacion', 'asc')->get();
            
            $i = 0;
            foreach ($habitacion as $fv) {
              $hab[$i] = 0;
              $i ++ ;
            }
            foreach ($factura_venta as $facv) {
              $cont = 0;
              foreach ($habitacion as $h) {
                if ($facv->habitacion == $h->numero_habitacion) {
                  $hab[$cont] = $hab[$cont] + $facv->total_cobro;
                }
                $cont++;
              }
            }

        $view = \View::make('vendor.adminlte.reporte_factura_venta', compact('factura_venta', 'month', 'hab', 'habitacion'))->render();
          $pdf = \App::make('dompdf.wrapper');
          $pdf->loadHTML($view);
          return $pdf->stream('reporte'.'pdf');

    }

     public function reporte_mensual_api($mes){
        $month = $mes;
        $mes_entero=strtotime($month);
        $mes = date('m', $mes_entero);

        $factura_venta = obtener_factura_venta_reporte_mensual($mes);
        $cantidad_habitacion = DB::table('habitacion')->count();
            $hab[$cantidad_habitacion-1] = array();
            $habitacion = DB::table('habitacion')->orderBy('numero_habitacion', 'asc')->get();
            
            $i = 0;
            foreach ($habitacion as $fv) {
              $hab[$i] = 0;
              $i ++ ;
            }
            foreach ($factura_venta as $facv) {
              $cont = 0;
              foreach ($habitacion as $h) {
                if ($facv->habitacion == $h->numero_habitacion) {
                  $hab[$cont] = $hab[$cont] + $facv->total_cobro;
                }
                $cont++;
              }
            }
             $total = 0;
            foreach ($factura_venta as $f) {
              $total = $total + $f->total_cobro;
            }

          return response()->json([$factura_venta, $habitacion, $hab, $total]);

    }
}
