<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    
    protected $table = 'users';
  	protected $fillable = ['nombre', 'apellido', 'cedula', 'usuario','password','direccion','telefono','idtipoUsuario'];

  	 public function Scopesearch($query, $nombre){

  		return $query -> where('nombre','LIKE',"%$nombre%");

  	}
}
