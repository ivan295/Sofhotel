<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Parametros;
use App\Dinero;

class ParametrosController extends Controller
{
    public function index()
    {
        /*$parametro = \DB::table('parametros')
        ->get();
        
    return view('vendor.adminlte.parametros',compact('parametro'));*/
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

        public function ingresar(Request $request){
            $dine = new Dinero;
            $dine->dinero_disponible = $request->dinero_caja + $request->dinero_ingresar;
            $dine->save();
            return view('vendor.adminlte.ingresar_caja');
        }

        public function retirar(Request $request){
            $dine = new Dinero;
            $dine->dinero_disponible = $request->dinero_caja - $request->dinero_ingresar;
            $dine->save();
            return view('vendor.adminlte.ingresar_caja');
        }
}
