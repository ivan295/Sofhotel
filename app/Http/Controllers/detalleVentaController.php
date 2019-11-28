<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Factura_venta;
use DB;
use App\DetalleVenta;
use App\Alquiler;
use App\Dinero;
use App\Estado_habitacion;
use App\Habitacion;
use App\Productos;
class detalleVentaController extends Controller
{
    public function index()
    {

        $Alquiler = DB::table('alquiler')
            ->join('habitacion', 'habitacion.id', '=', 'alquiler.auxiliar2')
            ->where('alquiler.auxiliar', '=', 0)
            ->where('alquiler.auxiliar2', '>', 0)
            ->select('alquiler.*', 'habitacion.numero_habitacion as habitacion', 'habitacion.precio as Precio', 'habitacion.id as Id', 'habitacion.iva as iva', 'habitacion.desgloce as desgloce')
            ->first();
        $salida = Alquiler::find($Alquiler->id);
        $salida->auxiliar2 = 0;
        $salida->update();
        //dd($Alquiler->tiempo_alquiler);
        $tarifa = $Alquiler->Precio;
        $subtotal = $Alquiler->desgloce;
        $iva = $Alquiler->iva;
        if($Alquiler->tiempo_alquiler > '03:00:00'){
            $tarifa = $Alquiler->Precio * 2;
            $subtotal = $Alquiler->desgloce * 2;
            $iva = $Alquiler->iva * 2;
        } elseif($Alquiler->tiempo_alquiler > '06:00:00'){
            $tarifa = $Alquiler->Precio * 3;
            $subtotal = $Alquiler->desgloce * 3;
            $iva = $Alquiler->iva * 3;
        } elseif ($Alquiler->tiempo_alquiler > '09:00:00'){
            $tarifa = $Alquiler->Precio * 4;
            $subtotal = $Alquiler->desgloce * 4;
            $iva = $Alquiler->iva * 4;
        }

        return view('vendor.adminlte.detalleVenta', compact('Alquiler', 'tarifa', 'subtotal', 'iva'));
    }

    public function store(Request $request)
    {

        $d = DB::table('dineros')->orderBy('id', 'desc')->first();
        $dinero = Dinero::find($d->id);

        $factura = new Factura_venta;
        $factura->total_productos = $request->total_venta;
        $factura->total_alquiler = $request->tarifa;
        $factura->total_cobro = $request->tarifa + $factura->total_productos;
        $factura->id_alquiler = $request->id_alquiler;
        
        //$factura->id_usuario = $request->id_usuario;
        $factura->estado = 1;

        $contador = $dinero->dinero_disponible + $factura->total_cobro;
        $dinero->dinero_disponible = $contador;
        $dinero->update();
        $factura->save();

        $cont = 0;
        while ($cont < count($request->productoid)) {
            $produc = Productos::find($request->productoid[$cont]);
            $detalle = new DetalleVenta;
            $detalle->id_factura_venta = $factura->id; //$factura->id  factura que recien se guardó
            $detalle->id_producto = $request->productoid[$cont]; //id_articulo de la posición cero
            $detalle->cantidad = $request->cantidad[$cont];
            $detalle->total_venta = $request->precioventa[$cont] * $request->cant[$cont];
            $produc->stock = $produc->stock - $request->cantidad[$cont];
            $detalle->save();
            $produc->update();
            $cont = $cont + 1;
        }
        $habitacion = Habitacion::find($request->id_habitacion);
        $est = DB::table('estado_habitacion')
            ->join('habitacion', 'habitacion.id_estado', '=', 'estado_habitacion.id')
            ->where('estado_habitacion.id', '=', $habitacion->id_estado)
            ->select('estado_habitacion.*')
            ->first();

        $estado = Estado_habitacion::find($est->id);
        $habitacion->indice = "0";
        $estado->estado = "Espera";
        $habitacion->update();
        $estado->update();
        return redirect('/home');
    }

   
}
