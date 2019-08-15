<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Caja;
use App\Dinero;
use DB;
class CajaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $dinero = obtener_dinero_disponible();
        return view('vendor.adminlte.apertura_caja', compact('dinero'));
    }

    public function cierre(){
            $dinero = obtener_dinero_disponible();
            $caja = DB::table('cajas')->orderBy('id', 'desc')->first();
            return view('vendor.adminlte.cierre_caja', compact('dinero', 'caja'));
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

     public function cerrar_caja(Request $request){
        //dd($request);
      $dinero = New Dinero;
        $dinero->dinero_disponible = $request->dinero_disponible;
        $caja = Caja::find($request->id_caja);
        $caja->id_dinero_final = $request->id_dinero;
        //$caja->id_usuario=$request->id_usuario;
        $caja->estado = 0;
        $dinero->save(); 
        $caja->save();
        return back();

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $caja = new Caja;
        $caja->numero_caja=$request->numero_caja;
        $caja->id_usuario=$request->id_usuario;
        $caja->dinero_inicial=$request->dinero_caja;
        $caja->estado = 1;
        $caja->save();
        return back();
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
