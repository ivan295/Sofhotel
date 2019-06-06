<?php

/*
 * Taken from
 * https://github.com/laravel/framework/blob/5.3/src/Illuminate/Auth/Console/stubs/make/controllers/HomeController.stub
 */

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Habitacion;
use App\Estado_habitacion;
/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {
        $NuevaH = \DB::table('habitacion')->get();
        return view('adminlte::home', compact('NuevaH'));      

        return view('adminlte::home');
    }

    public function estadohabitacion(){
             $estadoH = \DB::table('estado_habitacion')->get();
        return view('adminlte::home', compact('estadoH'));

    }

    //public function store(Request $request){
      // $hb = new Datos();
        //$hb->humedad=$request->humedad;
       //$hb->temperatura=$request->temperatura;
       //$hb->save();
            //}


    // public function store($humedad, $temperatura){
    //    $hb = new Datos();
    //    $hb->humedad=$humedad;
    //    $hb->temperatura=$temperatura;
    //    $hb->save();
    //         }



}