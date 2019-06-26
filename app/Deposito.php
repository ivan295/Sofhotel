<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deposito extends Model
{
    public $timestamps = false;
    protected $table = 'depositos';
  protected $fillable = ['motivo','monto','id_usuario','id_cuenta'];


  public function Scopesearch($query, $motivo){

  		return $query -> where('motivo','LIKE',"%$motivo%");

  	}
}
