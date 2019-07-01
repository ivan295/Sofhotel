<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Deposito;

class DepositoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
          $depositos = Deposito::search($request->fecha)
          ->join('users', 'users.id', '=', 'depositos.id_usuario')->join('cuentas', 'cuentas.id', '=', 'depositos.id_cuenta')->join('bancos', 'bancos.id', '=', 'cuentas.id_banco')->join('propietario_cuentas', 'propietario_cuentas.id', '=', 'cuentas.id_propietario')->join('tipo_cuentas', 'tipo_cuentas.id', '=', 'cuentas.id_tipo_cuenta')->select('depositos.id','depositos.monto', 'depositos.motivo','depositos.created_at', 'users.usuario as nombre_usuario', 'cuentas.numero_cuenta as num_cta', 'bancos.entidad as entidad', 'propietario_cuentas.nombre as nombre', 'tipo_cuentas.descripcion as tp_descripcion' ,  'propietario_cuentas.nombre as nombre', 'bancos.entidad as entidad')
           ->orderBy('id', 'desc')
           ->paginate(10);

          return view('vendor.adminlte.deposito', compact('depositos'));


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
        $request->validate([
            'descripcion' => 'required',
            'monto' => 'required',
            'id_usuario' => 'required',
            'id_cuenta' => 'required',
            ]);


        $deposito = new Deposito;
        $deposito->descripcion = $request->descripcion;
        $deposito->monto = $request->monto;
        $deposito->id_usuario = $request->id_usuario;
        $deposito->id_cuenta = $request->id_cuenta;
        $deposito->save();

        return redirect('/deposito');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
