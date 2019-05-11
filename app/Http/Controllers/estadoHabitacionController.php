<?php

namespace App\Http\Controllers;
use App\Estado_habitacion;
use Illuminate\Http\Request;
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
        $Estado= new Estado_habitacion;
        $Estado->descripcion = $request->input('estado_habitacion');
        $Estado->save();
        

    }

}
