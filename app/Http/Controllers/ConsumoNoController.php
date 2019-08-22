<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Alquiler;
use DB;
class ConsumoNoController extends Controller
{
    public function index(){
        $Alquiler = DB::table('alquiler')
        ->join('habitacion', 'habitacion.id', '=', 'alquiler.auxiliar2')
        ->where('alquiler.auxiliar', '=', 0)
        ->where('alquiler.auxiliar2', '>', 0)
        ->select('alquiler.*', 'habitacion.numero_habitacion as habitacion', 'habitacion.precio as Precio','habitacion.id as Id')
        ->first();
    return view('vendor.adminlte.consumoproductoNO', compact('Alquiler'));
    }

    public function store(){

    }
}
