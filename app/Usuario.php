<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    public $timestamps = false;
    protected $table = 'usuario';
  	protected $fillable = ['nombre', 'apellido', 'cedula', 'usuario','password','direccion','telefono','idtipoUsuario'];
}
