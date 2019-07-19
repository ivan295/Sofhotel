<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Estado_habitacion;
use DB;
class estadoHabitacionController extends Controller
{
 
    public function addip($ip)
    {	
        $dato=new Estado_habitacion;

        $aux = 0;
        $consulta = DB::table('estado_habitacion')->get();
        foreach ($consulta as $c) {
            if($c->ip_arduino == $ip){
                $aux = 1;
            }
        }
        if($aux==1){
            dd("ya existe");
        }else {
        $dato->estado ="Desocupado";
        $dato->ip_arduino = $ip;
        $dato->save();
        }
        //dd($ip);
    }

    public function mod($t, $ip){


        $cont = DB::table('estado_habitacion')->where('ip_arduino', $ip)->first();
        //dd($cont->ip_arduino);
          if ($t == 1) {
              $data = Estado_habitacion::Find($cont->id);
              $data->estado = "Ocupado";
              $data->save();
          }
    
        

        //dd($t, $ip);
    }




}
