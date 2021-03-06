<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Banco;
use DB;
class BancoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $banco = Banco::search($request->banco)
        ->orderBy('id', 'desc')
        ->where('bancos.estado','=',1)
        ->paginate(10);
        return view('vendor.adminlte.banco', compact('banco'));
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
            'entidad' => 'required',
            ]);

        $banco = new Banco;
        $banco->entidad = $request->entidad;
        $banco->estado = 1;
        $banco->save();
        return redirect('/banco')->with('success','Banco agregado correctamente');
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
        $banco = DB::table('bancos')->get();
        $banco_mod = Banco::find($id);
        return view('vendor.adminlte.modificar_banco', compact('banco_mod', 'banco'));
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
        $banco = Banco::find($id);
        $banco->entidad = $request->entidad;
        $banco->save();
        return redirect('/banco');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banco = Banco::findOrFail($id);
        $banco->estado = '0';
        $banco->update();
        return redirect('/banco');
    }
}
