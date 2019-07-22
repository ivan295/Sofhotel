<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deposito extends Model
{
    protected $table = 'depositos';
  protected $fillable = ['motivo','monto','id_usuario','id_cuenta', 'created_at', 'update_at'];


  public function Scopesearch($query, $motivo){

  		return $query -> where('motivo','LIKE',"%$motivo%");

  	}
}
