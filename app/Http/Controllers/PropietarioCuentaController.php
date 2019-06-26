<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\PropietarioCuenta;

class PropietarioCuentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $propietario_cuenta = PropietarioCuenta::search($request->propietario)
        ->orderBy('id', 'desc')
        ->paginate(10);

        return view('vendor.adminlte.propietario_cuenta', compact('propietario_cuenta'));
            }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $propietario = new PropietarioCuenta;
        $propietario->nombre = $request->nombre;
        $propietario->save();
        return redirect('/propietario_cuenta');
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
         $propietario_cuenta = DB::table('propietario_cuentas')->get();
        $propietario = PropietarioCuenta::find($id);
     return view ('vendor.adminlte.modificar_propietario_cuenta', compact('propietario', 'propietario_cuenta'));
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
        $propietario_cuenta = PropietarioCuenta::find($id);
        $propietario_cuenta->nombre = $request->nombre;
        $propietario_cuenta->save();
        return redirect('/propietario_cuenta');
            }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PropietarioCuenta::destroy($id);
        return redirect('/propietario_cuenta');
    }
}
