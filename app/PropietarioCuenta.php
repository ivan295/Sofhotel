<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropietarioCuenta extends Model
{
   
    protected $table = 'propietario_cuentas';
  protected $fillable = ['nombre'];

  public function Scopesearch($query, $nombre){

  		return $query -> where('nombre','LIKE',"%$nombre%");

  	}
}
