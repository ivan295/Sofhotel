<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alquiler extends Model
{
    public $timestamps = false;
    protected $table = 'alquiler';
  	protected $fillable = ['fecha','hora_ingreso_habitacion','hora_salida_habitacion','tiempo_alquiler','numero_personas','id_usuario','id_habitacion'];
}
