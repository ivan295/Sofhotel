<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    public $timestamps = false;
    protected $table = 'proveedor';
  	protected $fillable = ['nombres', 'apellidos', 'cedula', 'telefono','correo','empresa'];
}
