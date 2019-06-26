<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoCuenta extends Model
{
    public $timestamps = false;
    protected $table = 'tipo_cuentas';
  protected $fillable = ['descripcion'];

  public function Scopesearch($query, $descripcion){

  		return $query -> where('descripcion','LIKE',"%$descripcion%");

  	}
}
