<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Habitacion extends Model
{
	public $timestamps = false;
    protected $table = 'habitacion';
  protected $fillable = ['numero_habitacion', 'tipo_habitacion', 'precio', 'tiempo_limpieza','ip_arduino'];
}