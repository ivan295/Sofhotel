<?php

namespace App\Http\Controllers;
use App\Estado_habitacion;
use Illuminate\Http\Request;
use App\Estado_habitacion;
class estadoHabitacionController extends Controller
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
         $estadoH = \DB::table('estado_habitacion')->get();
        return view('adminlte::home', compact('estadoH'));
        

    }

}
