<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Cuenta;
use App\Banco;
use App\TipoCuenta;
use App\PropietarioCuenta;

class CuentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cuentas = Cuenta::search($request->numero)
        ->join('tipo_cuentas', 'tipo_cuentas.id', '=', 'cuentas.id_tipo_cuenta')
        ->join('propietario_cuentas', 'propietario_cuentas.id', '=', 'cuentas.id_propietario')
        ->join('bancos', 'bancos.id', '=', 'cuentas.id_banco')
        ->select('cuentas.id','cuentas.numero_cuenta', 'tipo_cuentas.descripcion as descripcion','propietario_cuentas.nombre as nombre', 'bancos.entidad as entidad')
        ->orderBy('id', 'desc')
        ->where('cuentas.estado','=',1)

        ->paginate(10);
        
        return view('vendor.adminlte.cuenta', compact('cuentas'));

            }

    public function store(Request $request)
    {
        $request->validate([
            'numero_cuenta' => 'required',
            'id_tipo_cuenta' => 'required',
            'id_propietario' => 'required',
            'id_banco' => 'required',
            ]);
        $cuenta = new Cuenta;
        $cuenta->numero_cuenta = $request->numero_cuenta;
        $cuenta->id_tipo_cuenta = $request->id_tipo_cuenta;
        $cuenta->id_propietario = $request->id_propietario;
        $cuenta->id_banco = $request->id_banco;
        $cuenta->estado = 1;
        $cuenta->save();
        return redirect('/cuenta')->with('success','Cuenta agregada correctamente');
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
        $cuentas = DB::table('cuentas')->join('tipo_cuentas', 'tipo_cuentas.id', '=', 'cuentas.id_tipo_cuenta')->join('propietario_cuentas', 'propietario_cuentas.id', '=', 'cuentas.id_propietario')->join('bancos', 'bancos.id', '=', 'cuentas.id_banco')->select('cuentas.id','cuentas.numero_cuenta', 'tipo_cuentas.descripcion as descripcion','propietario_cuentas.nombre as nombre', 'bancos.entidad as entidad')->get();
        $cuenta = Cuenta::find($id);
        $propietario = PropietarioCuenta::find($cuenta->id_propietario);
        $tipo_cuenta = TipoCuenta::find($cuenta->id_tipo_cuenta);
        $banco = Banco::find($cuenta->id_banco);
        return view('vendor.adminlte.modificar_cuentas', compact('cuenta','propietario','tipo_cuenta', 'banco', 'cuentas'));

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
        $cuenta = Cuenta::find($id);
        $cuenta->numero_cuenta = $request->numero_cuenta;
        $cuenta->id_banco = $request->id_banco;
        $cuenta->id_propietario = $request->id_propietario;
        $cuenta->id_tipo_cuenta = $request->id_tipo_cuenta;
        $cuenta->save();
        return redirect('/cuenta');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $cuenta = Cuenta::findOrFail($id);
        $cuenta->estado = '0';
        $cuenta->update();
        return redirect('/cuenta');
            }
}
