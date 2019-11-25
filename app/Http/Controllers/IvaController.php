<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Iva;
use DB;
class IvaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $iva = DB::table('ivas')->get();
        return view('vendor.adminlte.parametros',compact('iva'));
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
        $iva = new Iva;
        $iva->valor = $request->iva;
        $iva->save();
        return redirect('/parametros');
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
        $iva = Iva::find($id);
        return view('vendor.adminlte.editparametro', compact('iva'));    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $iva = Iva::find($id);
        $iva->valor = $request->iva;
        $iva->save();
        return redirect('/parametros');
            }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $iva = Iva::find($id);
        $iva->delete();
        return redirect('/parametros');
    }
}
