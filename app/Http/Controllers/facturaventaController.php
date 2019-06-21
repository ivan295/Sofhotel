<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Factura_venta;
use DB;
use Habitacion;
use Alquiler;
class facturaventaController extends Controller
{
    public function index()
    {
         $FacturaVenta = DB::table('factura_venta')
       ->join('alquiler','alquiler.id','=','factura_venta.id_alquiler')
       ->join('habitacion','habitacion.id','=','alquiler.id_habitacion')
       ->select('factura_venta.*','alquiler.fecha as Fecha','habitacion.numero_habitacion as habitacion','habitacion.precio as Precio')
         ->orderBy('id', 'desc')
     
         ->paginate(10);
         //dd($FacturaVenta);
         
        return view('vendor.adminlte.Facturaventa', compact('FacturaVenta'));
    }
    public function store(Request $request)
    {
        $FacturaVenta                  = new Factura_venta;
        $FacturaVenta->total_alquiler = $request->total_alquiler;
        $FacturaVenta->total_productos = $request->total_productos;
        $FacturaVenta->total_cobro = $request->total_cobro;
        $FacturaVenta->id_alquiler = $request->id_alquiler;
        $FacturaVenta->save();

        return redirect('/factura_venta');
	}
}
