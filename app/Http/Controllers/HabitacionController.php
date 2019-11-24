<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Habitacion;
use DB;
use App\Estado_habitacion;
class HabitacionController extends Controller
{
   
    public function index()
    {
        $NuevaHabitacion = DB::table('habitacion')
        ->join('estado_habitacion','estado_habitacion.id','=','habitacion.id_estado')
        ->select('habitacion.*','estado_habitacion.ip_arduino as ip')
        ->orderBy('id', 'asc')
        ->where('habitacion.estado','=',1)
        ->get();
        //dd($NuevaHabitacion);        
        return view('vendor.adminlte.nuevahabitacion', compact('NuevaHabitacion'));
    }

    public function create()
    {
        //return view('vendor.adminlte.nuevahabitacion', compact('NuevaHabitacion'));
        
    }

    public function store(Request $request)
    {
        $request->validate([
            'numero_habitacion' => 'required|numeric',
            'tipo_habitacion' => 'required|alpha', //alpha valida que solo se ingresen letras
            'precio' => 'required',
            'tiempo_limpieza' => 'required',
            ]);
            //dd($request->all());
        $NuevaHabitacion                    = new Habitacion;
        $NuevaHabitacion->numero_habitacion = $request->numero_habitacion;
        $NuevaHabitacion->tipo_habitacion   = $request->tipo_habitacion;
        $NuevaHabitacion->precio            = $request->precio;
        $NuevaHabitacion->tiempo_limpieza   = $request->tiempo_limpieza;
        $NuevaHabitacion->id_estado   = $request->id_estado;
        $NuevaHabitacion->estado =1;
        $NuevaHabitacion->indice =0;
        $NuevaHabitacion->save();
        $tiempo = 2 * 60 * 1000000;
        $sock = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
        $len = strlen($tiempo);
        socket_sendto($sock, $tiempo, $len, 0, '192.168.0.108', 8888);
        socket_close($sock);

        return redirect('/Habitacion')->with('success','Habitacion creada correctamente');
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
        $habit = habitacion::find($id);
        return view('vendor.adminlte.edithabitacion', compact('habit'));
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
        $NuevaHabitacion = Habitacion::find($id);
        $NuevaHabitacion->numero_habitacion = $request->numero_habitacion;
        $NuevaHabitacion->tipo_habitacion = $request->tipo_habitacion;
        $NuevaHabitacion->precio = $request->precio;    
        $NuevaHabitacion->tiempo_limpieza = $request->tiempo_limpieza;
        $NuevaHabitacion->save();
        return redirect('/Habitacion');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $habitacion = Habitacion::findOrFail($id);
        $habitacion->estado = '0';
        $habitacion->update();
        return redirect('/Habitacion');
        
    }

    public function reporte_habitacion_api(){
        /*$hab_ventas = DB::table('habitacion')
        ->join('estado_habitacion','estado_habitacion.id','=','habitacion.id_estado')->join('alquiler', 'alquiler.id_habitacion', '=', 'habitacion.id')->join('factura_venta', 'factura_venta.id_alquiler', '=', 'alquiler.id')
        ->select('habitacion.*','estado_habitacion.estado as estado', 'factura_venta.total_cobro as total_cobro')
        ->orderBy('id', 'asc')
        ->where('habitacion.estado','=',1)
        ->get();*/
        $fecha = date("Y/m/d");
        $hab_ventas = obtener_factura_venta_reporte_diario($fecha);

        $habitacion = DB::table('habitacion')->join('estado_habitacion','estado_habitacion.id','=','habitacion.id_estado')->select('habitacion.*', 'estado_habitacion.estado as estado')->orderBy('numero_habitacion', 'asc')->get();

        $cantidad_habitacion = DB::table('habitacion')->count();
        $hab[$cantidad_habitacion-1] = array();
       // $estado_hab[$cantidad_habitacion-1] = array();

         $i = 0;
            foreach ($habitacion as $h) {
              $hab[$i] = 0;
            //  $estado_hab[$i] = $h->estado;
              $i ++ ;
            }

           foreach ($hab_ventas as $v) {
              $cont = 0;
              foreach ($habitacion as $ha) {
                if ($v->habitacion == $ha->numero_habitacion) {
                  $hab[$cont] = $hab[$cont] + $v->total_cobro;
                }
                $cont++;
              }
            } 
       // dd([$hab, $habitacion]);
        return response()->json([$habitacion, $hab]);
    }
}
