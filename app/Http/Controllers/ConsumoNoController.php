<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Alquiler;
use DB;
use App\Dinero;
use App\Habitacion;
use App\Estado_habitacion;
use App\Factura_venta;

class ConsumoNoController extends Controller
{
    public function index(){
        $Alquiler = DB::table('alquiler')
        ->join('habitacion', 'habitacion.id', '=', 'alquiler.auxiliar2')
        ->where('alquiler.auxiliar', '=', 0)
        ->where('alquiler.auxiliar2', '>', 0)
        ->select('alquiler.*', 'habitacion.numero_habitacion as habitacion', 'habitacion.precio as Precio','habitacion.id as hab')
        ->first();
        $salida = Alquiler::find($Alquiler->id);
        $salida->auxiliar2 = 0;
        $salida->update();
    return view('vendor.adminlte.consumoproductoNO', compact('Alquiler'));
    }

    public function store(Request $request){
        $d = DB::table('dineros')->orderBy('id', 'desc')->first();
        $dinero = Dinero::find($d->id);

        $factura = new Factura_venta;
        $factura->total_productos =0;
        $factura->total_cobro = $request->precio_habitacion;
        $factura->id_alquiler = $request->id_alquiler;
        $factura->total_alquiler = 12.50;
        //$factura->id_usuario = $request->id_usuario;
        $factura->estado = 1;

        $contador = $dinero->dinero_disponible + $request->precio_habitacion;
        $dinero->dinero_disponible = $contador;
        $dinero->update();
        $factura->save();

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
