<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    
    protected $table = 'proveedor';
  	protected $fillable = ['nombres', 'apellidos', 'cedula', 'telefono','correo','empresa'];

  	 public function Scopesearch($query, $nombres){

  		return $query -> where('nombres','LIKE',"%$nombres%");

  	}


}
