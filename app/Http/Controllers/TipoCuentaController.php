<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoCuenta;
use DB;
class TipoCuentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipo_cuenta = DB::table('tipo_cuentas')
        ->orderBy('id', 'desc')
        ->paginate(10);
        return view('vendor.adminlte.tipo_cuenta', compact('tipo_cuenta'));
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
        $tipo_cuenta = new TipoCuenta;
        $tipo_cuenta->descripcion = $request->descripcion;
        $tipo_cuenta->save();
        return redirect('/tipo_cuenta');
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
        $tipo_cuenta_mod = TipoCuenta::find($id);
        $tipo_cuenta = DB::table('tipo_cuentas')->get();
        return view('vendor.adminlte.modificar_tipo_cuenta', compact('tipo_cuenta_mod', 'tipo_cuenta'));
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
        $tipo_cuenta= TipoCuenta::find($id);
        $tipo_cuenta->descripcion = $request->descripcion;
        $tipo_cuenta->save();
        return redirect('/tipo_cuenta');

            }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        TipoCuenta::destroy($id);
        return redirect('/tipo_cuenta');
            }
}
