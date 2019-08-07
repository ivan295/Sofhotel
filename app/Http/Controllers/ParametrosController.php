<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Parametros;

class ParametrosController extends Controller
{
    public function index()
    {
        $parametro = \DB::table('parametros')
        ->get();
        
    return view('vendor.adminlte.parametros',compact('parametro'));
    }

    public function store(Request $request){

        $parametro = new Parametros;
        $parametro->iva = $request->iva/100;
        $parametro->precio = $request->precio;
        $parametro->tiempo = $request->tiempo;
        $parametro->save();
        return redirect('/parametros');
        }


        public function edit($id)
        {
            $parametro = Parametros::find($id);
             return view('vendor.adminlte.editparametro', compact('parametro'));
        }
    
        public function update(Request $request, $id)
        {
            $parametro = Parametros::find($id);
            $parametro->iva = $request->iva/100;
            $parametro->precio = $request->precio;
            $parametro->tiempo = $request->tiempo;
            $parametro->save();
            return redirect('/parametros');
        }
}
